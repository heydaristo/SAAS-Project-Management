@extends('template')

@php
    $title = 'Invoice/Create';
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
                </div>
            </div>
            <form action="{{ route('workspace.quotation.editemail', $invoice->id) }}" method="post" class="mt-4">
                @csrf
                <div class="card card-lg">
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
                                <p>Client address:: {{ $client->address }}</p>
                                <p>State: {{ $client->state }}, City: {{ $client->city }}<br></p>
                                <p>Regioin: {{ $client->region }}, Postal Code: {{ $client->postal_code }}<br></p>
                                <p>Email: {{ $invoice->email }}</p>

                            </div>
                        </div>
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
                        <button type="submit" class="btn btn-primary">Save & Send</button>
                        <p class="text-secondary text-center mt-5">Thank you very much for doing business with us. We look
                            forward to working with you again!</p>
                    </div>

                </div>

            </form>
        </div>
    </div>
@endsection
