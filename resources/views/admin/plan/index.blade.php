@extends('admintemplate')

@section('adminbody')

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
          data-bs-target="#tambah_plan">
          New plan
          </button>
          </div>
        </div>
        <div class="table-responsive">
          <table class="table card-table table-vcenter text-nowrap datatable">
            <thead>
              <tr>
                <th class="w-1">No.
                </th>
                <th>Plan Name</th>
                <th>Benefit</th>
                <th>Price</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach($plans as $plan)
              <tr>
                <td><span class="text-muted">{{ $loop->iteration }}</span></td>
                <td>{{ $plan->plan_name }}</td>
                <td>{{ $plan->benefits }}</td>
                <td>{{ $plan->price }}</td>
                <td class="d-flex gap-3">
                    <a href="#" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#modal_edit-{{ $plan->id }}">
                        Edit
                    </a>
                    <a href="#" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modal_hapus-{{ $plan->id }}">
                        Delete
                    </a>
                </td>
              </tr>
              {{-- edit modal --}}
              <div class="modal modal-blur fade" id="modal_edit-{{ $plan->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                  <div class="modal-content">
                    <form action="{{ route('admin.plan.update',['id' => $plan->id]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                        <div class="modal-header">
                        <h5 class="modal-title">Edit plan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Plan Name</label>
                            <input type="text" class="form-control" name="plan_name" placeholder="Fill with name"  value="{{ $plan->plan_name }}">
                        </div>
                        <div>
                          <label class="form-label">Benefits</label>
                          <textarea class="form-control" name="plan_benefit" rows="3" placeholder="Fill with benefit">{{ $plan->benefits }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Price</label>
                            <input type="number" class="form-control" name="plan_price" placeholder="Fill with price" value="{{ $plan->price }}">
                        </div>
                        </div>
                        <div class="modal-footer">
                        <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                            Cancel
                        </a>
                        <button type="submit" class="btn btn-primary mr-2" data-bs-dismiss="modal">
                            <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
                            Edit plan
                        </button>
                        </div>
                    </form>
                  </div>
                </div>
              </div>

              {{-- modal hapus --}}
              <div class="modal modal-blur fade" id="modal_hapus-{{ $plan->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                  <div class="modal-content">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="modal-status bg-danger"></div>
                    <div class="modal-body text-center py-4">
                      <!-- Download SVG icon from http://tabler-icons.io/i/alert-triangle -->
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-danger icon-lg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10.24 3.957l-8.422 14.06a1.989 1.989 0 0 0 1.7 2.983h16.845a1.989 1.989 0 0 0 1.7 -2.983l-8.423 -14.06a1.989 1.989 0 0 0 -3.4 0z" /><path d="M12 9v4" /><path d="M12 17h.01" /></svg>
                      <h3>Are you sure?</h3>
                      <div class="text-muted">Do you really want to remove the plan? What you've done cannot be undone.</div>
                    </div>
                    <div class="modal-footer">
                      <div class="w-100">
                        <div class="row">
                            <form action="{{ route('admin.plan.delete',['id' => $plan->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <div class="col"><button type="button" class="btn w-100" data-bs-dismiss="modal">
                                    Cancel
                                  </a></div>
                                 <div class="col"><button type="submit"  class="btn btn-danger w-100" data-bs-dismiss="modal">
                                    Delete plan
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
<div class="modal modal-blur fade" id="tambah_plan" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">
        <form action="{{ route('admin.plan.create') }}" method="POST" enctype="multipart/form-data">
        @csrf
            <div class="modal-header">
            <h5 class="modal-title">Add plan</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Plan Name</label>
                    <input type="text" class="form-control" name="plan_name" placeholder="Fill with Plan Name">
                </div>
                <div>
                  <label class="form-label">Benefits</label>
                  <textarea class="form-control" name="plan_benefit" rows="3" placeholder="Fill with benefit"></textarea>
                </div>
              <div class="mb-3">
                <label class="form-label">Price</label>
                <input type="number" class="form-control" name="plan_price" placeholder="Fill with Plan Price">
              </div>
            </div>
            <div class="modal-footer">
            <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                Cancel
            </a>
            <button type="submit" class="btn btn-primary mr-2" data-bs-dismiss="modal">
                <!-- Download SVG icon from http://tabler-icons.io/i/plus -->`
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
                Create new plan
            </button>
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