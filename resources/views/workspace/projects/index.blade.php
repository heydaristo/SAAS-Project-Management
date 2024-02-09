@extends('template')

@php
  $title= "Project";
@endphp


@section('body') 
<div class="row row-deck row-cards">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Project</h3>
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
        data-bs-target="#tambah_project">
        New Project
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
            <th>Project Name</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Status</th>
            <th>Client</th>
            {{-- <th>Freelancer</th> --}}
            <th class="w-1"></th>
          </tr>
        </thead>
        <tbody>
            @php
            $i = 1 + (($projectmodels->currentPage()-1) * $projectmodels->perPage());
            @endphp
            @foreach($projectmodels as $project)
            <tr>
              <td><span class="text-muted">{{ $i++ }}</span></td>
              <td>{{ $project->project_name}}</td>
              <td>{{ $project->start_date }}</td>
              <td>{{ $project->end_date }}</td>
              <td>
                @if($project->status == 'Active')
                    <span class="badge text-bg-success">{{ $project->status }}</span>
                @elseif($project->status == 'Pending')
                    <span class="badge text-bg-warning">{{ $project->status }}</span>
                @elseif($project->status == 'Inactive')
                    <span class="badge text-bg-danger">{{ $project->status }}</span>
                @endif
            </td>
              <td>{{ $project->name }}</td>
              {{-- <td>{{ $project->fullname }}</td> --}}
            <td><div class="btn-group mb-1 dropleft ">
              <div class="dropdown dropleft">
                <button class="btn btn-primary dropdown-toggle me-1" type="button" id="dropdownMenuButtonIcon" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Aksi
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                  <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalEdit-{{$project->id}}">
                    Edit
                  </button>
                  <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalDelete-{{$project->id}}">Delete</button>
                </div>
              </div>
          </div></td>
          </tr>

          {{-- Modals Edit --}}
          <div class="modal fade" id="modalEdit-{{ $project->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="modal2Label">Project Name</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form action="{{ route('workspace.projects.update', ['id' => $project->id]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                      <label for="project_name">Project Name</label>
                      <input type="text" value="{{ $project->project_name }}" class="form-control mt-1" name="project_name" placeholder="Masukkan Project name" required />
                    </div>
                    <div class="mb-3">
                     <label for="start_date">Start Date</label>
                     <input type="date" class="form-control mt-1" value="{{ $project->start_date }}" id="start_date" name="start_date" placeholder="Start Date" required />
                    </div>
                    <div class="mb-3">
                      <label for="end_date">End Date</label>
                      <input type="date" class="form-control mt-1" value="{{ $project->end_date }}" id="end_date" name="end_date" placeholder="Masukkan alamat" required />
                     </div>
                    <div class="mb-3">
                      <label for="status">Status</label>
                      <select class="form-control mt-1" name="status">
                          <option value="Active" {{ $project->status == 'Active' ? 'selected' : '' }}>Active</option>
                          <option value="Pending" {{ $project->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                          <option value="Inactive" {{ $project->status == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                      </select>
                     </div>
                     <div class="mb-3">
                      <label for="client">Nama Client</label>
                      <select class="form-control mt-1" name="id_client" id="id_client">
                          @foreach ($clients as $client)
                              @if ($client->user_id == auth()->user()->id)
                                  <option value="{{ $client->id }}" {{ $project->id_client == $client->id ? 'selected' : '' }}>
                                      {{ $client->name }}
                                  </option>
                              @endif
                          @endforeach
                      </select>
                  </div>
                     {{-- <div class="mb-3">
                      <label for="freelance">Nama Freelance</label>
                      <select class="form-control mt-1" name="user_id" id="user_id">
                        @foreach ($freelances as $freelance)
                            <option value="{{ $freelance->id }}" {{ $project->user_id == $freelance->id ? 'selected' : '' }}>
                                {{ $freelance->fullname }}
                            </option>
                        @endforeach
                    </select>
                     </div> --}}
                </div>
                <div class="modal-footer">
                  <a type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</a>
                  <button type="submit" class="btn btn-primary">Add Project</button>
                </div>
              </form>
              </div>
            </div>
          </div>

{{-- Modal Hapus --}}
<div class="modal modal-blur fade" id="modalDelete-{{ $project->id }}" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          <div class="modal-status bg-danger"></div>
          <div class="modal-body text-center py-4">
              <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-danger icon-lg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                  <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                  <path d="M12 9v4"></path>
                  <path d="M10.363 3.591l-8.106 13.534a1.914 1.914 0 0 0 1.636 2.871h16.214a1.914 1.914 0 0 0 1.636 -2.87l-8.106 -13.536a1.914 1.914 0 0 0 -3.274 0z"></path>
                  <path d="M12 16h.01"></path>
              </svg>
              <h3>Are you sure?</h3>
              <div class="text-secondary">Do you really want to remove project {{ $project->project_name }}? What you've done cannot be undone.</div>
          </div>
          <div class="modal-footer">
              <div class="w-100">
                  <div class="row">
                      <form action="{{ route('workspace.projects.delete',['id' => $project->id]) }}" method="POST">
                          @csrf
                          @method('DELETE')
                          <div class="col">
                              <a href="#" class="btn w-100" data-bs-dismiss="modal">Cancel</a>
                          </div>
                          <div class="col">
                              <button class="btn btn-danger w-100" data-bs-dismiss="modal">Delete</button>
                          </div>
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
      {!! $projectmodels->appends(Request::except('page'))->links('pagination::bootstrap-5') !!}
    </div>
  </div>
</div>
</div>

{{-- Modals Tambah --}}
<div class="modal fade" id="tambah_project" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal2Label">Project Name</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{ route('workspace.projects.store') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="mb-3">
            <label for="project_name">Project Name</label>
            <input type="text" class="form-control mt-1" name="project_name" placeholder="Masukkan Project name" required />
          </div>
          <div class="mb-3">
           <label for="start_date">Start Date</label>
           <input type="date" class="form-control mt-1" id="start_date" name="start_date" placeholder="Start Date" required />
          </div>
          <div class="mb-3">
            <label for="end_date">End Date</label>
            <input type="date" class="form-control mt-1" id="end_date" name="end_date" placeholder="Masukkan alamat" required />
           </div>
          <div class="mb-3">
            <label for="status">Status</label>
            <select class="form-control mt-1" name="status">
              <option value="">Select Status</option>
              <option value="Active">Active</option>
              <option value="Pending">Pending</option>
              <option value="Inactive">Inactive</option>
          </select>
           </div>
           <div class="mb-3">
            <label for="client">Nama Client</label>
            <select class="form-control mt-1" name="id_client" id="id_client">
              <option value="">Select client</option>
              @foreach ($clients as  $client)
              @if ($client->user_id == auth()->user()->id)
              <option value="{{ $client->id }}">{{ $client->name }}</option>
              @endif
              @endforeach
              
          </select>
           </div>
           {{-- <div class="mb-3">
            <label for="freelance">Nama Freelance</label>
            <select class="form-control mt-1" name="user_id" id="user_id">
              <option value="">Select freelance</option>
              @foreach ($freelances as  $freelance)
              <option value="{{ $freelance->id }}">{{ $freelance->fullname }}</option>
              @endforeach
          </select>
           </div> --}}
      </div>
      <div class="modal-footer">
        <a type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</a>
        <button type="submit" class="btn btn-primary">Add Project</button>
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
