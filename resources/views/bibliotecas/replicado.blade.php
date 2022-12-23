<div>
  <div class="h5">uspdev/replicado</div>
  <ul>
    @if (hasReplicado())
      <li>Versão: {!! $formatter::appVersion('uspdev/replicado') !!}</li>
      @foreach (\Uspdev\Replicado\Replicado::getInstance()->getConfig() as $key => $val)
        <li>{{ $key }}: <b>{{ $val }}</b></li>
      @endforeach
      @if (config('replicado.usarCache'))
        <li>
          cache enabled:
          <b>{{ json_encode(\Uspdev\Replicado\Replicado::getInstance()->getCacheInstance()->status()) }}</b>
        </li>
      @endif
    @else
      <li>Não instalado</li>
    @endif
  </ul>
</div>
