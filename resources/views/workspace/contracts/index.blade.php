@extends('template')

@section('body')
    <div class="row row-deck row-cards">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">contracts</h3>
                </div>

                <div class="card-body border-bottom py-3">
                    <a href="{{ route('workspace.contract.showadd') }}">
                        <button type="button" class="btn btn-primary font-weight-bolder" data-bs-toggle="modal">
                            New contract
                        </button>
                    </a>
                </div>
                <div class="table-responsive">
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
                                <th>contract Name</th>
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
                                $i = 1 + ($contracts->currentPage() - 1) * $contracts->perPage();
                            @endphp
                            @foreach ($contracts as $contract)
                                <tr>
                                    <td><span class="text-muted">{{ $i++ }}</span></td>
                                    <td>{{ $contract->contract_name }}</td>
                                    <td>{{ $contract->start_date }}</td>
                                    {{-- jika end date null isi dengan - --}}
                                    <td>{{ $contract->end_date == null ? '-' : $contract->end_date }}</td>
                                    <td>
                                        @if ($contract->status == 'APPROVED')
                                            <span class="badge text-bg-success">{{ $contract->status }}</span>
                                        @elseif($contract->status == 'SENT')
                                            <span class="badge text-bg-warning">{{ $contract->status }}</span>
                                        @elseif($contract->status == 'DISMISSED')
                                            <span class="badge text-bg-danger">{{ $contract->status }}</span>
                                        @endif
                                    </td>
                                    <td>{{ $contract->name }}</td>
                                    {{-- <td>{{ $contract->fullname }}</td> --}}
                                    <td>
                                        <div class="btn-group mb-1 dropleft ">
                                            <div class="dropdown dropleft">
                                                <button class="btn btn-primary dropdown-toggle me-1" type="button"
                                                    id="dropdownMenuButtonIcon" data-bs-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="false">
                                                    Aksi
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <a href={{ route('workspace.contract.showupdate', $contract->id) }}><button
                                                            class="dropdown-item">
                                                            Edit
                                                        </button></a>
                                                    <button class="dropdown-item" data-bs-toggle="modal"
                                                        data-bs-target="#modalDelete-{{ $contract->id }}">Delete</button>
                                                    <a href={{ route('workspace.contract.sendemail', $contract->id) }}>
                                                        <button class="dropdown-item">

                                                            Send Email</button></a>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                {{-- Modals Edit --}}
                                <div class="modal fade" id="modalEdit-{{ $contract->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modal2Label">contract Name</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('workspace.contract', ['id' => $contract->id]) }}"
                                                    method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="mb-3">
                                                        <label for="contract_name">contract Name</label>
                                                        <input type="text" value="{{ $contract->contract_name }}"
                                                            class="form-control mt-1" name="contract_name"
                                                            placeholder="Masukkan contract name" required />
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="start_date">Start Date</label>
                                                        <input type="date" class="form-control mt-1"
                                                            value="{{ $contract->start_date }}" id="start_date"
                                                            name="start_date" placeholder="Start Date" required />
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="end_date">End Date</label>
                                                        <input type="date" class="form-control mt-1"
                                                            value="{{ $contract->end_date }}" id="end_date"
                                                            name="end_date" placeholder="Masukkan alamat" required />
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="status">Status</label>
                                                        <select class="form-control mt-1" name="status">
                                                            <option value="Active"
                                                                {{ $contract->status == 'Active' ? 'selected' : '' }}>
                                                                Active
                                                            </option>
                                                            <option value="Pending"
                                                                {{ $contract->status == 'Pending' ? 'selected' : '' }}>
                                                                Pending</option>
                                                            <option value="Inactive"
                                                                {{ $contract->status == 'Inactive' ? 'selected' : '' }}>
                                                                Inactive</option>
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="client">Nama Client</label>
                                                        <select class="form-control mt-1" name="id_client" id="id_client">
                                                            @foreach ($clients as $client)
                                                                @if ($client->user_id == auth()->user()->id)
                                                                    <option value="{{ $client->id }}"
                                                                        {{ $contract->id_client == $client->id ? 'selected' : '' }}>
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
                              <option value="{{ $freelance->id }}" {{ $contract->user_id == $freelance->id ? 'selected' : '' }}>
                                  {{ $freelance->fullname }}
                              </option>
                          @endforeach
                      </select>
                       </div> --}}
                                            </div>
                                            <div class="modal-footer">
                                                <a type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</a>
                                                <button type="submit" class="btn btn-primary">Add contract</button>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                {{-- Modal Hapus --}}
                                <div class="modal modal-blur fade" id="modalDelete-{{ $contract->id }}"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-lg modal-dialog-centered">
                                        <div class="modal-content">
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                            <div class="modal-status bg-danger"></div>
                                            <div class="modal-body text-center py-4">
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
                                                <div class="text-secondary">Do you really want to remove contract
                                                    {{ $contract->contract_name }}? What you've done cannot be undone.
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <div class="w-100">
                                                    <div class="row">
                                                        <form
                                                            action="{{ route('workspace.contract', ['id' => $contract->id]) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <div class="col">
                                                                <a href="#" class="btn w-100"
                                                                    data-bs-dismiss="modal">Cancel</a>
                                                            </div>
                                                            <div class="col">
                                                                <button class="btn btn-danger w-100"
                                                                    data-bs-dismiss="modal">Delete</button>
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
                    {!! $contracts->appends(Request::except('page'))->links('pagination::bootstrap-5') !!}
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
    </script>
@endsection
