@php
    $title = "Invoice";
    $pretitle = "invoice/add";
@endphp

@extends('template')

@section('body')
    <div class="card text-center">
        <div class="card-header">
            Create Invoice
        </div>
        <div class="card-body">
            <div class="row row-cols-1 row-cols-md-3 g-4 text-center justify-content-center">
                <div class="col">
                    <div class="card h-100 cardForm card1">
                        <div class="card-body">
                            <h5 class="card-title">An existing project</h5>
                            <p class="card-text">Choose an existing project and client to populate your invoice. If
                                you used time tracking, you can invoice your tracked time.</p>
                        </div>
                        <div class="card-footer">
                            <div class="position-relative">
                                <select class="form-control mt-1" name="id_project" id="id_project">
                                    <option value="">Select Project</option>
                                    @foreach ($project as $projectmodels)
                                        @if ($projectmodels->user_id == auth()->user()->id)
                                            <option value="{{ $projectmodels->id }}">
                                                {{ $projectmodels->project_name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <div class="position-absolute end-0 top-50 translate-middle-y">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M12 14L6.80385 9.5L17.1962 9.5L12 14Z" fill="#222325"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#id_project').on('change',function() {
                var id_project = $(this).val();
                console.log(id_project);
                window.location.href = "http://127.0.0.1:8000/workspace/invoice/createfromproject/" + id_project;
            });
        });
    </script>
@endsection
