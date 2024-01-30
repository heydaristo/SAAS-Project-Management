{{-- Modals Edit --}}
@foreach($client as $clients)
<div class="modal fade" id="tambah_client" tabindex="-1" aria-labelledby="Tambah Client" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <form class="modal-content" action="{{ route('workspace.clients.update', $clients->id) }}" method="post">
      @csrf
      @method('PUT')
  <div class="mb-3">
      <label class="form-label">Nama Client</label>
      <input type="text" name="nama_sekolah" class="form-control" placeholder="Masukkan Nama" value="{{ $clients->name }}" >
    </div>
  <div class="mb-3">
      <label class="form-label">Alamat</label>
      <input type="text" name="alamat" class="form-control" placeholder="Masukkan Alamat" value="{{ $clients->address }}">
    </div>
  <div class="mb-3">
      <label class="form-label">No Telp</label>
      <input type="text" name="jurusan" class="form-control" placeholder="Masukan Jurusan" value="{{ $clients->no_telp }}">
    </div>
  <div class="mb-3">
      <input type="submit" value="Simpan" class="btn btn-primary">
  </div>
</form>
  </div>
</div>
@endforeach
