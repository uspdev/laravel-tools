<div class="list-group div-scroll">
  {{-- @foreach ($folders as $folder)
    <div class="list-group-item">
      @php
        \Rap2hpoutre\LaravelLogViewer\LaravelLogViewer::DirectoryTreeStructure($storage_path, $structure);
      @endphp

    </div>
  @endforeach --}}
  @foreach ($files as $file)
    <a href="{{ route('laravel-tools.logs') }}?l={{ \Illuminate\Support\Facades\Crypt::encrypt($file) }}"
      class="list-group-item @if ($current_file == $file) llv-active @endif">
      {{ $file }}
    </a>
  @endforeach
</div>
