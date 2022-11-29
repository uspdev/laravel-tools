@extends(config('laravel-tools.template'))

@section('content')
  @include('laravel-tools::partials.dashboard-menu')
  @include('laravel-tools::tabs.' . $activeTab)
@endsection
