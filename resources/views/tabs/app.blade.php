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
    <li>Gateway interface: <b>{{ config('laravel-tools.gatewayInterface') }}</b></li>
    <li>Extensões PHP: <b>{{ implode(', ', get_loaded_extensions()) }}</b></li>
    <li>Versão Servidor: <b>{{ config('laravel-tools.serverSoftware') }}</b></li>
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

<div class="row">
  <div class="col-4">
    <div class="h5">Gates</div>
    <ul>
      @foreach (Gate::abilities() as $gate => $value)
        <li>{{ $gate }}</li>
      @endforeach
    </ul>
  </div>
  @if (config('senhaunica.permission'))
    <div class="col-4">
      <div class="h5">Permissions</div>
      <ul>
        @foreach (Spatie\Permission\Models\Permission::all() as $p)
          <li>{{ $p->guard_name }}/{{ $p->name }}</li>
        @endforeach
      </ul>
    </div>
    <div class="col-4">
      <div class="h5">Roles</div>
      <ul>
        @foreach (Spatie\Permission\Models\Role::all() as $r)
          <li>{{ $r->guard_name }}/{{ $r->name }}: {{ $r->permissions->pluck('name')->implode(', ') }}</li>
        @endforeach
      </ul>
    </div>
  @else
    <div class="h5">Permissions desativadas</div>
  @endif
</div>

@include('laravel-usp-theme::blocos.datatable-simples')
<div>
  <div class="h5">Composer</div>
  <table class="table table-sm table-hover datatable-simples dt-paging-10">
    <thead>
      <tr>
        <th>Nome</th>
        <th>Versão</th>
        <th>dev</th>
      </tr>
    </thead>
    <tbody>
      @foreach (Composer\InstalledVersions::getAllRawData()[0]['versions'] as $name => $package)
        <tr>
          <td>{{ $name }}</td>
          <td>
            {{ $package['pretty_version'] ?? ($package['replaced'][0] ?? '-') }}
          </td>
          <td>
            {{ $package['dev_requirement'] ? 'dev' : '' }}
          </td>
        </tr>
        {{-- @dd($package) --}}
      @endforeach
    </tbody>
  </table>

</div>
