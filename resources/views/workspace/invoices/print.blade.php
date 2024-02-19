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
            padding: 0 10px; /* Jarak antar kolom */
        }
        .left-align {
            text-align: left;
        }
        .right-align {
            text-align: right;
        }
        h1, h3 {
            margin: 0; /* Hilangkan margin bawaan untuk judul */
        }
        address {
            margin: 0; /* Hilangkan margin bawaan untuk alamat */
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
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
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-6" style="text-align: left;">
                        <h1 style="margin: 0;">Invoice {{ $invoice->id }}</h1>
                        <address style="margin: 0;">
                            @if( Auth::user()->address === null)
                            <i>Your account address is null</i> <br>
                            @else
                            {{ Auth::user()->address }}<br>
                            @endif
                            State, City<br>
                            Region, Postal Code<br>
                            {{ Auth::user()->email }}
                        </address>
                    </div>
                    <div class="col-6" style="text-align: right;">
                        <address style="margin: 0;">
                            {{ $invoice->name }}<br>
                            {{ $invoice->address }}<br>
                            State, City<br>
                            Region, Postal Code<br>
                            {{ $invoice->email }}
                        </address>
                    </div>
                </div>
                
                <table>
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 1%"></th>
                            <th>Product</th>
                            <th class="text-center" style="width: 1%">Qnt</th>
                            <th class="text-end" style="width: 1%">Unit</th>
                            <th class="text-end" style="width: 1%">Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center">1</td>
                            <td>
                                <p class="strong mb-1">Logo Creation</p>
                                <div class="text-secondary">Logo and business cards design</div>
                            </td>
                            <td class="text-center">1</td>
                            <td class="text-end">$1.800,00</td>
                            <td class="text-end">$1.800,00</td>
                        </tr>
                        <tr>
                            <td class="text-center">2</td>
                            <td>
                                <p class="strong mb-1">Online Store Design &amp; Development</p>
                                <div class="text-secondary">Design/Development for all popular modern browsers</div>
                            </td>
                            <td class="text-center">1</td>
                            <td class="text-end">$20.000,00</td>
                            <td class="text-end">$20.000,00</td>
                        </tr>
                        <tr>
                            <td class="text-center">3</td>
                            <td>
                                <p class="strong mb-1">App Design</p>
                                <div class="text-secondary">Promotional mobile application</div>
                            </td>
                            <td class="text-center">1</td>
                            <td class="text-end">$3.200,00</td>
                            <td class="text-end">$3.200,00</td>
                        </tr>
                        <tr>
                            <td colspan="4" class="strong text-end">Subtotal</td>
                            <td class="text-end">$25.000,00</td>
                        </tr>
                        <tr>
                            <td colspan="4" class="strong text-end">Vat Rate</td>
                            <td class="text-end">20%</td>
                        </tr>
                        <tr>
                            <td colspan="4" class="strong text-end">Vat Due</td>
                            <td class="text-end">$5.000,00</td>
                        </tr>
                        <tr>
                            <td colspan="4" class="font-weight-bold text-uppercase text-end">Total Due</td>
                            <td class="font-weight-bold text-end">$30.000,00</td>
                        </tr>
                    </tbody>
                </table>
                <p class="text-secondary text-center mt-5">Thank you very much for doing business with us. We look forward to working with you again!</p>
            </div>
        </div>
    </div>
</body>
</html>
