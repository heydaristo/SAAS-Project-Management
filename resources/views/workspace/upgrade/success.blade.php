@extends('template')

@section('body')
    <div class="col-md">
        <div class="card">
            <div class="page-wrapper">
                <!-- Page header -->
                <div class="page-header d-print-none">
                    <div class="container-xl">
                        <div class="row g-2 align-items-center">
                            <div class="col">
                                <h2 class="page-title">
                                    Pembayaran Berhasil
                                </h2>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Page body -->
                <div class="page-body">
                    {{-- buat ucapan terimakasih sudah membayar --}}
                    <div class="container-xl">
                        <div class="row row-cards justify-content-center ">
                            <div class="col-md-6 col-lg-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="text-center">
                                            <div class="mb-2">
                                                <span class="badge bg-blue-lt">Terimakasih</span>
                                            </div>
                                            <div class="h1 mb-3">Pembayaran Berhasil</div>
                                        </div>
                                        <ul class="list-unstyled leading-loose">
                                            <li>
                                                {{-- make the benefits text center --}}
                                                <div class="text-center">
                                                    <span class="text-muted">
                                                        {{-- make an enter for automatic --}}
                                                        Pembayaran anda telah berhasil. Terimakasih telah menggunakan
                                                        layanan kami.
                                                    </span>

                                                </div>
                                            </li>
                                        </ul>
                                        <div class="text-center mt-6">
                                            <a href="{{ route('workspace.dashboard') }}"
                                                class="btn btn-primary">Kembali ke
                                                Dashboard</a>

                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
