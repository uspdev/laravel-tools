<h4 class="text-danger">Laravel tools Dashboard</h4>

<ul class="nav nav-tabs">
  <li class="nav-item">
    <a class="nav-link {{ $activeTab == 'app' ? 'active' : '' }}" href="{{ route('laravel-tools.app') }}">App</a>
  </li>
  <li class="nav-item">
    <a class="nav-link {{ $activeTab == 'bibliotecas' ? 'active' : '' }}" href="{{ route('laravel-tools.bibliotecas') }}?tab=bibliotecas">Bibliotecas</a>
  </li>
  <li class="nav-item">
    <a class="nav-link {{ $activeTab == 'logs' ? 'active' : '' }}" href="{{ route('laravel-tools.logs') }}">Logs</a>
  </li>
  <li class="nav-item">
    <a class="nav-link {{ $activeTab == 'users' ? 'active' : '' }}" href="{{ route(config('senhaunica.userRoutes') . '.index') }}">Users</a>
  </li>
  <li class="nav-item">
    <a class="nav-link {{ $activeTab == 'backup' ? 'active' : '' }}" href="{{ route('laravel-tools.backup') }}?tab=backup">Backup</a>
  </li>
</ul>
<br>