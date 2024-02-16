@extends('template')
@section('body')
<style>
    .paper {
        background-color: white;
        border: 1px solid #ccc;
        border-top: 3px solid blue; /* Menambahkan border atas */
        width: 70%;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="paper p-4 mt-5">
            <h1>Invoice</h1>
            <div class="row">
                <div class="col-md-8">
                    <p>ID: 123456</p>
                    <h2>Client Name</h2>
                    <p>+ Address</p>
                    <p>+Tax ID</p>
                    
                </div>
                <div class="col-md-4">
                    <p>Harga: <span class="fw-bold">Rp 1.000.000</span></p>
                    <p>Due: upon receipt</p>
                    <p>Issued: {{ date('Y-m-d') }}</p>
                </div>
                <hr>
            </div>
        </div>
    </div>
    </div>
</div>
@endsection