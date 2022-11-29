<div>
  <div class="h5">{{ $packageName }}</div>
  <ul>
    <li>Versão: {!! $formatter::appVersion($packageName) !!}</li>
    @include('laravel-tools::partials.show-config', ['config' => 'app'])
  </ul>
</div>
