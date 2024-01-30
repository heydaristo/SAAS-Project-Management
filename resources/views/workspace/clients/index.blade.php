@extends('template')

@php
  $title= "Client List";
@endphp


@section('body')



<div class="row row-deck row-cards">
@include('workspace.header')
<div class="col-12">
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Search Filter</h3>
    </div>
    <div class="card-body border-bottom py-3">
      <div class="d-flex">
        <div class="text-muted">
          <select class="form-select" aria-label="Default select example">
            <option selected>Select Plan</option>
            <option value="1">One</option>
            <option value="2">Two</option>
            <option value="3">Three</option>
          </select>
        </div>
        <div class="text-muted ms-3">
          <select class="form-select" aria-label="Default select example">
            <option selected>Select Plan</option>
            <option value="1">One</option>
            <option value="2">Two</option>
            <option value="3">Three</option>
          </select>
        </div>
        <div class="ms-auto me-3">
          <select class="form-select" id="select">
            <option value="5">5</option>
            <option value="10">10</option>
            <option value="20">20</option>
            <option value="50">50</option>
            <!-- Tambahkan opsi lain sesuai kebutuhan -->
        </select>
      </div>
      <button type="button" class="btn btn-primary font-weight-bolder" data-bs-toggle="modal"
      data-bs-target="#tambah_client">
      New Client
      </button>
      </div>
    </div>
    <div class="table-responsive">
      <table class="table card-table table-vcenter text-nowrap datatable">
        <thead>
          <tr>
            <th class="w-1">No.
              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-sm icon-thick" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 15l6 -6l6 6" /></svg>
            </th>
            <th>Client</th>
            <th>Alamat</th>
            <th>Nomor HP</th>
            {{-- <th>Status</th> --}}
            <th class="w-1"></th>
          </tr>
        </thead>
        <tbody>
          @foreach($client as $clients)
          <tr>
            <td>{{ $i++ }}</td>
            <td>{{ $clients->name }}</td>
            <td>{{ $clients->address }}</td>
            <td>{{ $clients->no_telp }}</td>
            <td><div class="btn-group mb-1 dropleft ">
              <div class="dropdown dropleft">
                <button class="btn btn-primary dropdown-toggle me-1" type="button" id="dropdownMenuButtonIcon" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Aksi
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                  <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalEdit-{{$clients->id}}">
                    Edit
                  </button>
                  <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalDelete">Delete</button>
                </div>
              </div>
          </div></td>
          </tr>
          @endforeach

        </tbody>
      </table>
    </div>
    <div class="card-footer d-flex align-items-center">
      <p class="m-0 text-muted">Showing <span>1</span> to <span>8</span> of <span>16</span> entries</p>
      <ul class="pagination m-0 ms-auto">
        <li class="page-item disabled">
          <a class="page-link" href="#" tabindex="-1" aria-disabled="true">
            <!-- Download SVG icon from http://tabler-icons.io/i/chevron-left -->
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M15 6l-6 6l6 6" /></svg>
            prev
          </a>
        </li>
        <li class="page-item"><a class="page-link" href="#">1</a></li>
        <li class="page-item active"><a class="page-link" href="#">2</a></li>
        <li class="page-item"><a class="page-link" href="#">3</a></li>
        <li class="page-item"><a class="page-link" href="#">4</a></li>
        <li class="page-item"><a class="page-link" href="#">5</a></li>
        <li class="page-item">
          <a class="page-link" href="#">
            next <!-- Download SVG icon from http://tabler-icons.io/i/chevron-right -->
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 6l6 6l-6 6" /></svg>
          </a>
        </li>
      </ul>
    </div>
  </div>
</div>
</div>

{{-- Modal Dialog --}}
<div class="modal fade" id="tambah_client" tabindex="-1" aria-labelledby="modal2Label" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="modal2Label">Modal 2 Title</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form action="{{ route('workspace.clients.store') }}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="row">
                <div class="col-md-12 mt-2">
                    <div class="form-group">
                        <label for="nama_cabang">Nama Client</label>
                        <input type="text" class="form-control mt-1" name="name" placeholder="Masukkan nama client" required />
                        @error('name')
                        <div class="invalid-feedback">
                          {{ $message }}
                      </div>
                      @enderror
                    </div>
                </div>
                <div class="col-md-12 mt-2">
                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" class="form-control mt-1" id="address" name="address" placeholder="Masukkan alamat" required />
                        @error('address')
                        <div class="invalid-feedback">
                          {{ $message }}
                      </div>
                      @enderror
                    </div>
                <div class="col-md-12 mt-2">
                    <div class="form-group">
                        <label for="no_telp">Nomor HP</label>
                        <input type="text" class="form-control mt-1" id="no_telp" name="no_telp" placeholder="Masukkan Nomor HP" required />
                        @error('no_telp')
                        <div class="invalid-feedback">
                          {{ $message }}
                      </div>
                      @enderror
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
        <button type="submit" class="btn btn-primary mr-2">Tambah</button>
    </div>
      </div>
  </div>
</div>

{{-- Modal Edit --}}
@foreach ($client as $clients)
  
<div class="modal fade" id="modalEdit-{{$clients->id}}" tabindex="-1" aria-labelledby="modal2Label" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="modal2Label">Edit Client</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form action="{{ route('workspace.clients.update', $clients->id) }}" method="post">
              @csrf
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
</div>
@endforeach

@endsection