<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\File;
use App\Models\FileActivity;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->isAdmin()) {
            $files = File::with(['owner', 'sharedWith'])
                ->withCount([
                    'activities as download_count' => fn ($q) => $q->where('action', 'download'),
                    'activities as stream_count' => fn ($q) => $q->where('action', 'stream'),
                    'activities as preview_count' => fn ($q) => $q->where('action', 'preview'),
                ])
                ->orderByDesc('created_at')->get();
        } else {
            $ownIds = $user->files()->pluck('id');
            $sharedIds = $user->sharedFiles()->pluck('files.id');
            $files = File::with(['owner', 'sharedWith'])
                ->whereIn('id', $ownIds->merge($sharedIds)->unique())
                ->orderByDesc('created_at')
                ->get();
        }

        $users = User::where('id', '!=', $user->id)->orderBy('name')->get();

        return view('admin.files', compact('files', 'users'));
    }

    public function upload(Request $request)
    {
        $request->validate([
            'files' => 'required|array|max:10',
            'files.*' => 'file|max:1048576',
        ]);

        $count = 0;
        foreach ($request->file('files') as $uploadedFile) {
            $name = $uploadedFile->hashName();
            $path = $uploadedFile->store('shared-files', 'local');

            File::create([
                'user_id' => Auth::id(),
                'name' => $name,
                'original_name' => $uploadedFile->getClientOriginalName(),
                'path' => $path,
                'mime_type' => $uploadedFile->getMimeType(),
                'size' => $uploadedFile->getSize(),
            ]);
            $count++;
        }

        return back()->with('success', "{$count} fichier(s) envoye(s).");
    }

    public function download(File $file)
    {
        if (!$file->isAccessibleBy(Auth::user())) {
            abort(403);
        }

        FileActivity::create(['file_id' => $file->id, 'user_id' => Auth::id(), 'action' => 'download']);

        return Storage::disk('local')->download($file->path, $file->original_name);
    }

    public function stream(File $file)
    {
        if (!$file->isAccessibleBy(Auth::user())) {
            abort(403);
        }

        $sessionKey = "streamed_{$file->id}";
        if (!session()->has($sessionKey)) {
            FileActivity::create(['file_id' => $file->id, 'user_id' => Auth::id(), 'action' => 'stream']);
            session()->put($sessionKey, true);
        }

        $disk = Storage::disk('local');
        $path = $disk->path($file->path);
        $size = $disk->size($file->path);
        $mime = $file->mime_type;

        $headers = [
            'Content-Type' => $mime,
            'Accept-Ranges' => 'bytes',
        ];

        $request = request();
        if ($request->headers->has('Range')) {
            $range = $request->headers->get('Range');
            preg_match('/bytes=(\d+)-(\d*)/', $range, $matches);
            $start = (int) $matches[1];
            $end = $matches[2] !== '' ? (int) $matches[2] : $size - 1;
            $length = $end - $start + 1;

            $headers['Content-Range'] = "bytes {$start}-{$end}/{$size}";
            $headers['Content-Length'] = $length;

            return response()->stream(function () use ($path, $start, $length) {
                $stream = fopen($path, 'rb');
                fseek($stream, $start);
                $remaining = $length;
                while ($remaining > 0 && !feof($stream)) {
                    $chunk = fread($stream, min(8192, $remaining));
                    echo $chunk;
                    $remaining -= strlen($chunk);
                    flush();
                }
                fclose($stream);
            }, 206, $headers);
        }

        $headers['Content-Length'] = $size;

        return response()->stream(function () use ($path) {
            $stream = fopen($path, 'rb');
            while (!feof($stream)) {
                echo fread($stream, 8192);
                flush();
            }
            fclose($stream);
        }, 200, $headers);
    }

    public function preview(File $file)
    {
        if (!$file->isAccessibleBy(Auth::user())) {
            abort(403);
        }

        FileActivity::create(['file_id' => $file->id, 'user_id' => Auth::id(), 'action' => 'preview']);

        $disk = Storage::disk('local');

        return response($disk->get($file->path), 200, [
            'Content-Type' => $file->mime_type,
            'Content-Disposition' => 'inline; filename="' . $file->original_name . '"',
        ]);
    }

    public function share(Request $request, File $file)
    {
        $user = Auth::user();

        if (!$user->isAdmin() && !$file->isOwnedBy($user)) {
            abort(403);
        }

        $request->validate([
            'user_ids' => 'required|array',
            'user_ids.*' => 'exists:users,id',
        ]);

        $file->sharedWith()->sync($request->user_ids);

        return back()->with('success', __('Partage mis a jour.'));
    }

    public function unshare(File $file, User $target)
    {
        $user = Auth::user();

        if (!$user->isAdmin() && !$file->isOwnedBy($user)) {
            abort(403);
        }

        $file->sharedWith()->detach($target->id);

        return back()->with('success', __('Acces retire.'));
    }

    public function destroy(File $file)
    {
        $user = Auth::user();

        if (!$user->isAdmin() && !$file->isOwnedBy($user)) {
            abort(403);
        }

        Storage::disk('local')->delete($file->path);
        $file->delete();

        return back()->with('success', __('Fichier supprime.'));
    }
}
