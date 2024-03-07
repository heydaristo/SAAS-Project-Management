@extends('template')

@php
    $title = 'Transaction';
@endphp

@section('body')
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
                                <option selected>Select transaction</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                        <div class="text-muted ms-3">
                            <select class="form-select" aria-label="Default select example">
                                <option selected>Select transaction</option>
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
                        <div class="col col-lg-auto">
                            <button type="button" class="btn fontambah_incomet-weight-bolder" data-bs-toggle="modal"
                                data-bs-target="#tambah_income">
                                New Income
                            </button>
                            <button type="button" class="btn btn-primary font-weight-bolder" data-bs-toggle="modal"
                                data-bs-target="#tambah_transaction">
                                New Expense
                            </button>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap datatable">
                        <thead>
                            <tr>
                                <th class="w-1">No.
                                </th>
                                <th>Description</th>
                                <th>Source</th>
                                <th>Category</th>
                                <th>Created Date</th>
                                <th>Amount</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transactions as $transaction)
                                <tr>
                                    <td><span class="text-muted">{{ $loop->iteration }}</span></td>
                                    <td>
                                        @if ($transaction->is_income == 1)
                                            <span class="badge bg-success"><svg xmlns="http://www.w3.org/2000/svg"
                                                    class="icon icon-tabler icon-tabler-arrow-narrow-up" width="24"
                                                    height="24" viewBox="0 0 24 24" stroke-width="2"
                                                    stroke="currentColor" fill="none" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M12 5l0 14" />
                                                    <path d="M16 9l-4 -4" />
                                                    <path d="M8 9l4 -4" />
                                                </svg></span>
                                        @else
                                            <span class="badge bg-danger"><svg xmlns="http://www.w3.org/2000/svg"
                                                    class="icon icon-tabler icon-tabler-arrow-narrow-down" width="24"
                                                    height="24" viewBox="0 0 24 24" stroke-width="2"
                                                    stroke="currentColor" fill="none" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M12 5l0 14" />
                                                    <path d="M16 15l-4 4" />
                                                    <path d="M8 15l4 4" />
                                                </svg></span>
                                        @endif
                                        {{ $transaction->description }}
                                    </td>
                                    <td>{{ $transaction->source }}</td>
                                    <td>{{ $transaction->category }}</td>
                                    <td>{{ $transaction->created_at }}</td>
                                    <td>{{ $transaction->amount }}</td>
                                    <td class="d-flex gap-3">
                                        <a href="#" class="btn btn-secondary" data-bs-toggle="modal"
                                            data-bs-target="#modal_edit-{{ $transaction->id }}">
                                            Edit
                                        </a>
                                        <a href="#" class="btn btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#modal_hapus-{{ $transaction->id }}">
                                            Delete
                                        </a>
                                    </td>
                                </tr>
                                {{-- edit modal --}}
                                <div class="modal modal-blur fade" id="modal_edit-{{ $transaction->id }}" tabindex="-1"
                                    role="dialog" aria-hidden="true">
                                    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <form
                                                action="{{ route('workspace.transaction.update', ['id' => $transaction->id]) }}"
                                                method="POST" enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Edit Transaction</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label
                                                            class="form-label">Assign To Project</label>
                                                        <select class="form-select" name="project_id">
                                                            @foreach ($projectlist as $project)
                                                                <option value="{{ $project->id }}"
                                                                    {{ $project->id == $transaction->project_id ? 'selected' : '' }}>
                                                                    {{ $project->project_name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label
                                                            class="form-label
                                                            required">Created Date</label>
                                                        <input type="date" class="form-control" name="created_date"
                                                            value="{{ $transaction->created_date }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label
                                                            class="form-label
                                                            required">Amount</label>
                                                        <input type="number" class="form-control" name="amount"
                                                            value="{{ $transaction->amount }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label
                                                            class="form-label
                                                            required">Description</label>
                                                        <input type="text" class="form-control" name="description"
                                                            value="{{ $transaction->description }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label
                                                            class="form-label
                                                            required">Source</label>
                                                        <input type="text" class="form-control" name="source"
                                                            value="{{ $transaction->source }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label
                                                            class="form-label  
                                                            required">Category</label>
                                                        <select class="form-select" name="category" required>
                                                            <option value="advertising"
                                                                {{ $transaction->category == 'advertising' ? 'selected' : '' }}>
                                                                Advertising</option>
                                                            <option value="bank_charges"
                                                                {{ $transaction->category == 'bank_charges' ? 'selected' : '' }}>
                                                                Bank Charges</option>
                                                            <option value="carriage"
                                                                {{ $transaction->category == 'carriage' ? 'selected' : '' }}>
                                                                Carriage</option>
                                                            <option value="commission"
                                                                {{ $transaction->category == 'commission' ? 'selected' : '' }}>
                                                                Commission</option>
                                                            <option value="consultancy"
                                                                {{ $transaction->category == 'consultancy' ? 'selected' : '' }}>
                                                                Consultancy</option>
                                                            <option value="depreciation"
                                                                {{ $transaction->category == 'depreciation' ? 'selected' : '' }}>
                                                                Depreciation</option>
                                                            <option value="discount"
                                                                {{ $transaction->category == 'discount' ? 'selected' : '' }}>
                                                                Discount</option>
                                                            <option value="electricity"
                                                                {{ $transaction->category == 'electricity' ? 'selected' : '' }}>
                                                                Electricity</option>
                                                            <option value="entertainment"
                                                                {{ $transaction->category == 'entertainment' ? 'selected' : '' }}>
                                                                Entertainment</option>
                                                            <option value="equipment"
                                                                {{ $transaction->category == 'equipment' ? 'selected' : '' }}>
                                                                Equipment</option>
                                                            <option value="fuel"
                                                                {{ $transaction->category == 'fuel' ? 'selected' : '' }}>
                                                                Fuel</option>
                                                            <option value="insurance"
                                                                {{ $transaction->category == 'insurance' ? 'selected' : '' }}>
                                                                Insurance</option>
                                                            <option value="interest"
                                                                {{ $transaction->category == 'interest' ? 'selected' : '' }}>
                                                                Interest</option>
                                                            <option value="legal"
                                                                {{ $transaction->category == 'legal' ? 'selected' : '' }}>
                                                                Legal</option>
                                                            <option value="maintenance"
                                                                {{ $transaction->category == 'maintenance' ? 'selected' : '' }}>
                                                                Maintenance</option>
                                                            <option value="materials"
                                                                {{ $transaction->category == 'materials' ? 'selected' : '' }}>
                                                                Materials</option>
                                                            < option value="office"
                                                                {{ $transaction->category == 'office' ? 'selected' : '' }}>
                                                                Office</option>
                                                                <option value="packaging"
                                                                    {{ $transaction->category == 'packaging' ? 'selected' : '' }}>
                                                                    Packaging</option>
                                                                <option value="postage"
                                                                    {{ $transaction->category == 'postage' ? 'selected' : '' }}>
                                                                    Postage</option>
                                                                <option value="printing"
                                                                    {{ $transaction->category == 'printing' ? 'selected' : '' }}>
                                                                    Printing</option>
                                                                <option value="rent"
                                                                    {{ $transaction->category == 'rent' ? 'selected' : '' }}>
                                                                    Rent</option>
                                                                <option value="repairs"
                                                                    {{ $transaction->category == 'repairs' ? 'selected' : '' }}>
                                                                    Repairs</option>
                                                                <option value="salaries"
                                                                    {{ $transaction->category == 'salaries' ? 'selected' : '' }}>
                                                                    Salaries</option>
                                                                <option value="stationery"
                                                                    {{ $transaction->category == 'stationery' ? 'selected' : '' }}>
                                                                    Stationery</option>
                                                                <option value="subsistence"
                                                                    {{ $transaction->category == 'subsistence' ? 'selected' : '' }}>
                                                                    Subsistence</option>
                                                                <option value="telephone"
                                                                    {{ $transaction->category == 'telephone' ? 'selected' : '' }}>
                                                                    Telephone</option>
                                                                <option value="training"
                                                                    {{ $transaction->category == 'training' ? 'selected' : '' }}>
                                                                    Training</option>
                                                                <option value="travel"
                                                                    {{ $transaction->category == 'travel' ? 'selected' : '' }}>
                                                                    Travel</option>
                                                                <option value="wages"
                                                                    {{ $transaction->category == 'wages' ? 'selected' : '' }}>
                                                                    Wages</option>
                                                                <option value="waste"
                                                                    {{ $transaction->category == 'waste' ? 'selected' : '' }}>
                                                                    Waste</option>
                                                                <option value="other"
                                                                    {{ $transaction->category == 'other' ? 'selected' : '' }}>
                                                                    Other</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <a href="#" class="btn btn-link link-secondary"
                                                        data-bs-dismiss="modal">
                                                        Cancel
                                                    </a>
                                                    <button type="submit" class="btn btn-primary mr-2"
                                                        data-bs-dismiss="modal">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon"
                                                            width="24" height="24" viewBox="0 0 24 24"
                                                            stroke-width="2" stroke="currentColor" fill="none"
                                                            stroke-linecap="round" stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                            <path d="M12 5l0 14" />
                                                            <path d="M16 9l-4 -4" />
                                                            <path d="M8 9l4 -4" />
                                                        </svg>
                                                        Update Transaction
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                {{-- modal hapus --}}
                                <div class="modal modal-blur fade" id="modal_hapus-{{ $transaction->id }}"
                                    tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
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
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path
                                                        d="M10.24 3.957l-8.422 14.06a1.989 1.989 0 0 0 1.7 2.983h16.845a1.989 1.989 0 0 0 1.7 -2.983l-8.423 -14.06a1.989 1.989 0 0 0 -3.4 0z" />
                                                    <path d="M12 9v4" />
                                                    <path d="M12 17h.01" />
                                                </svg>
                                                <h3>Are you sure?</h3>
                                                <div class="text-muted">Do you really want to remove the transaction? What
                                                    you've done cannot be undone.</div>
                                            </div>
                                            <div class="modal-footer">
                                                <div class="w-100">
                                                    <div class="row">
                                                        <form
                                                            action="{{ route('workspace.transaction.delete', ['id' => $transaction->id]) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <div class="col"><button type="button" class="btn w-100"
                                                                    data-bs-dismiss="modal">
                                                                    Cancel
                                                                    </a></div>
                                                            <div class="col"><button type="submit"
                                                                    class="btn btn-danger w-100" data-bs-dismiss="modal">
                                                                    Delete transaction
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
                {!! $transactions->appends(Request::except('page'))->links('pagination::bootstrap-5') !!}
            </div>
        </div>
    </div>
    </div>

    {{-- Modal Dialog --}}
    <div class="modal modal-blur fade" id="tambah_transaction" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <form action="{{ route('workspace.transaction.create') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Add Expense</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Assign To Project</label>
                            <select class="form-select" name="project_id">
                                <option value="">Select Project</option>
                                @foreach ($projectlist as $project)
                                    <option value="{{ $project->id }}">{{ $project->project_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label required">Created Date</label>
                            <input type="date" class="form-control" name="created_date" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label required">Amount</label>
                            <input type="number" class="form-control" name="amount" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label required">Description</label>
                            <input type="text" class="form-control" name="description" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label required">Source</label>
                            <input type="text" class="form-control" name="source" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label required">Category</label>
                            <select class="form-select" name="category" required>
                                <option value="">Select Category</option>
                                <option value="advertising">Advertising</option>
                                <option value="bank_charges">Bank Charges</option>
                                <option value="carriage">Carriage</option>
                                <option value="commission">Commission</option>
                                <option value="consultancy">Consultancy</option>
                                <option value="depreciation">Depreciation</option>
                                <option value="discount">Discount</option>
                                <option value="electricity">Electricity</option>
                                <option value="entertainment">Entertainment</option>
                                <option value="equipment">Equipment</option>
                                <option value="fuel">Fuel</option>
                                <option value="insurance">Insurance</option>
                                <option value="interest">Interest</option>
                                <option value="legal">Legal</option>
                                <option value="maintenance">Maintenance</option>
                                <option value="materials">Materials</option>
                                <option value="office">Office</option>
                                <option value="packaging">Packaging</option>
                                <option value="postage">Postage</option>
                                <option value="printing">Printing</option>
                                <option value="rent">Rent</option>
                                <option value="repairs">Repairs</option>
                                <option value="salaries">Salaries</option>
                                <option value="stationery">Stationery</option>
                                <option value="subsistence">Subsistence</option>
                                <option value="telephone">Telephone</option>
                                <option value="training">Training</option>
                                <option value="travel">Travel</option>
                                <option value="wages">Wages</option>
                                <option value="waste">Waste</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                            Cancel
                        </a>
                        <button type="submit" class="btn btn-primary mr-2" data-bs-dismiss="modal">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 5l0 14" />
                                <path d="M5 12l14 0" />
                            </svg>
                            Create new Expense
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- add income --}}
    <div class="modal modal-blur fade" id="tambah_income" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <form action="{{ route('workspace.transaction.createincome') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Add Income</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label ">Assign To Project</label>
                            <select class="form-select" name="project_id" >
                                <option value="">Select Project</option>
                                @foreach ($projectlist as $project)
                                    <option value="{{ $project->id }}">{{ $project->project_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label required">Created Date</label>
                            <input type="date" class="form-control" name="created_date" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label required">Amount</label>
                            <input type="number" class="form-control" name="amount" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label required">Description</label>
                            <input type="text" class="form-control" name="description" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label required">Client/Source</label>
                            <input type="text" class="form-control" name="source" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label required">Category</label>
                            <select class="form-select" name="category" required>
                                <option value="">Select Category</option>
                                <option value="divident_income">Divident Income</option>
                                <option value="interest_income">Interest Income</option>
                                <option value="rental_income">Rental Income</option>
                                <option value="royalty_income">Royalty Income</option>
                                <option value="wages_income">Wages Income</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                            Cancel
                        </a>
                        <button type="submit" class="btn btn-primary mr-2" data-bs-dismiss="modal">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 5l0 14" />
                                <path d="M5 12l14 0" />
                            </svg>
                            Create new Income
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
@endsection

@section('sweetalert')
    <script>
        // Auto-close the alert messages after 3 seconds (3000 milliseconds)
        setTimeout(function() {
            $('.swal2-popup').fadeOut();
        }, 3000);
    </script>
@endsection
