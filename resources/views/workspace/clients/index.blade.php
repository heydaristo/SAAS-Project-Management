@extends('template')

@php
    $title = 'Client List';
@endphp


@section('body')
    @include('workspace.component.letsupgrade')
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
                        <form action="{{ route('workspace.clients.checklimit', ['id' => Auth::user()->id]) }}"
                            method="GET">
                            @csrf
                            <button type="submit" class="btn btn-primary font-weight-bolder" data-bs-toggle="modal">
                                New Client
                            </button>
                        </form>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap datatable">
                        <thead>
                            <tr>
                                <th class="w-1">No.
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-sm icon-thick" width="24"
                                        height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                        fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M6 15l6 -6l6 6" />
                                    </svg>
                                </th>
                                <th>Client</th>
                                <th>Email</th>
                                <th>Alamat</th>
                                <th>Nomor HP</th>
                                <th>Email</th>
                                {{-- <th>Status</th> --}}
                                <th class="w-1"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                if($only5 == true){
                                    $i = 1;
                                }else{
                                    $i = 1 + ($client->currentPage() - 1) * $client->perPage();
                                }
                            @endphp
                            @foreach ($client as $clients)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $clients->name }}</td>
                                    <td>{{ $clients->email }}</td>
                                    <td>{{ $clients->address }}</td>
                                    <td>{{ $clients->no_telp }}</td>
                                    <td>{{ $clients->email }}</td>
                                    <td>
                                        <div class="btn-group mb-1 dropleft ">
                                            <div class="dropdown dropleft">
                                                <button class="btn btn-primary dropdown-toggle me-1" type="button"
                                                    id="dropdownMenuButtonIcon" data-bs-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="false">
                                                    Aksi
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <button class="dropdown-item" data-bs-toggle="modal"
                                                        data-bs-target="#modalEdit-{{ $clients->id }}">
                                                        Edit
                                                    </button>
                                                    <button class="dropdown-item" data-bs-toggle="modal"
                                                        data-bs-target="#modalDelete-{{ $clients->id }}">Delete</button>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                {{-- Edit Modals --}}
                                <div class="modal modal-blur fade" id="modalEdit-{{ $clients->id }}" tabindex="-1"
                                    role="dialog" aria-hidden="true">
                                    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <form action="{{ route('workspace.clients.update', ['id' => $clients->id]) }}"
                                                method="POST" enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Edit Client</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label class="form-label">Nama Client</label>
                                                        <input type="text" name="name" class="form-control"
                                                            placeholder="Masukkan Nama" value="{{ $clients->name }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Email</label>
                                                        <input type="text" name="email" class="form-control"
                                                            placeholder="Masukkan Email" value="{{ $clients->email }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Alamat</label>
                                                        <input type="text" name="address" class="form-control"
                                                            placeholder="Masukkan Alamat" value="{{ $clients->address }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">No Telp</label>
                                                        <input type="text" name="no_telp" class="form-control"
                                                            placeholder="Masukan Jurusan" value="{{ $clients->no_telp }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Email</label>
                                                        <input type="text" name="email" class="form-control"
                                                            placeholder="Masukkan Email" value="{{ $clients->email }}">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <a href="#" class="btn btn-link link-secondary"
                                                        data-bs-dismiss="modal">
                                                        Cancel
                                                    </a>
                                                    <button type="submit" class="btn btn-primary mr-2"
                                                        data-bs-dismiss="modal">
                                                        Edit Client
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                {{-- Modal Hapus --}}

                                <div class="modal modal-blur fade" id="modalDelete-{{ $clients->id }}" tabindex="-1"
                                    role="dialog" aria-hidden="true">
                                    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                            <div class="modal-status bg-danger"></div>
                                            <div class="modal-body text-center py-4">
                                                <!-- Download SVG icon from http://tabler-icons.io/i/alert-triangle -->
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="icon mb-2 text-danger icon-lg" width="24" height="24"
                                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                    fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                    <path d="M12 9v4"></path>
                                                    <path
                                                        d="M10.363 3.591l-8.106 13.534a1.914 1.914 0 0 0 1.636 2.871h16.214a1.914 1.914 0 0 0 1.636 -2.87l-8.106 -13.536a1.914 1.914 0 0 0 -3.274 0z">
                                                    </path>
                                                    <path d="M12 16h.01"></path>
                                                </svg>
                                                <h3>Are you sure?</h3>
                                                <div class="text-secondary">Do you really want to remove client
                                                    {{ $clients->name }}? What you've done cannot be undone.</div>
                                            </div>
                                            <div class="modal-footer">
                                                <div class="w-100">
                                                    <div class="row">
                                                        <form
                                                            action="{{ route('workspace.clients.delete', ['id' => $clients->id]) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <div class="col"><a href="#" class="btn w-100"
                                                                    data-bs-dismiss="modal">
                                                                    Cancel
                                                                </a></div>
                                                            <div class="col"><button class="btn btn-danger w-100"
                                                                    data-bs-dismiss="modal">
                                                                    Delete
                                                                </button></div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach



                        </tbody>
                    </table>
                </div>
                <div class="card-footer d-flex align-items-center ms-auto">
                    @if ($only5 != true)
                    {!! $client->appends(Request::except('page'))->links('pagination::bootstrap-5') !!}
                    @endif
                </div>
                {{-- Modal Dialog --}}
                <div class="modal fade" id="tambah_client" tabindex="-1" aria-labelledby="modal2Label"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modal2Label">Modal 2 Title</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('workspace.clients.store') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12 mt-2">
                                            <div class="form-group">
                                                <label for="nama_cabang">Nama Client</label>
                                                <input type="text" class="form-control mt-1" name="name"
                                                    placeholder="Masukkan nama client" required />
                                                @error('name')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12 mt-2">
                                            <div class="form-group">
                                                <label for="Email">Email</label>
                                                <input type="text" class="form-control mt-1 @error('email')is-invalid @enderror" name="email"
                                                    placeholder="Masukkan Email" required />
                                                @error('email')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12 mt-2">
                                            <div class="form-group">
                                                <label for="address">Address</label>
                                                <input type="text" class="form-control mt-1" id="address"
                                                    name="address" placeholder="Masukkan alamat" required />
                                                @error('address')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="col-md-12 mt-2">
                                                <div class="form-group">
                                                    <label for="no_telp">Nomor HP</label>
                                                    <input type="text" class="form-control mt-1" id="no_telp"
                                                        name="no_telp" placeholder="Masukkan Nomor HP" required />
                                                    @error('no_telp')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-12 mt-2">
                                                <div class="form-group">
                                                    <label for="email">Email</label>
                                                    <input type="text" class="form-control mt-1" id="email"
                                                        name="email" placeholder="Masukkan Email" required />
                                                    @error('email')
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
            </div>
        </div>
    </div>

    {{-- add ajax --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


    @if (session('limit'))
        <script>
            // Pastikan dokumen sudah dimuat sepenuhnya
            document.addEventListener("DOMContentLoaded", function() {
                // Periksa apakah sesi 'aman' bernilai true
                // Tampilkan modal tambah_client
                $('#modal-scrollable').modal('show');
            });
        </script>
    @endif

    @if (session('aman'))
        <script>
            // Pastikan dokumen sudah dimuat sepenuhnya
            document.addEventListener("DOMContentLoaded", function() {
                // Periksa apakah sesi 'aman' bernilai true
                // Tampilkan modal tambah_client
                $('#tambah_client').modal('show');
            });
        </script>
    @endif
@endsection

@section('sweetalert')
    <script>
        // Auto-close the alert messages after 3 seconds (3000 milliseconds)
        setTimeout(function() {
            $('.swal2-popup').fadeOut();
        }, 3000);
    </script>
@endsection
