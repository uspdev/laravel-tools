<div>
  <div class="h5">uspdev/senhaunica-socialite</div>
  <ul>
    <li>Versão: {!! $formatter::appVersion('uspdev/senhaunica-socialite') !!} </li>
    @include('laravel-tools::partials.show-config', ['config' => 'senhaunica'])
    <li>---</li>
    @include('laravel-tools::partials.show-config', ['config' => 'services.senhaunica'])
  </ul>
</div>
