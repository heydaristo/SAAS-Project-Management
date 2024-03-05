@extends('clienttemplate')

@section('body')
    <div class="container">
        <p>
            {{ $msg }}
        </p>
        <div class="card-body">
            <div class="row">
                <div class="col-6">
                    <h1>Invoice</h1>
                    <p>Invoice Number: {{ $project->id }}</p>
                    <div>
                        @if ($user->address === null)
                            <i>Your account address is null</i> <br>
                        @else
                            <p>Freelancer Address: {{ $user->address }}</p>
                        @endif
                        <p>State: {{ $user->state }}, City: {{ $user->city }}</p>
                        <p>Region: {{ $user->region }}, Postal Code: {{ $user->postal_code }}</p>
                        <p>Email: {{ $user->email }}</p>
                    </div>
                </div>
                {{-- TODO change --}}
                <div class="col-6 text-end pt-10">
                    {{-- add pay button --}}
                    <a href={{ 'http://127.0.0.1:8000/workspace/invoice/paynow/' . strVal($invoice->id) }} target="_blank"
                        rel="noopener noreferrer">
                        <button class="btn btn-primary">Pay Now</button>
                    </a>
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
            <p class="text-secondary text-center mt-5">Thank you very much for doing business with us. We look
                forward to working with you again!</p>
        </div>
    </div>
@endsection
