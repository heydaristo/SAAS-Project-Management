@extends('template')

@php
  $title= "Invoice";
@endphp


@section('body') 
<div class="row row-deck row-cards">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Invoice</h3>
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
        data-bs-target="#tambah_invoice">
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
            <th>Freelancer</th>
            <th>Tanggal buat</th>
            <th>Status</th>
            <th>Kadarluarsa</th>
            <th>Total</th>
            <th class="w-1"></th>
          </tr>
        </thead>
        <tbody>
            @php
            $i = 1 + (($invoices->currentPage()-1) * $invoices->perPage());
            @endphp
            @foreach($invoices as $invoice)
            <tr>
              <td><span class="text-muted">{{ $i++ }}</span></td>
              <td>{{ $invoice->project_name}}</td>
              <td>{{ $invoice->name }}</td>
              <td>{{ $invoice->issued_date }}</td>
              <td>
                @if($invoice->status == 'Active')
                    <span class="badge text-bg-success">{{ $invoice->status }}</span>
                @elseif($invoice->status == 'Pending')
                    <span class="badge text-bg-warning">{{ $invoice->status }}</span>
                @elseif($invoice->status == 'Inactive')
                    <span class="badge text-bg-danger">{{ $invoice->status }}</span>
                @endif
            </td>
              <td>{{ $invoice->due_date }}</td>
              <td>{{ $invoice->total }}</td>

            <td><div class="btn-group mb-1 dropleft ">
              <div class="dropdown dropleft">
                <button class="btn btn-primary dropdown-toggle me-1" type="button" id="dropdownMenuButtonIcon" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Aksi
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                  <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalEdit-{{$invoice->id}}">
                    Edit
                  </button>
                  <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalDelete-{{$invoice->id}}">Delete</button>
                </div>
              </div>
          </div></td>
          </tr>

          {{-- Modals Edit --}}
          {{-- <div class="modal fade" id="modalEdit-{{ $invoices->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="modal2Label">invoices Name</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form action="{{ route('workspace.invoices.update', ['id' => $invoice->id]) }}" method="POST" enctype="multipart/form-data">
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
                            <option value="{{ $client->id }}" {{ $project->id_client == $client->id ? 'selected' : '' }}>
                                {{ $client->name }}
                            </option>
                        @endforeach
                    </select>
                     </div>
                     <div class="mb-3">
                      <label for="freelance">Nama Freelance</label>
                      <select class="form-control mt-1" name="user_id" id="user_id">
                        @foreach ($freelances as $freelance)
                            <option value="{{ $freelance->id }}" {{ $project->user_id == $freelance->id ? 'selected' : '' }}>
                                {{ $freelance->fullname }}
                            </option>
                        @endforeach
                    </select>
                     </div>
                </div>
                <div class="modal-footer">
                  <a type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</a>
                  <button type="submit" class="btn btn-primary">Add Project</button>
                </div>
              </form>
              </div>
            </div>
          </div> --}}

{{-- Modal Hapus --}}
{{-- <div class="modal modal-blur fade" id="modalDelete-{{ $project->id }}" aria-hidden="true">
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
</div> --}}

          @endforeach

        </tbody>
      </table>
    </div>
    <div class="card-footer d-flex align-items-center ms-auto">
      {!! $invoices->appends(Request::except('page'))->links('pagination::bootstrap-5') !!}
    </div>
  </div>
</div>
</div>

{{-- Modals Tambah --}}
<div class="modal fade" id="tambah_invoice" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal2Label">Add Invoice</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{ route('workspace.invoices.store') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="mb-3">
            <label for="Project">Project Name</label>
            <select class="form-control mt-1" name="id_project" id="user_id">
              <option value="">Select Project</option>
              @foreach ($project as  $projectmodels)
              <option value="{{ $projectmodels->id }}">{{ $projectmodels->project_name}}</option>
              @endforeach
          </select>
           </div>
         <div class="mb-3">
            <label for="client">Client Name</label>
            <select class="form-control mt-1" name="id_client" id="id_client">
              <option value="">Select client</option>
              @foreach ($clients as  $client)
              <option value="{{ $client->id }}">{{ $client->name }}</option>
              @endforeach
          </select>
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
            <label for="due_date">Expired</label>
            <input type="date" class="form-control mt-1" id="due_date" name="due_date" placeholder="Masukkan alamat" required />
           </div>
           <div class="mb-3">
            <label for="total">Total</label>
            <input type="number" class="form-control mt-1" id="total" name="total" placeholder="Masukkan total" required />
           </div>
      
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
