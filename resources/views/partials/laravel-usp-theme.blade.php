<div>
  <div class="h5">uspdev/laravel-usp-theme</div>
  <ul>
    <li>Versão: {{ appVersion('uspdev/laravel-usp-theme') ?? 'não instalado' }}</li>
    <li>Skin: <b>{{ config('laravel-usp-theme.skin') }}</b></li>
    <li>Mensagens flash: <b>{{ config('laravel-usp-theme.flash') ? 'true' : 'false' }}</b></li>
  </ul>
</div>
