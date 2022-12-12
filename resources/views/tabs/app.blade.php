<div>
  <div class="h5">{{ $packageName }}</div>
  <ul>
    <li>Versão: {!! $formatter::appVersion($packageName) !!}</li>
    @include('laravel-tools::partials.show-config', ['config' => 'app'])
  </ul>
</div>

<div>
  <div class="h5">Ambiente</div>
  <ul>
    <li>Versão laravel: {{ app()->version() }}</li>
    <li>Versão PHP: {{ phpversion() }}</li>
    <li>Gateway interface: {{ $_SERVER['GATEWAY_INTERFACE'] }}</li>
    <li>Extensões PHP: {{ implode(', ', get_loaded_extensions()) }}</li>
    <li>Versão Servidor: {{ $_SERVER['SERVER_SOFTWARE'] }}</li>
  </ul>
</div>

<div>
  <div class="h5">Database</div>
  <ul>
    <li>Default: {{ config('database.default') }}</li>
    <li>DB Version: {{ $formatter::dbVersion() }}</li>
    @include('laravel-tools::partials.show-config', [
        'config' => 'database.connections.' . config('database.default'),
    ])
  </ul>
</div>
