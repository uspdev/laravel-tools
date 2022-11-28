@extends(config('laravel-tools.template'))

@section('content')
  <h4>Dashboard</h4>

  <div>
    <div class="h5">{{ $packageName }}</div>
    <ul>
      <li>Versão: {{ appVersion() }}</li>
      <li>@include('laravel-tools::partials.badge-debug')</li>
    </ul>
  </div>

  @include('laravel-tools::partials.laravel-tools')
  @include('laravel-tools::partials.laravel-replicado')
  @include('laravel-tools::partials.laravel-usp-theme')
  @include('laravel-tools::partials.senhaunica-socialite')

  <div>
    <div class="h5">WS Foto</div>
    <ul>
      <li>Versão: {{ appVersion('uspdev/wsfoto') ?? 'não instalado' }}</li>
    </ul>
  </div>
@endsection
