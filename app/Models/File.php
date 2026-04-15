<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class File extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'original_name',
        'path',
        'mime_type',
        'size',
    ];

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function sharedWith(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'file_shares')->withPivot('created_at');
    }

    public function activities(): HasMany
    {
        return $this->hasMany(FileActivity::class);
    }

    public function isOwnedBy(User $user): bool
    {
        return $this->user_id === $user->id;
    }

    public function isSharedWith(User $user): bool
    {
        return $this->sharedWith()->where('user_id', $user->id)->exists();
    }

    public function isAccessibleBy(User $user): bool
    {
        return $user->isAdmin() || $this->isOwnedBy($user) || $this->isSharedWith($user);
    }

    public function humanSize(): string
    {
        $bytes = $this->size;
        if ($bytes >= 1073741824) {
            return number_format($bytes / 1073741824, 2) . ' Go';
        }
        if ($bytes >= 1048576) {
            return number_format($bytes / 1048576, 1) . ' Mo';
        }
        if ($bytes >= 1024) {
            return number_format($bytes / 1024, 0) . ' Ko';
        }
        return $bytes . ' o';
    }

    public function iconClass(): string
    {
        return match (true) {
            str_starts_with($this->mime_type, 'image/') => 'bi-file-earmark-image',
            str_starts_with($this->mime_type, 'video/') => 'bi-file-earmark-play',
            str_contains($this->mime_type, 'pdf') => 'bi-file-earmark-pdf',
            str_contains($this->mime_type, 'zip') || str_contains($this->mime_type, 'tar') => 'bi-file-earmark-zip',
            str_contains($this->mime_type, 'word') || str_contains($this->mime_type, 'document') => 'bi-file-earmark-word',
            str_contains($this->mime_type, 'sheet') || str_contains($this->mime_type, 'excel') => 'bi-file-earmark-excel',
            str_starts_with($this->mime_type, 'text/') => 'bi-file-earmark-text',
            default => 'bi-file-earmark',
        };
    }
}
