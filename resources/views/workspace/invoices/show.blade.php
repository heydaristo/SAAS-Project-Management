@extends('template')

@php
    $title = "Invoice";
    $pretitle = "invoice/show";
@endphp

@section('body')
    <div class="page-body">
        <div class="container-xl">
            <div class="d-flex mb-3">
                <div class="me-auto p-2">
                    <a href="{{ route('workspace.invoice') }}" class="btn btn-primary">Back</a>
                </div>
                <div class="p-2">
                    <!-- Form untuk tombol cetak PDF -->
                    <form action="{{ route('workspace.invoices.print') }}" method="POST">
                        @csrf
                        <!-- Input tersembunyi untuk mengirimkan id invoice -->
                        <input type="hidden" name="invoice_id" value="{{ $invoice->id }}">
                        <!-- Tombol cetak PDF -->
                        <button type="submit" class="btn btn-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-printer"
                                width="20" height="20" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path
                                    d="M3 5h18c1.2 0 1.774 .927 1.424 2.19l-7.43 13.81c-.35 .647 -1.42 .647 -1.77 0l-7.43 -13.81c-.35 -1.263 .224 -2.19 1.424 -2.19Z" />
                                <line x1="3" y1="7" x2="21" y2="7" />
                                <line x1="5" y1="11" x2="19" y2="11" />
                                <line x1="3" y1="15" x2="21" y2="15" />
                                <line x1="7" y1="19" x2="17" y2="19" />
                            </svg>
                            Cetak PDF
                        </button>
                    </form>
                    <button class="btn btn-danger mt-3" data-bs-toggle="modal" data-bs-target="#modalDelete-{{ $invoice->id }}">
                        Delete
                    </button>
                </div>
            </div>
            <div class="card card-lg">
                <form action="{{ route('workspace.invoice.sendemail', $invoice->id) }}" class="mt-4">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <h1>Invoice</h1>
                                <p>Invoice Number: {{ $project->id }}</p>
                                <div>
                                    @if (Auth::user()->address === null)
                                        <i>Your account address is null</i> <br>
                                    @else
                                        <p>Freelancer Address: {{ Auth::user()->address }}</p>
                                    @endif
                                    <p>State: {{ Auth::user()->state }}, City: {{ Auth::user()->city }}</p>
                                    <p>Region: {{ Auth::user()->region }}, Postal Code: {{ Auth::user()->postal_code }}</p>
                                    <p>Email: {{ Auth::user()->email }}</p>
                                </div>
                            </div>
                            {{-- TODO change --}}
                            <div class="col-6 text-end pt-10">
                                {{-- add pay button --}}
                                <button class="btn btn-primary">Pay Now</button>
                                <p>Client address: {{ $client->address }}</p>
                                <p>State: {{ $client->state }}, City: {{ $client->city }}<br></p>
                                <p>Regioin: {{ $client->region }}, Postal Code: {{ $client->postal_code }}<br></p>
                                <p>Email: {{ $invoice->email }}</p>

                            </div>
                        </div>

                        <div>
                            <p>Issued Date: {{ $invoice->issued_date }}</p>
                            <p style="color: red;">Due Date Payment: {{ $invoice->due_date }}</p>
                        </div>

                        @csrf
                        <table class="table table-transparent table-responsive">
                            <thead>
                                <tr>
                                    <th class="text-center" style="width: 1%"></th>
                                    <th>Services</th>
                                    <th>Payment Method</th>
                                    <th>Description</th>
                                    <th class="text-start">Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 1;
                                @endphp
                                @foreach ($serviceDetails as $service)
                                    <tr>
                                        <td class="text-center">{{ $i++ }}</td>
                                        <td>{{ $service->service_name }}</td>
                                        <td>{{ $service->pay_method }}</td>
                                        <td>{{ $service->description }}</td>
                                        <td>@currency($service->price)</td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="4" class="text-end">Total</td>
                                    <td>@currency($invoice->total)</td>
                                </tr>
                            </tbody>
                        </table>
                        <button type="submit" class="btn btn-primary">Send Email</button>
                </form>
                <p class="text-secondary text-center mt-5">Thank you very much for doing business with us. We look
                    forward to working with you again!</p>
            </div>
        </div>
    </div>
    </div>

    {{-- Modal Delete --}}
    <div class="modal modal-blur fade" id="modalDelete-{{ $invoice->id }}" tabindex="-1" role="dialog"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-status bg-danger"></div>
                <div class="modal-body text-center py-4">
                    <!-- Download SVG icon from http://tabler-icons.io/i/alert-triangle -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-danger icon-lg" width="24"
                        height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M12 9v4"></path>
                        <path
                            d="M10.363 3.591l-8.106 13.534a1.914 1.914 0 0 0 1.636 2.871h16.214a1.914 1.914 0 0 0 1.636 -2.87l-8.106 -13.536a1.914 1.914 0 0 0 -3.274 0z">
                        </path>
                        <path d="M12 16h.01"></path>
                    </svg>
                    <h3>Are you sure?</h3>
                    <div class="text-secondary">Do you really want to remove Invoice
                        {{ $invoice->project_name }}? What you've done cannot be undone.</div>
                </div>
                <div class="modal-footer">
                    <div class="w-100">
                        <div class="row">
                            <form action="{{ route('workspace.invoices.delete', ['id' => $invoice->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <div class="col"><a href="#" class="btn w-100 mb-2" data-bs-dismiss="modal">
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
@endsection
