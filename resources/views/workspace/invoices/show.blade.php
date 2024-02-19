@extends('template')

@php
  $title= "Invoice";
@endphp


@section('body')
<div class="page-body">
  <div class="container-xl">
    <div class="card card-lg">
      <div class="card-body">
        <div class="row">
          <div class="col-6">
            <h1>Invoice {{ $invoice->id }}</h1>
            <address>
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
          <div class="col-6 text-end">
            <p class="h3">{{ $invoice->name }}</p>
            <address>
              {{ $invoice->address }}<br>
              State, City<br>
              Region, Postal Code<br>
              {{ $invoice->email }}
            </address>
          </div>
        </div>
        <table class="table table-transparent table-responsive">
          <thead>
            <tr>
              <th class="text-center" style="width: 1%"></th>
              <th>Product</th>
              <th class="text-center" style="width: 1%">Qnt</th>
              <th class="text-end" style="width: 1%">Unit</th>
              <th class="text-end" style="width: 1%">Amount</th>
            </tr>
          </thead>
          <tbody><tr>
            <td class="text-center">1</td>
            <td>
              <p class="strong mb-1">Logo Creation</p>
              <div class="text-secondary">Logo and business cards design</div>
            </td>
            <td class="text-center">
              1
            </td>
            <td class="text-end">$1.800,00</td>
            <td class="text-end">$1.800,00</td>
          </tr>
          <tr>
            <td class="text-center">2</td>
            <td>
              <p class="strong mb-1">Online Store Design &amp; Development</p>
              <div class="text-secondary">Design/Development for all popular modern browsers</div>
            </td>
            <td class="text-center">
              1
            </td>
            <td class="text-end">$20.000,00</td>
            <td class="text-end">$20.000,00</td>
          </tr>
          <tr>
            <td class="text-center">3</td>
            <td>
              <p class="strong mb-1">App Design</p>
              <div class="text-secondary">Promotional mobile application</div>
            </td>
            <td class="text-center">
              1
            </td>
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
        </tbody></table>
        <p class="text-secondary text-center mt-5">Thank you very much for doing business with us. We look forward to working with
          you again!</p>
      </div>
    </div>
  </div>
</div>
@endsection