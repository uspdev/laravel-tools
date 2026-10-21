<div class="list-group div-scroll">
  @foreach ($files as $file)
    <a href="{{ route('laravel-tools.logs') }}?l={{ \Illuminate\Support\Facades\Crypt::encrypt($file) }}"
      class="list-group-item @if ($current_file == $file) llv-active @endif">
      {{ $file }}
    </a>
  @endforeach
</div>
