@extends('template')

@php
    $title = 'Invoice';
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
                        <a href="{{ route('workspace.invoices.showAdd') }}" class="btn btn-primary">Create Invoice</a>
                        {{-- <button type="button" class="btn btn-primary font-weight-bolder" data-bs-toggle="modal"
        data-bs-target="#tambah_invoice">
        Create Invoice
        </button> --}}
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap datatable table-hover">
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
                                <th>Client</th>
                                <th>Tanggal buat</th>
                                <th>Status</th>
                                <th>Kadarluarsa</th>
                                <th>Total</th>
                                {{-- <th class="w-1"></th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 1 + ($invoices->currentPage() - 1) * $invoices->perPage();
                            @endphp
                            @foreach ($invoices as $invoice)
                                <tr onclick="window.location='{{ route('workspace.invoices.show', $invoice->id) }}'"
                                    style="cursor: pointer;">
                                    <td><span class="text-muted">{{ $i++ }}</span></td>
                                    <td>{{ $invoice->project_name }}</td>
                                    <td>{{ $invoice->name }}</td>
                                    <td>{{ $invoice->issued_date }}</td>
                                    <td>
                                        @if ($invoice->status == 'SENT')
                                            <span class="badge text-bg-success">{{ $invoice->status }}</span>
                                        @elseif($invoice->status == 'PENDING')
                                            <span class="badge text-bg-warning">{{ $invoice->status }}</span>
                                        @elseif($invoice->status == 'PAID')
                                            <span class="badge text-bg-danger">{{ $invoice->status }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($invoice->due_date)
                                            {{ $invoice->due_date }}
                                        @else
                                            <span class="badge text-bg-success">Open Date</span>
                                        @endif
                                    </td>
                                    <td>@currency($invoice->total)</td>
                                </tr>
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

    </div>
@endsection

