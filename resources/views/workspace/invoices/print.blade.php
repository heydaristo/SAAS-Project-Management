<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .col-6 {
            width: 48%;
            padding: 0 10px;
            /* Jarak antar kolom */
        }

        .left-align {
            text-align: left;
        }

        .right-align {
            text-align: right;
        }

        h1,
        h3 {
            margin: 0;
            /* Hilangkan margin bawaan untuk judul */
        }

        address {
            margin: 0;
            /* Hilangkan margin bawaan untuk alamat */
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            border: 1px solid #ccc;
            padding: 10px;
        }

        th {
            background-color: #f0f0f0;
        }

        .strong {
            font-weight: bold;
        }

        .mb-1 {
            margin-bottom: 10px;
        }

        .text-secondary {
            color: #777;
        }

        .text-center {
            text-align: center;
        }

        .text-uppercase {
            text-transform: uppercase;
        }

        .mt-5 {
            margin-top: 50px;
        }
    </style>
</head>

<body>
    <div class="page-body">
        <div class="container-xl">
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
                    <p class="text-secondary text-center mt-5">Thank you very much for doing business with us. We look
                        forward to working with
                        you again!</p>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
