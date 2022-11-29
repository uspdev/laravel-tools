<h4 class="text-danger">Laravel tools Dashboard</h4>

<ul class="nav nav-tabs">
  <li class="nav-item">
    <a class="nav-link {{ $activeTab == 'app' ? 'active' : '' }}" href="{{ route('laravel-tools.dashboard') }}">App</a>
  </li>
  <li class="nav-item">
    <a class="nav-link {{ $activeTab == 'bibliotecas' ? 'active' : '' }}" href="{{ route('laravel-tools.dashboard') }}?tab=bibliotecas">Bibliotecas</a>
  </li>
  <li class="nav-item">
    <a class="nav-link {{ $activeTab == 'logs' ? 'active' : '' }}" href="{{ route('laravel-tools.logs') }}">Logs</a>
  </li>
  <li class="nav-item">
    <a class="nav-link {{ $activeTab == 'users' ? 'active' : '' }}" href="{{ route('senhaunica-users.index') }}">Users</a>
  </li>
</ul>
<br>
