@extends('template')

@php
    $title = "My deks";
@endphp

@section('body')
<style>
    .card:hover {
        background-color: rgba(0, 65, 255, 0.5); /* Biru dengan opacity 0.5 */
        cursor: pointer;
        color: white;
    }
</style>
<div class="row row-deck row-cards">
    <div class="container d-flex justify-content-center align-items-center mt-5">
        <div class="row">
          <div class="col-md-12 text-center">
            <h1>Welcome, {{Auth()->user()->fullname}}</h1>
            <p class="fs-2">Let’s get you set up with This Workspace.</p>
          </div>
          <div class="row row-cols-1 row-cols-md-3 g-4">
            <div class="col">
              <div class="card h-80 text-center mx-auto">
                <div class="d-flex justify-content-center">
                    <img src="{{ asset('images/invoicedashboard.svg') }}" width="64" height="64" class="card-img-top mt-4" alt="...">
                </div>
                <div class="card-body">
                  <h5 class="card-title"><strong>Send a test invoice</strong></h5>
                  <p class="card-text">See how invoices look, and how fast and easy it is to create one.    </p>
                </div>
              </div>
            </div>
            <div class="card text-center mx-auto">
            <div class="col">
                  <div class="d-flex justify-content-center">
                      <img src="{{ asset('images/paymentdashboard.svg') }}" width="64" height="64" class="card-img-top mt-4" alt="...">
                  </div>
                  <div class="card-body">
                    <h5 class="card-title"><strong>Enable online payments</strong></h5>
                    <p class="card-text">Get paid to faster</p>
                  </div>
                </div>
              </div>
              <div class="col">
                <div class="card h-80 text-center mx-auto">
                  <div class="d-flex justify-content-center">
                      <img src="{{ asset('images/transactiondashboard.svg') }}" width="64" height="64" class="card-img-top mt-4" alt="...">
                  </div>
                  <div class="card-body">
                    <h5 class="card-title"><strong>Add reccuring expenses</strong></h5>
                    <p class="card-text">Set them up and we'll record recurring expenses automatically</p>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<div class="col-md-12 text-center mt-3">
    <a id="showMore" class="text-center dropdown-toggle" style="text-decoration: none; cursor: pointer; color:gray;"><strong> Show more</strong></a>     
</div>
@endsection