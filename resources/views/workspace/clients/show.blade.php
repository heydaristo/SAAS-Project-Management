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
    <div class="card">
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
                    <a href="#tabs-home-7" class="nav-link" data-bs-toggle="tab" aria-selected="true"
                        role="tab">Project</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a href="#tabs-profile-7" class="nav-link" data-bs-toggle="tab" aria-selected="false" role="tab"
                        tabindex="-1">Invoice</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a href="#tabs-activity-7" class="nav-link" data-bs-toggle="tab" aria-selected="false"
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
                                                <tr>
                                                    <td></td>
                                                    <form id="taskForm" class="hidden" action="{{ route('workspace.clients.send.tasks', $client->id) }}" method="POST"> 
                                                        @csrf
                                                    <td><input class="form-control" type="text" name="tasks" placeholder="Title"></td>
                                                    <td><input type="date" class="form-control" name="tasks_due_date"></td>
                                                    <td><button class="btn btn-primary" type="submit">Save</button></td>
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
                        <h3 class="card-title">Edit Profile</h3>
                        <div class="row row-cards">
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
                          <div class="col-md-5">
                            <div class="mb-3">
                              <label class="form-label">State</label>
                              <input type="text" class="form-control" name="state" placeholder="State" value="{{ $client->state }}">
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
                      </div>
                </div>
                <div class="tab-pane" id="tabs-profile-7" role="tabpanel">
                    <h4>Profile tab</h4>
                    <div>Fringilla egestas nunc quis tellus diam rhoncus ultricies tristique enim at diam, sem nunc
                        amet, pellentesque id egestas velit sed</div>
                </div>
                <div class="tab-pane" id="tabs-activity-7" role="tabpanel">
                    <div class="card-body">
                        <h2 class="mb-4">My Account</h2>
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <span class="avatar avatar-xl" id="previewAvatar">
                                    @if (Auth::user()->photo_profile)
                                        <img src="{{ asset('photo-user/' . Auth::user()->photo_profile) }}"
                                            alt="Preview Image"
                                            style="max-width: 100%; max-height: 100%; display: block;">
                                    @else
                                        <img src="{{ asset('photo-user/defaultphoto.jpg') }}" alt="Default Avatar"
                                            style="max-width: 100%; max-height: 100%; display: block;">
                                    @endif
                                </span>
                            </div>

                            <div class="col-auto">
                                <form enctype="multipart/form-data" id="profileForm"
                                    action="{{ route('workspace.settings.upload') }}" method="post">
                                    @csrf
                                    <input name="photo_profile" type="file" id="actual-btn" hidden
                                        accept="image/*">
                                    <label for="actual-btn" class="btn btn-primary">Change</label>
                                </form>
                            </div>

                            <div class="col-auto">
                                <form action="{{ route('workspace.settings.deleteProfile') }}" method="POST"
                                    id="deleteForm">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" id="deleteButton" class="btn btn-ghost-danger"
                                        onclick="deleteAvatar()">Delete Avatar</button>
                                </form>
                            </div>
                        </div>
                        <div class="row g-3 mt-3">

                        </div>
                        </fieldset>
                        <h3 class="card-title mt-4">Password</h3>
                        <p class="card-subtitle">You can set a permanent password if you don't want to use temporary
                            login codes.</p>
                        <div>
                            <a href="{{ route('workspace.settings.changepassword') }}" class="btn">
                                Set new password
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection