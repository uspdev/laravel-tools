<div>
  <div class="h5">uspdev/senhaunica-socialite</div>
  <ul>
    <li>Versão: {{ appVersion('uspdev/senhaunica-socialite') ?? 'não instalado' }}</li>
    <li>Permission: <b>{{ config('senhaunica.permission') ? 'true' : 'false' }}</b></li>
    <li>Users
      <ul>
        <li>Rota: <b>{{ config('senhaunica.prefix') }}/{{ config('senhaunica.userRoutes') }}</b></li>
        <li>Somente usuários locais: onlyLocalUsers=<b>{{ config('senhaunica.onlyLocalUsers') ? 'true' : 'false' }}</b>
        </li>
        <li>Remover usuários: destroyUsers=<b>{{ config('senhaunica.destroyUser') ? 'true' : 'false' }}</b></li>
        <li>Drop Permissions: <b>{{ config('senhaunica.dropPermissions') ? 'true' : 'false' }}</b></li>
      </ul>
    </li>
    <li>Debug: <b>{{ config('senhaunica.debug') ? 'true' : 'false' }}</b></li>

  </ul>
</div>
