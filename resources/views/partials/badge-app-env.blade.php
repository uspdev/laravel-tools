@if (config('app.env') == 'local')
  <span class="badge badge-success">Sistema local</span>
@else
  @if (config('app.env') == 'production')
    <span class="badge badge-danger"><strong>SISTEMA EM PRODUÇÃO</strong></span>
  @endif
@endif
