<a
  href="{{ route('laravel-tools.logs') }}?dl={{ \Illuminate\Support\Facades\Crypt::encrypt($current_file) }}{{ $current_folder ? '&f=' . \Illuminate\Support\Facades\Crypt::encrypt($current_folder) : '' }}">
  <span class="fa fa-download"></span> Download file
</a>
-
<a id="clean-log"
  href="{{ route('laravel-tools.logs') }}?clean={{ \Illuminate\Support\Facades\Crypt::encrypt($current_file) }}{{ $current_folder ? '&f=' . \Illuminate\Support\Facades\Crypt::encrypt($current_folder) : '' }}">
  <span class="fa fa-sync"></span> Clean file
</a>
-
<a id="delete-log"
  href="{{ route('laravel-tools.logs') }}?del={{ \Illuminate\Support\Facades\Crypt::encrypt($current_file) }}{{ $current_folder ? '&f=' . \Illuminate\Support\Facades\Crypt::encrypt($current_folder) : '' }}">
  <span class="fa fa-trash"></span> Delete file
</a>
@if (count($files) > 1)
  -
  <a id="delete-all-log"
    href="{{ route('laravel-tools.logs') }}?delall=true{{ $current_folder ? '&f=' . \Illuminate\Support\Facades\Crypt::encrypt($current_folder) : '' }}">
    <span class="fa fa-trash-alt"></span> Delete all files
  </a>
@endif
