<div>
  <div class="h5">uspdev/laravel-replicado</div>
  <ul>
    <li>Versão: {!! $formatter::AppVersion('uspdev/laravel-replicado') !!}</a></li>
    <li>Versão replicado: {!! $formatter::appVersion('uspdev/replicado') !!}</li>
    @include('laravel-tools::partials.show-config', ['config' => 'replicado'])
  </ul>
</div>
