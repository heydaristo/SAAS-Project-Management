@extends('superadmintemplate')

@section('superadminbody')

<div class="row row-deck row-cards">
    {{-- @include('workspace.header')s --}}
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
          data-bs-target="#tambah_admin">
          New Admin
          </button>
          </div>
        </div>
        <div class="table-responsive">
          <table class="table card-table table-vcenter text-nowrap datatable">
            <thead>
              <tr>
                <th class="w-1">No.
                </th>
                <th>Fullname</th>
                <th>Email</th>
                <th>Profession</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach($admins as $admin)
              <tr>
                <td><span class="text-muted">{{ $loop->iteration }}</span></td>
                <td>{{ $admin->fullname }}</td>
                <td>{{ $admin->email }}</td>
                <td>{{ $admin->profession }}</td>
                <td class="text-center">
                    <a href="#" class="btn btn-secondary btn-sm">Edit</a>
                    <a href="#" class="btn btn-danger btn-sm">Delete</a>
                </td>
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
    <div class="modal fade" id="tambah_admin" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Tambah Admin</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <form action="{{ route('superadmin.admin.create') }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  <div class="modal-body">
                      <div class="card-body">
                          <div class="row">
                              <div class="col-md-12 mt-2">
                                  <div class="form-group">
                                      <label for="fullname">Nama Admin</label>
                                      <input type="text" class="form-control mt-1" name="fullname" placeholder="Masukkan nama Admin" required />
                                      @error('fullname')
                                      <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                  </div>
                              </div>
                              <div class="col-md-12 mt-2">
                                  <div class="form-group">
                                      <label for="email">Email</label>
                                      <input type="text" class="form-control mt-1" id="email" name="email" placeholder="Masukkan email" required />
                                      @error('email')
                                      <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                  </div>
                          </div>
                      </div>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                      <button type="submit" class="btn btn-primary mr-2">Tambah</button>
                  </div>
              </form>
          </div>
      </div>
    </div>

@endsection

@section('sweetalert')
<script>
    // Auto-close the alert messages after 3 seconds (3000 milliseconds)
    setTimeout(function() {
        $('.swal2-popup').fadeOut();
    }, 3000);
</script>
@endsection