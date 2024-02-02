
          {{-- Edit Modals --}}
          <div class="modal modal-blur fade" id="modalEdit-{{ $project->id }}" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Edit Project</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form action="{{ route('workspace.projects.update',['id' => $project->id]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                      <label for="project_name">Project Name</label>
                        <input type="text" value="{{ $project->project_name }}" class="form-control mt-1" name="project_name" placeholder="Masukkan Project name" required />
                    <div class="mb-3">
                      <label for="start_date">Start Date</label>
                      <input type="date" value="{{ $project->start_date }}" class="form-control mt-1" id="start_date" name="start_date" placeholder="Start Date" required />
                    </div>
                    <div class="mb-3">
                      <label for="end_date">End Date</label>
                      <input type="date" value="{{ $project->end_date }}" class="form-control mt-1" id="end_date" name="end_date" placeholder="Masukkan alamat" required />
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
                  </form>
                </div>
                <div class="modal-footer">
                  <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                    Cancel
                  </a>
                  <button href="#" class="btn btn-primary ms-auto" data-bs-dismiss="modal">
                    Edit Project
                  </button>
                </div>
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
                  <!-- Download SVG icon from http://tabler-icons.io/i/alert-triangle -->
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-danger icon-lg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M12 9v4"></path><path d="M10.363 3.591l-8.106 13.534a1.914 1.914 0 0 0 1.636 2.871h16.214a1.914 1.914 0 0 0 1.636 -2.87l-8.106 -13.536a1.914 1.914 0 0 0 -3.274 0z"></path><path d="M12 16h.01"></path></svg>
                  <h3>Are you sure?</h3>
                  <div class="text-secondary">Do you really want to remove client {{$project->project_name}}? What you've done cannot be undone.</div>
                </div>
                <div class="modal-footer">
                  <div class="w-100">
                    <div class="row">
                      <form action="{{ route('workspace.projects.delete',['id' => $project->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                      <div class="col"><a href="#" class="btn w-100" data-bs-dismiss="modal">
                          Cancel
                        </a></div>
                      <div class="col"><button class="btn btn-danger w-100" data-bs-dismiss="modal">
                          Delete
                        </button></div>
                        </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>