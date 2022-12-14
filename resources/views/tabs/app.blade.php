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
    <li>Versão laravel: <b>{{ app()->version() }}</b></li>
    <li>Config está em cache: <b>{{ app()->configurationIsCached() ? 'true' : 'false' }}</b></li>
    <li>Route está em cache: <b>{{ app()->routesAreCached() ? 'true' : 'false' }}</b></li>
    <li>Versão PHP: <b>{{ phpversion() }}</b></li>
    <li>Gateway interface: <b>{{ $_SERVER['GATEWAY_INTERFACE'] }}</b></li>
    <li>Extensões PHP: <b>{{ implode(', ', get_loaded_extensions()) }}</b></li>
    <li>Versão Servidor: <b>{{ $_SERVER['SERVER_SOFTWARE'] }}</b></li>
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
