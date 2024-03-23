@php
    $title = "Quotation";
    $pretitle = "quotation/dismissed";
@endphp

@extends('clienttemplate')

@section('body')
    <div class="container container-tight" style="margin-top: 130px;">
        <div class="card" style="height: 200px;">
            <div class="card-status-top bg-green"></div>
            <div class="card-header">
                <h3 class="card-title">You Have Dismisssed The Quotation</h3>
            </div>
            <div class="card-body p-0">
                <div class="text-center mt-3">
                    <h4>We sorry that we don't meet your expectation</h4>
                    <h4>Thank you for your time</h4>
                </div>
        </div>
    </div>
   
@endsection
