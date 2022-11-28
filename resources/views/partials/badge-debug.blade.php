@if (config('app.debug'))
  <span class="badge badge-danger" data-toggle="tooltip" title="Modo debug habilitado">debug</span>
@else
  <span class="badge badge-secondary" data-toggle="tooltip" title="Modo debug desativado"><s>debug</s></span>
@endif
