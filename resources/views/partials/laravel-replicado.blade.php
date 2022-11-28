<div>
  <div class="h5">uspdev/laravel-replicado</div>
  <ul>
    <li>Versão: {{ appVersion('uspdev/laravel-replicado') ?? 'não instalado' }}</li>
    <li>Versão replicado: {{ appVersion('uspdev/replicado') ?? 'não instalado' }}</li>
    <li>Cache: <b>{{ config('replicado.usarCache') ? 'true' : 'false' }}</b></li>
    <li>Debug: <b>{{ config('replicado.debug') ? 'true' : 'false' }}</b></li>
    <li>Logs: <b>{{ config('replicado.pathlog') }}</b></li>
  </ul>
</div>
