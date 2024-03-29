@php
    $title = "admin";
    $pretitle = "admin/list";
@endphp

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
          <div>
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
              @php
              $i = 1 + (($admins->currentPage()-1) * $admins->perPage());
              @endphp
              @foreach($admins as $admin)
              <tr>
                <td><span class="text-muted">{{ $i++ }}</span></td>
                <td>{{ $admin->fullname }}</td>
                <td>{{ $admin->email }}</td>
                <td>{{ $admin->profession }}</td>
                <td class="d-flex gap-3">
                    <a href="#" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#modal_edit-{{ $admin->id }}">
                        Edit
                    </a>
                    <a href="#" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modal_hapus-{{ $admin->id }}">
                        Delete
                    </a>
                </td>
              </tr>
              {{-- edit modal --}}
              <div class="modal modal-blur fade" id="modal_edit-{{ $admin->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                  <div class="modal-content">
                    <form action="{{ route('superadmin.admin.update',['id' => $admin->id]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                        <div class="modal-header">
                        <h5 class="modal-title">Tambah Admin</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Fullname</label>
                            <input type="text" class="form-control" name="fullname" placeholder="Fill with name"  value="{{ $admin->fullname }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" placeholder="Fill with email" value="{{ $admin->email }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" placeholder="Fill with password" >
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Profession</label>
                            <input type="text" class="form-control" name="profession" placeholder="Fill with profession" value="{{ $admin->profession }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Experience Level (years)</label>
                            <input type="number" class="form-control" name="experience_level" placeholder="Fill with Experience Level" value="{{ $admin->experience_level}}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Organization</label>
                            <input type="text" class="form-control" name="organization" placeholder="Fill with Organization" value="{{ $admin->organization }}">
                        </div>
                        </div>
                        <div class="modal-footer">
                        <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                            Cancel
                        </a>
                        <button type="submit" class="btn btn-primary mr-2" data-bs-dismiss="modal">
                            <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
                            Edit Admin
                        </button>
                        </div>
                    </form>
                  </div>
                </div>
              </div>

              {{-- modal hapus --}}
              <div class="modal modal-blur fade" id="modal_hapus-{{ $admin->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                  <div class="modal-content">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="modal-status bg-danger"></div>
                    <div class="modal-body text-center py-4">
                      <!-- Download SVG icon from http://tabler-icons.io/i/alert-triangle -->
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-danger icon-lg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10.24 3.957l-8.422 14.06a1.989 1.989 0 0 0 1.7 2.983h16.845a1.989 1.989 0 0 0 1.7 -2.983l-8.423 -14.06a1.989 1.989 0 0 0 -3.4 0z" /><path d="M12 9v4" /><path d="M12 17h.01" /></svg>
                      <h3>Are you sure?</h3>
                      <div class="text-muted">Do you really want to remove the admin? What you've done cannot be undone.</div>
                    </div>
                    <div class="modal-footer">
                      <div class="w-100">
                        <div class="row">
                            <form action="{{ route('superadmin.admin.delete',['id' => $admin->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <div class="col"><button type="button" class="btn w-100" data-bs-dismiss="modal">
                                    Cancel
                                  </a></div>
                                 <div class="col"><button type="submit"  class="btn btn-danger w-100" data-bs-dismiss="modal">
                                    Delete Admin
                                  </a></div>
                             </form>
                        </div>
                          
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
          {!! $admins->appends(Request::except('page'))->links('pagination::bootstrap-5') !!}

        </div>
      </div>
    </div>
</div>

{{-- Modal Dialog --}}
<div class="modal modal-blur fade" id="tambah_admin" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">
        <form action="{{ route('superadmin.admin.create') }}" method="POST" enctype="multipart/form-data">
        @csrf
            <div class="modal-header">
            <h5 class="modal-title">Tambah Admin</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <div class="mb-3">
                <label class="form-label">Fullname</label>
                <input type="text" class="form-control" name="fullname" placeholder="Fill with name">
            </div>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" name="email" placeholder="Fill with email">
            </div>
            </div>
            <div class="modal-footer">
            <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                Cancel
            </a>
            <button type="submit" class="btn btn-primary mr-2" data-bs-dismiss="modal">
                <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
                Create new Admin
            </button>
            </div>
        </form>
      </div>
    </div>
  </div>
@endsection