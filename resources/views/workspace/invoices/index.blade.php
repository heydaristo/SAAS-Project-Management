
@extends('template')

@php
  $title= "Invoice";
@endphp


@section('body') 
<style>
  .cardForm {
      transition: box-shadow 0.3s ease;
      cursor: pointer;
      border-radius: 10px;
  }
  .cardForm.active {
      box-shadow: 0 0 10px 2px rgba(0, 0, 255, 0.5);
  }
  .cardForm:hover {
      box-shadow: 0 0 10px 2px rgba(0, 0, 255, 0.5);
  }
</style>

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
        Create Invoice
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
              <td><a href="{{ route('workspace.invoices.show', $invoice->id) }}">{{ $invoice->project_name}}</a></td>
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
          {{-- <div class="modal fade" id="modalEdit-{{$invoice->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="modal2Label">Edit Invoice</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form action="{{ route('workspace.invoices.update', ['id' => $invoice->id]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                      <label for="Project">Project Name</label>
                      <select class="form-control mt-1" name="id_project" id="user_id">
                        <option value="">Select Project</option>
                        @foreach ($project as  $projectmodels)
                        <option value="{{ $projectmodels->id }}" {{ $invoice->id_project == $projectmodels->id ? 'selected' : '' }}>
                          {{ $projectmodels->project_name}}</option>
                        @endforeach
                    </select>
                     </div>
                   <div class="mb-3">
                      <label for="client">Client Name</label>
                      <select class="form-control mt-1" name="id_client" id="id_client">
                        <option value="">Select client</option>
                        @foreach ($clients as $client)
                        @if ($client->user_id == auth()->user()->id)
                            <option value="{{ $client->id }}" {{ $project->id_client == $client->id ? 'selected' : '' }}>
                                {{ $client->name }}
                            </option>
                        @endif
                        @endforeach
                    </select>
                     </div>
                    <div class="mb-3">
                      <label for="status">Status</label>
                      <select class="form-control mt-1" name="status">
                        <option value="Active" {{ $invoice->status == 'Active' ? 'selected' : '' }}>Active</option>
                        <option value="Pending" {{ $invoice->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                        <option value="Inactive" {{ $invoice->status == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                     </div>
                    <div class="mb-3">
                      <label for="due_date">Expired</label>
                      <input type="date" class="form-control mt-1" value="{{ $invoice->due_date }}" id="due_date" name="due_date" placeholder="Masukkan alamat" required />
                     </div>
                     <div class="mb-3">
                      <label for="total">Total</label>
                      <input type="number" class="form-control mt-1" value="{{ $invoice->total }}" id="total" name="total" placeholder="Masukkan total" required />
                     </div>
                
                </div>
                <div class="modal-footer">
                  <a type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</a>
                  <button type="submit" class="btn btn-primary">Edit Project</button>
                </div>
              </form>
              </div>
            </div>
          </div>
           --}}
           
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
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal2Label">Create Invoice</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
      <div class="modal-body">
        <h1>What do you want to invoice?</h1>
        <div class="row row-cols-1 row-cols-md-3 g-4">
          <div class="col">
            <a href="#" style="text-decoration: none;">
            <div class="card h-100 cardForm card1" onclick="setActiveCard(this)">
              <div class="card-body">
                <h5 class="card-title">An existing project</h5>
                <p class="card-text">Choose an existing project and client to populate your invoice. If you used time tracking, you can invoice your tracked time.</p>
              </div>
              <div class="card-footer">
                <div class="position-relative">
                  <select class="form-control mt-1" name="id_project" id="id_project" onchange="checkInputValues()">
                    <option value="">Select Project</option>
                    @foreach ($project as $projectmodels)
                        @if ($projectmodels->user_id == auth()->user()->id)
                            <option value="{{ $projectmodels->id }}">{{ $projectmodels->project_name }}</option>
                        @endif
                    @endforeach
                </select>
                    <div class="position-absolute end-0 top-50 translate-middle-y">
                      <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path d="M12 14L6.80385 9.5L17.1962 9.5L12 14Z" fill="#222325"></path>
                      </svg>
                  </div>
                </div>
              </div>

            </div>
            </a>
          </div>
          <a href="#" style="text-decoration: none;">
          <div class="col">
            <div class="card h-100 cardForm card2" onclick="setActiveCard(this)">
              <div class="card-body">
                <h5 class="card-title">A new project</h5>
                <p class="card-text">Create an invoice and set up a new project and client based on the info. This way you can better keep track of your work and send future invoices more easily.</p>
              </div>
              <div class="card-footer">
                <input type="text" class="form-control" name="project_name" id="project_name" placeholder="Project Name" oninput="checkInputValues()" onblur="checkInputValues()">
              </div>
            </div>
          </div>
          </a>
          <a href="#" style="text-decoration: none;">
          <div class="col">
            <div class="card h-100 cardForm card3"  onclick="setActiveCard(this)">
            
              <div class="card-body">
                {{-- <h5 class="card-title">Card title</h5> --}}
                <h5 class="card-title">Just a quick invoice</h5>
                <p class="card-text">Create an invoice from scratch without creating a project to track time or expenses. Just add some line items and you are good to go.</p>
              </div>
              <div class="card-footer">
                <small class="text-body-secondary"></small>
              </div>
            </div> 
          </div>
          </a>
        </div>
      </div>
      <div class="modal-footer">
        <p id="errorMessage" style="display: none;" class="text-danger">Please choose one!</p>
        <button id="nextButton" type="button" class="btn btn-primary"  onclick="sendData()" disabled>Next</button>
      </div>
      </div>
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

    let activeCard = null;

function setActiveCard(card) {
    if (activeCard !== null) {
        activeCard.classList.remove('active');
    }
    card.classList.add('active');
    activeCard = card;

    checkInputValues();
}

function checkInputValues() {
    const idProject = document.getElementById('id_project').value;
    const projectName = document.getElementById('project_name').value;
    const nextButton = document.getElementById('nextButton');
    const errorMessage = document.getElementById('errorMessage');

    if ((idProject.trim() !== '' || projectName.trim() !== '') && activeCard !== null) {
        nextButton.disabled = false;
    } else {
        nextButton.disabled = true;
        if (idProject.trim() === '' || projectName.trim() === '') {
          errorMessage.style.display = 'none';
        } else {
          errorMessage.style.display = 'block';
        }
    }
}
function sendData() {
    const input1Value = document.getElementById('project_name').value;
    const select2Value = document.getElementById('id_project').value;

    if (activeCard !== null) {
        let nextPage = '';
        let dataToSend = {};

        // Cek kartu yang aktif dan tambahkan data sesuai dengan input yang ada di kartu itu
        if (activeCard.classList.contains('card1')) {
            nextPage = '/page1'; // Sesuaikan dengan halaman yang sesuai dengan kartu 1
            if (input1Value.trim() !== '') {
                dataToSend.projectName = input1Value;
            }
            if (select2Value.trim() !== '') {
                dataToSend.idProject = select2Value;
            }
        } else if (activeCard.classList.contains('card2')) {
            nextPage = '/page2'; // Sesuaikan dengan halaman yang sesuai dengan kartu 2
            // Tambahkan kondisi untuk input di kartu kedua jika ada
        } else if (activeCard.classList.contains('card3')) {
            nextPage = '/page3'; // Sesuaikan dengan halaman yang sesuai dengan kartu 3
            // Tambahkan kondisi untuk input di kartu ketiga jika ada
        }

        // Redirect ke halaman berikutnya dengan data yang sesuai
        window.location.href = nextPage + '?' + new URLSearchParams(dataToSend);
    }
}

</script>
@endsection
