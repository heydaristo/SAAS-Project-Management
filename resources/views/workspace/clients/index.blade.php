@extends('template')

@php
    $title = "Client List";
    $pretitle = "klien/list";
@endphp


@section('body')
    @include('workspace.component.letsupgrade')
    <div class="row row-deck row-cards">
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
                    <table class="table card-table table-vcenter text-nowrap datatable table-hover">
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
                                <tr onclick="window.location='{{ route('workspace.clients.show', $clients->id) }}'" style="cursor: pointer;">
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $clients->name }}</td>
                                    <td>{{ $clients->email }}</td>
                                    <td>{{ $clients->address }}</td>
                                    <td>{{ $clients->no_telp }}</td>
                                    <td></td>
                                </tr>
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
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modal2Label">Add new client</h5>
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
                                                <textarea class="form-control mt-1  " name="address" rows="3" placeholder="Masukkan Alamat"></textarea>
                                                @error('address')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col-lg-6">
                                                      <label class="form-label">State</label>
                                                      <input type="text" name="state" class="form-control" placeholder="Masukan Negaramu">
                                                  </div>
                                                  <div class="col-lg-6">
                                                      <label class="form-label">City</label>
                                                      <input type="text" class="form-control" name="city" placeholder="Masukan Kotamu">
                                                  </div>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col-lg-6">
                                                      <label class="form-label">Province</label>
                                                      <input type="text" name="region" class="form-control" placeholder="Masukan Provinsimu">
                                                  </div>
                                                  <div class="col-lg-6">
                                                      <label class="form-label">Zip Code</label>
                                                      <input type="number" class="form-control" name="postal_code" placeholder="Masukan Kodepos mu">
                                                  </div>
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
