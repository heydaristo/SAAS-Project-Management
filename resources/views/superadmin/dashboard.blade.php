@php
    $title = "Home";
    $pretitle = "home";
@endphp

@extends('superadmintemplate')

@section('superadminbody')
    <div class="row row-deck row-cards">
        <div class="contabiner d-flex justify-content-center align-items-center mt-5">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h1>Selamat Datang , Superadmin</h1>
                    <p class="fs-2">Ayo kita bekerja bersama hari ini.</p>
                </div>
                <div class="row row-cols-1 row-cols g-4">
                    <div class="col">
                        <a href="{{ route('superadmin.admin.show') }}" style="text-decoration: none;">
                            <div class="card h-80 text-center mx-auto card-content">
                                <div class="d-flex justify-content-center">
                                    <img src="{{ asset('images/invoicedashboard.svg') }}" width="64" height="64"
                                        class="card-img-top mt-4" alt="...">
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title"><strong>Atur Admin Kamu</strong></h5>
                                    <p class="card-text">Atur admin yang ada di aplikasi ini.</p>
                                    </p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endsection
