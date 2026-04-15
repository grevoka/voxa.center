@extends('layouts.admin')

@section('title', __('Shared files'))

@section('content')
<div class="admin-header" style="display:flex;align-items:center;justify-content:space-between">
  <div>
    <h1>{{ __('Shared files') }}</h1>
    <p>{{ __('Upload and share files with backoffice users.') }}</p>
  </div>
  <button type="button" class="btn-admin primary" style="padding:10px 20px" onclick="document.getElementById('uploadModal').style.display='flex'">
    <i class="bi bi-cloud-arrow-up-fill"></i> {{ __('Upload files') }}
  </button>
</div>

{{-- Upload modal --}}
<div id="uploadModal" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,.5);z-index:999;align-items:center;justify-content:center" onclick="if(event.target===this)this.style.display='none'">
  <div style="background:#fff;border-radius:16px;padding:32px;width:100%;max-width:500px;box-shadow:0 20px 60px rgba(0,0,0,.2)">
    <h3 style="font-family:var(--font);font-size:20px;font-weight:700;color:var(--navy);margin:0 0 20px">
      <i class="bi bi-cloud-arrow-up" style="color:var(--mid)"></i> {{ __('Upload files') }}
    </h3>
    <form action="{{ route('admin.files.upload') }}" method="POST" enctype="multipart/form-data" onsubmit="return validateFiles()">
      @csrf
      <div id="dropZone" style="border:2px dashed var(--border);border-radius:12px;padding:40px 20px;text-align:center;cursor:pointer;transition:all .15s;margin-bottom:20px"
           ondragover="event.preventDefault();this.style.borderColor='var(--mid)';this.style.background='rgba(59,130,246,.05)'"
           ondragleave="this.style.borderColor='var(--border)';this.style.background=''"
           ondrop="event.preventDefault();this.style.borderColor='var(--border)';this.style.background='';document.getElementById('fileInput').files=event.dataTransfer.files;updateFileList()"
           onclick="document.getElementById('fileInput').click()">
        <i class="bi bi-file-earmark-arrow-up" style="font-size:32px;color:var(--mid)"></i>
        <p style="color:var(--slate);font-size:14px;margin:10px 0 0">{{ __('Drag files here or click to browse') }}</p>
        <p style="color:var(--slate);font-size:11px;margin:4px 0 0">{{ __('Max 1 GB per file') }} &middot; {{ __('10 files max') }}</p>
      </div>
      <input type="file" id="fileInput" name="files[]" multiple style="display:none" onchange="updateFileList()">
      <div id="fileList" style="margin-bottom:16px"></div>
      <div id="uploadError" style="display:none;background:#FEF2F2;border:1.5px solid #FECACA;border-radius:10px;padding:10px 16px;color:#DC2626;font-weight:600;font-size:13px;margin-bottom:16px">
        <i class="bi bi-exclamation-triangle-fill"></i> <span id="uploadErrorMsg"></span>
      </div>
      <div style="display:flex;justify-content:flex-end;gap:10px">
        <button type="button" class="btn-admin outline" onclick="document.getElementById('uploadModal').style.display='none'">{{ __('Cancel') }}</button>
        <button type="submit" class="btn-admin primary" id="uploadBtn" disabled><i class="bi bi-upload"></i> {{ __('Upload') }}</button>
      </div>
    </form>
  </div>
</div>

{{-- Files table --}}
<div class="table-card">
  <div class="header">
    <h3><i class="bi bi-folder2-open" style="color:var(--mid)"></i> {{ $files->count() }} {{ __('file(s)') }}</h3>
  </div>
  <table>
    <thead>
      <tr>
        <th></th>
        <th>{{ __('Name') }}</th>
        <th>{{ __('Owner') }}</th>
        <th>{{ __('Shared with') }}</th>
        <th>{{ __('Size') }}</th>
        <th>{{ __('Date') }}</th>
        @if(Auth::user()->isAdmin())
        <th style="text-align:center">{{ __('Stats') }}</th>
        @endif
        <th></th>
      </tr>
    </thead>
    <tbody>
      @forelse($files as $file)
      <tr>
        <td style="width:36px;text-align:center">
          <i class="bi {{ $file->iconClass() }}" style="font-size:20px;color:var(--mid)"></i>
        </td>
        <td style="font-weight:600">
          @if(str_starts_with($file->mime_type, 'video/'))
            <a href="#" onclick="event.preventDefault();openVideoModal('{{ route('admin.files.stream', $file) }}', '{{ addslashes($file->original_name) }}')" style="color:var(--navy);text-decoration:none" onmouseover="this.style.color='var(--mid)'" onmouseout="this.style.color='var(--navy)'">
              {{ $file->original_name }}
            </a>
          @elseif($file->mime_type === 'application/pdf')
            <a href="{{ route('admin.files.preview', $file) }}" target="_blank" style="color:var(--navy);text-decoration:none" onmouseover="this.style.color='var(--mid)'" onmouseout="this.style.color='var(--navy)'">
              {{ $file->original_name }}
            </a>
          @else
            <a href="{{ route('admin.files.download', $file) }}" style="color:var(--navy);text-decoration:none" onmouseover="this.style.color='var(--mid)'" onmouseout="this.style.color='var(--navy)'">
              {{ $file->original_name }}
            </a>
          @endif
        </td>
        <td>
          <span style="font-size:13px;color:var(--slate)">{{ $file->owner->name }}</span>
          @if($file->user_id === Auth::id())
            <span style="font-size:10px;font-weight:700;color:var(--navy);background:var(--lav-sub);border:1px solid var(--lav-bdr);border-radius:4px;padding:1px 6px;margin-left:4px">{{ __('You') }}</span>
          @endif
        </td>
        <td>
          @if($file->sharedWith->isEmpty())
            <span style="font-size:12px;color:var(--slate)">—</span>
          @else
            <div style="display:flex;flex-wrap:wrap;gap:4px">
              @foreach($file->sharedWith as $shared)
                <span style="display:inline-flex;align-items:center;gap:3px;background:var(--lav-sub);border:1px solid var(--lav-bdr);border-radius:6px;padding:2px 8px;font-size:11px;font-weight:600;color:var(--navy)">
                  {{ $shared->name }}
                  @if(Auth::user()->isAdmin() || $file->isOwnedBy(Auth::user()))
                    <form action="{{ route('admin.files.unshare', [$file, $shared]) }}" method="POST" style="display:inline">
                      @csrf
                      @method('DELETE')
                      <button type="submit" style="background:none;border:none;cursor:pointer;color:#DC2626;font-size:10px;padding:0;line-height:1" title="{{ __('Remove access') }}">
                        <i class="bi bi-x-circle-fill"></i>
                      </button>
                    </form>
                  @endif
                </span>
              @endforeach
            </div>
          @endif
        </td>
        <td style="font-size:13px;color:var(--slate);white-space:nowrap">{{ $file->humanSize() }}</td>
        <td style="font-size:13px;color:var(--slate);white-space:nowrap">{{ $file->created_at->format('d/m/Y H:i') }}</td>
        @if(Auth::user()->isAdmin())
        <td style="text-align:center">
          <div style="display:inline-flex;gap:8px;font-size:11px;color:var(--slate)">
            <span title="{{ __('Downloads') }}" style="display:inline-flex;align-items:center;gap:2px">
              <i class="bi bi-download" style="font-size:12px"></i> {{ $file->download_count ?? 0 }}
            </span>
            @if(str_starts_with($file->mime_type, 'video/'))
            <span title="{{ __('Views') }}" style="display:inline-flex;align-items:center;gap:2px">
              <i class="bi bi-play-circle" style="font-size:12px"></i> {{ $file->stream_count ?? 0 }}
            </span>
            @elseif($file->mime_type === 'application/pdf')
            <span title="{{ __('Views') }}" style="display:inline-flex;align-items:center;gap:2px">
              <i class="bi bi-eye" style="font-size:12px"></i> {{ $file->preview_count ?? 0 }}
            </span>
            @endif
          </div>
        </td>
        @endif
        <td>
          <div style="display:flex;gap:6px;justify-content:flex-end">
            @if(str_starts_with($file->mime_type, 'video/'))
              <button type="button" class="btn-admin outline" style="padding:5px 10px;font-size:12px" title="{{ __('Play') }}"
                onclick="openVideoModal('{{ route('admin.files.stream', $file) }}', '{{ addslashes($file->original_name) }}')">
                <i class="bi bi-play-circle"></i>
              </button>
            @endif
            <a href="{{ route('admin.files.download', $file) }}" class="btn-admin outline" style="padding:5px 10px;font-size:12px" title="{{ __('Download') }}">
              <i class="bi bi-download"></i>
            </a>
            @if(Auth::user()->isAdmin() || $file->isOwnedBy(Auth::user()))
              <button type="button" class="btn-admin outline" style="padding:5px 10px;font-size:12px" title="{{ __('Share') }}"
                onclick="openShareModal({{ $file->id }}, {{ json_encode($file->sharedWith->pluck('id')) }})">
                <i class="bi bi-share"></i>
              </button>
              <form action="{{ route('admin.files.destroy', $file) }}" method="POST" onsubmit="return confirm('{{ __('Delete this file?') }}')" style="display:inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-admin danger" style="padding:5px 10px;font-size:12px" title="{{ __('Delete') }}">
                  <i class="bi bi-trash3"></i>
                </button>
              </form>
            @endif
          </div>
        </td>
      </tr>
      @empty
      <tr>
        <td colspan="{{ Auth::user()->isAdmin() ? 8 : 7 }}" style="text-align:center;color:var(--slate);padding:40px">
          <i class="bi bi-cloud-arrow-up" style="font-size:32px;display:block;margin-bottom:8px;color:var(--border)"></i>
          {{ __('No files yet. Click "Upload files" to get started.') }}
        </td>
      </tr>
      @endforelse
    </tbody>
  </table>
</div>

{{-- Share modal --}}
<div id="shareModal" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,.5);z-index:999;align-items:center;justify-content:center" onclick="if(event.target===this)this.style.display='none'">
  <div style="background:#fff;border-radius:16px;padding:32px;width:100%;max-width:440px;box-shadow:0 20px 60px rgba(0,0,0,.2)">
    <h3 style="font-family:var(--font);font-size:20px;font-weight:700;color:var(--navy);margin:0 0 6px">
      <i class="bi bi-share" style="color:var(--mid)"></i> {{ __('Share file') }}
    </h3>
    <p style="font-size:13px;color:var(--slate);margin:0 0 20px">{{ __('Select users who will have access.') }}</p>
    <form id="shareForm" method="POST">
      @csrf
      @method('PUT')
      <div style="max-height:300px;overflow-y:auto;margin-bottom:20px">
        @foreach($users as $u)
        <label style="display:flex;align-items:center;gap:10px;padding:10px 12px;border-radius:8px;cursor:pointer;transition:background .1s" onmouseover="this.style.background='var(--bg)'" onmouseout="this.style.background=''">
          <input type="checkbox" name="user_ids[]" value="{{ $u->id }}" class="share-checkbox" data-user-id="{{ $u->id }}"
            style="width:18px;height:18px;accent-color:var(--mid);cursor:pointer">
          <div>
            <div style="font-weight:600;font-size:14px;color:var(--ink)">{{ $u->name }}</div>
            <div style="font-size:12px;color:var(--slate)">{{ $u->email }}
              <span style="margin-left:4px;font-size:10px;font-weight:700;color:var(--navy);background:var(--lav-sub);border-radius:4px;padding:1px 6px">{{ $u->roleName() }}</span>
            </div>
          </div>
        </label>
        @endforeach
        @if($users->isEmpty())
          <p style="text-align:center;color:var(--slate);padding:20px;font-size:14px">{{ __('No other users.') }}</p>
        @endif
      </div>
      <div style="display:flex;justify-content:flex-end;gap:10px">
        <button type="button" class="btn-admin outline" onclick="document.getElementById('shareModal').style.display='none'">{{ __('Cancel') }}</button>
        <button type="submit" class="btn-admin primary"><i class="bi bi-check-lg"></i> {{ __('Save') }}</button>
      </div>
    </form>
  </div>
</div>

{{-- Video modal --}}
<div id="videoModal" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,.85);z-index:1000;align-items:center;justify-content:center;flex-direction:column" onclick="if(event.target===this){this.style.display='none';document.getElementById('videoPlayer').pause()}">
  <div style="position:relative;width:90%;max-width:960px">
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:12px">
      <span id="videoTitle" style="color:#fff;font-weight:600;font-size:15px"></span>
      <div style="display:flex;gap:8px">
        <button onclick="toggleFullscreen()" style="background:rgba(255,255,255,.15);border:none;color:#fff;border-radius:8px;padding:6px 12px;cursor:pointer;font-size:13px">
          <i class="bi bi-arrows-fullscreen"></i> {{ __('Fullscreen') }}
        </button>
        <button onclick="document.getElementById('videoModal').style.display='none';document.getElementById('videoPlayer').pause()" style="background:rgba(255,255,255,.15);border:none;color:#fff;border-radius:8px;padding:6px 12px;cursor:pointer;font-size:13px">
          <i class="bi bi-x-lg"></i>
        </button>
      </div>
    </div>
    <video id="videoPlayer" controls style="width:100%;border-radius:12px;background:#000;max-height:70vh"></video>
  </div>
</div>

<script>
const MAX_SIZE = 1024 * 1024 * 1024; // 1 Go
const MAX_FILES = 10;

function updateFileList() {
  const input = document.getElementById('fileInput');
  const list = document.getElementById('fileList');
  const btn = document.getElementById('uploadBtn');
  const errBox = document.getElementById('uploadError');
  const errMsg = document.getElementById('uploadErrorMsg');
  list.innerHTML = '';
  errBox.style.display = 'none';

  if (input.files.length > 0) {
    let hasError = false;

    if (input.files.length > MAX_FILES) {
      errMsg.textContent = '{{ __("You can upload a maximum of 10 files at once.") }}';
      errBox.style.display = 'block';
      hasError = true;
    }

    Array.from(input.files).forEach(f => {
      const size = f.size >= 1048576 ? (f.size/1048576).toFixed(1)+' Mo' : (f.size/1024).toFixed(0)+' Ko';
      const tooLarge = f.size > MAX_SIZE;
      if (tooLarge && !hasError) {
        errMsg.textContent = '{{ __("One or more files exceed the 1 GB limit.") }}';
        errBox.style.display = 'block';
        hasError = true;
      }
      const color = tooLarge ? '#DC2626' : 'var(--mid)';
      const bg = tooLarge ? '#FEF2F2' : 'var(--bg)';
      list.innerHTML += '<div style="display:flex;align-items:center;gap:8px;padding:6px 10px;background:'+bg+';border-radius:8px;margin-bottom:4px;font-size:13px"><i class="bi bi-file-earmark" style="color:'+color+'"></i><span style="flex:1;font-weight:500;color:'+(tooLarge?'#DC2626':'inherit')+'">'+f.name+'</span><span style="color:'+(tooLarge?'#DC2626':'var(--slate)')+';font-size:11px">'+size+(tooLarge?' ⚠':'')+'</span></div>';
    });

    btn.disabled = hasError;
  } else {
    btn.disabled = true;
  }
}

function validateFiles() {
  const input = document.getElementById('fileInput');
  if (input.files.length > MAX_FILES) return false;
  for (const f of input.files) {
    if (f.size > MAX_SIZE) return false;
  }
  return true;
}

function openShareModal(fileId, sharedIds) {
  const modal = document.getElementById('shareModal');
  const form = document.getElementById('shareForm');
  form.action = '/admin/files/' + fileId + '/share';
  document.querySelectorAll('.share-checkbox').forEach(cb => {
    cb.checked = sharedIds.includes(parseInt(cb.dataset.userId));
  });
  modal.style.display = 'flex';
}

function openVideoModal(url, name) {
  const modal = document.getElementById('videoModal');
  const video = document.getElementById('videoPlayer');
  document.getElementById('videoTitle').textContent = name;
  video.src = url;
  modal.style.display = 'flex';
  video.play();
}

function toggleFullscreen() {
  const video = document.getElementById('videoPlayer');
  if (video.requestFullscreen) video.requestFullscreen();
  else if (video.webkitRequestFullscreen) video.webkitRequestFullscreen();
}
</script>
@endsection
