<style>
  th,
  td {
    border: 1px solid #ddd;
    padding: 10px;
  }
</style>

<h3>Gerenciamento de Backup</h3>
<div class="d-flex align-items-center">
  <form action="{{ route('laravel-tools.createBackup') }}" method="POST" class="m-2">
    @csrf
    <button type="submit" class="btn btn-success">Criar Backup</button>
  </form>
  <form action="{{ route('laravel-tools.uploadBackup') }}" method="POST" enctype="multipart/form-data"
    class="d-flex align-items-center">
    @csrf
    <label for="backup_file" class="custom-file-upload btn btn-primary m-2" onClick>
      Upload Backup
    </label>
    <input type="file" name="backup_file" id="backup_file" required style="display:none;">
    <button type="submit" class="btn btn-primary" style="display:none;" id="uploadButton">Ok</button>
  </form>
</div>


<table class='mt-1'>
  <thead>
    <tr>
      <th>Nome</th>
      <th>Última modificação</th>
      <th>Tamanho</th>
      <th>Carregar</th>
      <th>Download</th>
      <th>Apagar</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($resultado as $item)
      @php
        $itemName = str_replace([' ', '/', '\\', '.', '_'], '', $item['name']);
      @endphp
      <tr>
        <td>{{ $item['name'] }}</td>
        <td>{{ $item['last_modified'] }} GMT</td>
        <td>{{ $item['size'] }}</td>
        <td>
          <button type="button" class="btn bg-warning" data-toggle="modal" data-target="#modal{{ $itemName }}">
            Restaurar
          </button>
          <div class="modal fade" id="modal{{ $itemName }}" tabindex="-1" role="dialog"
            aria-labelledby="modalLabel{{ $itemName }}" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="modalLabel{{ $itemName }}">
                    Confirmar restauração
                    @include('laravel-tools::partials.badge-app-env')
                  </h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <p>Tem certeza que deseja restaurar {{ $item['name'] }}?</p>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="checkbox{{ $item['name'] }}"
                      onchange="activateRestoreButton('{{ $item['name'] }}')">
                    <label class="form-check-label" for="checkbox{{ $item['name'] }}">
                      Confirmar restauração
                    </label>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                  <form action="{{ route('laravel-tools.loadBackup') }}" method="POST"
                    id="restoreForm{{ $item['name'] }}">
                    @csrf
                    <input type="hidden" name="name" value="{{ $item['name'] }}">
                    <button type="button" class="btn btn-danger" id="restoreButton{{ $item['name'] }}"
                      onclick="confirmRestore('{{ $item['name'] }}')">Restaurar</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </td>
        <td>
          <form action="{{ route('laravel-tools.downloadBackup') }}" method="GET">
            @csrf
            <input type="hidden" name="name" value="{{ $item['name'] }}">
            <button type="submit" class="btn btn-secondary m-1"><i class ='fa fa-download'></i>
              Download</button>
          </form>
        </td>
        <td>
          <form action="{{ route('laravel-tools.deleteBackup') }}" method="POST"
            onsubmit="return confirm(&#39;Tem certeza que deseja apagar {{ $item['name'] }}?&#39;);">
            @csrf
            <input type="hidden" name="name" value="{{ $item['name'] }}">
            <button type="submit" class="btn bg-danger text-white"><i class ='fa fa-trash'></i>
              Apagar</button>
          </form>
        </td>
      </tr>
    @endforeach
  </tbody>
</table>

@section('javascripts_bottom')
  @parent
  <script>
    document.getElementById('backup_file').addEventListener('change', function() {
      const fileName = this.files[0] ? this.files[0].name : 'Upload Backup';
      document.querySelector('.custom-file-upload').textContent = fileName;

      const uploadButton = document.getElementById('uploadButton');
      if (this.files.length > 0) {
        uploadButton.style.display = 'block';
      } else {
        uploadButton.style.display = 'none';
      }
    });

    function activateRestoreButton(itemName) {
      const checkbox = document.getElementById('checkbox' + itemName);
      const restoreButton = document.getElementById('restoreButton' + itemName);
      restoreButton.disabled = !checkbox.checked;
    }

    function confirmRestore(itemName) {
      const checkbox = document.getElementById('checkbox' + itemName);
      if (checkbox.checked) {
        document.getElementById('restoreForm' + itemName).submit();
      }
    }
  </script>
@endsection
