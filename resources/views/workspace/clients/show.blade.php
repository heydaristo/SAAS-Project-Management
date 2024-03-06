@extends('template')
@section('body')
<style>
    .circle-icon {
  width: 15px;
  height: 15px;
  border-radius: 50%;
  background-color: #ff0000;
  display: flex;
  justify-content: center;
  align-items: center;
  cursor: pointer;
}

.checklist-icon {
  opacity: 0;
  transition: opacity 0.2s ease-in-out;
}

.circle-icon:hover .checklist-icon {
  opacity: 1;
}

</style>
<div class="col-md">
 <div class="col">
  <span class="fs-2">Client / <strong>{{ $client->name }}</strong></span> <br/>
  <a href="#" class="btn btn-primary mt-3">Invoice Client</a>
  <a href="#" class="btn btn-secondary mt-3 dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">More</a>
  <ul class="dropdown-menu">
    <li><a class="dropdown-item" href="#" data-bs-toggle="modal"
      data-bs-target="#modalEdit-{{ $client->id }}">Edit Client</a></li>
    <li><a class="dropdown-item" href="#" data-bs-toggle="modal"
      data-bs-target="#modalDelete-{{ $client->id }}">Delete Client</a></li>
  </ul>
 </div>
    <div class="card mt-4">
      <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs nav-fill" data-bs-toggle="tabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <a href="#tabs-home-7" class="nav-link active" data-bs-toggle="tab" aria-selected="true"
                        role="tab">
                        Tasks</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a href="#tabs-address" class="nav-link" data-bs-toggle="tab" aria-selected="true"
                        role="tab">Address & Contact</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a href="#tabs-projects" class="nav-link" data-bs-toggle="tab" aria-selected="true"
                        role="tab">Project</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a href="#tabs-profile-7" class="nav-link" data-bs-toggle="tab" aria-selected="false" role="tab"
                        tabindex="-1">Invoice</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a href="#notes" class="nav-link" data-bs-toggle="tab" aria-selected="false"
                        role="tab" tabindex="-1">Notes</a>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <div class="tab-content">
                <div class="tab-pane active show" id="tabs-home-7" role="tabpanel">
                    <div class="card">
                        <div class="card-header">
                          <div>
                            <div class="row align-items-center">
                              <div class="col">
                                <div class="card-title">
                                    <h2>Tasks</h2>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="card">
                                <div class="card-header">
                                  <ul class="nav nav-tabs card-header-tabs" data-bs-toggle="tabs" role="tablist">
                                    <li class="nav-item" role="presentation">
                                      <a href="#tabs-to-do" class="nav-link active" data-bs-toggle="tab" aria-selected="false" role="tab" tabindex="-1">To Do</a>
                                    </li>
                                  </ul>
                                </div>
                                <div class="card-body">
                                  <div class="tab-content">
                                    <div class="tab-pane fade active show" id="tabs-to-do" role="tabpanel">
                                        <table class="table card-table table-vcenter text-nowrap datatable table-hover">
                                            <thead>
                                                <tr>
                                                    <th class="w-1"></th>
                                                    <th>Title</th>
                                                    <th>Due</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($tasks as $task)
                                                <tr>
                                                    <td>
                                                        <div class="circle-icon">
                                                            <form action="{{ route('workspace.clients.tasks.destroy', $task->id) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn">
                                                                <span class="checklist-icon">&#10003;</span>
                                                            </button>
                                                            </form>
                                                          </div>
                                                    </td>
                                                    <td>{{ $task->tasks }}</td>
                                                    <td>{{ $task->tasks_due_date }}</td>
                                                    <td></td>
                                                </tr>
                                                @endforeach
                                                <form action="{{ route('workspace.clients.send.tasks', $client->id) }}" method="POST"> 
                                                  @csrf
                                                <tr>
                                                    <td></td>
                                                    <td><input class="form-control" type="text" name="tasks" placeholder="Title"></td>
                                                    <td><input type="date" class="form-control" name="tasks_due_date"></td>
                                                    <td><button class="btn btn-primary" type="submit">Save</button></td>
                                                  </form>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                  </div>
                                </div>
                              </div>
                        </div>
                      </div>
                </div>
                <div class="tab-pane fade" id="tabs-address" role="tabpanel">
                    <h3>Client Information</h3>
                    <div class="card-body">
                        <div class="row row-cards">
                          <form action="{{ route('workspace.clients.update', ['id' => $client->id]) }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                          <div class="col-sm-6 col-md-6">
                            <div class="mb-3">
                              <label class="form-label">Company</label>
                              <input type="text" class="form-control" disabled="" placeholder="Company" value="{{ $client->name }}">
                            </div>
                          </div>
                          <div class="col-sm-6 col-md-6">
                            <div class="mb-3">
                              <label class="form-label">Email address</label>
                              <input type="email" class="form-control" name="email" placeholder="Email" value="{{ $client->email }}">
                            </div>
                          </div>
                          <div class="col-md-12">
                            <div class="mb-2">
                              <label class="form-label">Address</label>
                              <textarea rows="3" class="form-control" name="address" placeholder="Here can be your description" value="Mike">{{ $client->address }}</textarea>
                            </div>
                          </div>
                          <div class="col-sm-6 col-md-6">
                            <div class="mb-3">
                              <label class="form-label">No Telephone</label>
                              <input type="number" class="form-control" name="no_telp" placeholder="No Telephone" value="{{ $client->no_telp }}">
                            </div>
                          </div>
                          <div class="col-sm-6 col-md-6">
                            <div class="mb-3">
                              <label class="form-label">State</label>
                              <input type="text" class="form-control" name="state" placeholder="State" value="{{ $client->state }}">
                            </div>
                          </div>
                          <div class="col-md-5">
                            <div class="mb-3">
                              <label class="form-label">Province</label>
                              <input type="text" class="form-control" name="region" placeholder="Province" value="{{ $client->region }}">
                            </div>
                          </div>
                          <div class="col-sm-6 col-md-4">
                            <div class="mb-3">
                              <label class="form-label">City</label>
                              <input type="text" class="form-control" name="city" placeholder="City" value="{{ $client->city }}">
                            </div>
                          </div>
                          <div class="col-sm-6 col-md-3">
                            <div class="mb-3">
                              <label class="form-label">Postal Code</label>
                              <input type="test" class="form-control" name="postal_code" placeholder="ZIP Code" value="{{ $client->postal_code }}">
                            </div>
                          </div>
                        <button class="btn btn-primary">Save</button>
                      </div>
                    </form>
                      </div>
                </div>
                <div class="tab-pane" id="tabs-projects">
                  <div class="card">
                    <div class="table-responsive"  style="overflow: inherit;">
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
                              @if($projectmodels->isEmpty())
                              <tr>
                                  <td class="text-center" colspan="7">Nothing data</td>
                              </tr>
                              @else 
                                @php
                                    // $i = 1;
                                    $i = 1 + ($projectmodels->currentPage() - 1) * $projectmodels->perPage();
                                @endphp
                                @foreach ($projectmodels as $project)
                              
                                    <tr>
                                        <td><span class="text-muted">{{ $i++ }}</span></td>
                                        <td>{{ $project->project_name }}</td>
                                        <td>{{ $project->start_date }}</td>
                                        <td>{{ $project->end_date }}</td>
                                        <td>
                                            @if ($project->status == 'ACTIVE')
                                                <span class="badge text-bg-success">{{ $project->status }}</span>
                                            @elseif($project->status == 'PENDING')
                                                <span class="badge text-bg-warning">{{ $project->status }}</span>
                                            @elseif($project->status == 'ENDED')
                                                <span class="badge text-bg-danger">{{ $project->status }}</span>
                                            @endif
                                        </td>
                                        <td>{{ $client->name }}</td>
                                    </tr>
                                    @endforeach
                                    @endif
    
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer d-flex align-items-center ms-auto">
                        {!! $projectmodels->appends(Request::except('page'))->links('pagination::bootstrap-5') !!}
                    </div>
                </div>
                </div>
                <div class="tab-pane" id="notes" role="tabpanel">
                  <form action="{{ route('workspace.clients.update.notes', ['id' => $client->id]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <textarea rows="5" class="form-control" name="notes" placeholder="Add Notes...">{{ $client->notes }}</textarea>
                    <button class="btn btn-primary mt-3">Save</button>
                  </form>
                </div>
            </div>
        </div>
    </div>
</div>

                                {{-- Modal Hapus --}}
                                <div class="modal modal-blur fade" id="modalDelete-{{ $client->id }}" tabindex="-1"
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
                                                  {{ $client->name }}? What you've done cannot be undone.</div>
                                          </div>
                                          <div class="modal-footer">
                                              <div class="w-100">
                                                  <div class="row">
                                                      <form
                                                          action="{{ route('workspace.clients.delete', ['id' => $client->id]) }}"
                                                          method="POST">
                                                          @csrf
                                                          @method('DELETE')
                                                          <div class="col"><a href="#" class="btn w-100 mb-2"
                                                                  data-bs-dismiss="modal" style="text-decoration: none;">
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

{{-- Modals Edit --}}
<div class="modal modal-blur fade" id="modalEdit-{{ $client->id }}" tabindex="-1"
  role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">
          <form action="{{ route('workspace.clients.update.name', ['id' => $client->id]) }}"
              method="POST" enctype="multipart/form-data">
              @csrf
              @method('PUT')
              <div class="modal-header">
                  <h5 class="modal-title">Edit Client</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal"
                      aria-label="Close"></button>
              </div>
              <div class="modal-body">
                      <input type="text" name="name" class="form-control"
                          placeholder="Masukkan Nama" value="{{ $client->name }}">
              </div>
              <div class="modal-footer">
                <a href="#" class="btn btn-link link-secondary"
                    data-bs-dismiss="modal" style="text-decoration: none;">
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
@section('sweetalert')
    <script>
        // Auto-close the alert messages after 3 seconds (3000 milliseconds)
        setTimeout(function() {
            $('.swal2-popup').fadeOut();
        }, 3000);
    </script>
    @endsection
@endsection