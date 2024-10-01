@if (env('APP_ENV') == 'local')
  <span class="badge badge-success">Sistema local</span>
@else
  @if (env('APP_ENV') == 'production')
    <span class="badge badge-danger"><strong>SISTEMA EM PRODUÇÃO</strong></span>
  @endif
@endif
