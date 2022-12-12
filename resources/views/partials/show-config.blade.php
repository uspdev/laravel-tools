@if (config($config))
  @foreach (config($config) as $key => $val)
    <li>{{ $key }}: <b>{!! $formatter::config($key, $val) !!}</b></li>
  @endforeach
@endif
