@extends('template')

@php
    $title = "Project List";
    $pretitle = "proyek/list";
@endphp


@section('body')
    <div class="row row-deck row-cards">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Project</h3>
                </div>
                <div class="card-body border-bottom py-3">
                    <div class="d-flex">
                        <div class="text-muted">
                            Search:
                            <div class="ms-2 d-inline-block">
                                <input type="text" id="search" class="form-control" aria-label="Search Project" placeholder="Cari project berdasarkan nama proyek..."> 
                            </div>
                        </div>
                        <div class="ms-auto me-3">
                            <div class="text-muted">
                                Show
                                <div class="mx-2 d-inline-block">
                                    <input type="number" id="data_count_shows" class="form-control" value="5" size="3"
                                    aria-label="Invoices count">
                                </div>
                                entries
                            </div>
                        </div>
                        <a href="{{ route('workspace.projects.showadd') }}">
                            <button type="button" class="btn btn-primary font-weight-bolder" data-bs-toggle="modal">
                                New Project
                            </button>
                        </a>
                    </div>
                </div>
                <div class="table-responsive"  style="overflow: inherit;">
                    <table class="table card-table table-vcenter text-nowrap datatable table-hover datatable">
                        <thead>
                            <tr>
                                <th class="w-1">No.
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-sm icon-thick" width="24"
                                        height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                        fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M6 15l6 -6l6 6" />
                                    </svg>
                                </th>
                                <th>Project Name</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Status</th>
                                <th>Client</th>
                                {{-- <th>Freelancer</th> --}}
                                <th class="w-1"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 1 + ($projectmodels->currentPage() - 1) * $projectmodels->perPage();
                            @endphp
                            @foreach ($projectmodels as $project)
                            <tr onclick="window.location='{{ route('workspace.projects.detail', $project->id) }}'" style="cursor: pointer;">
                                    <td><span class="text-muted">{{ $i++ }}</span></td>
                                    <td>{{ $project->project_name }}</td>
                                    <td>{{ $project->start_date }}</td>
                                    <td>{{ $project->end_date }}</td>
                                    <td>
                                        @if ($project->status == 'ACTIVE')
                                            <span class="badge text-bg-success">{{ $project->status }}</span>
                                        @elseif($project->status == 'PENDING')
                                            <span class="badge text-bg-warning">{{ $project->status }}</span>
                                        @elseif($project->status == 'ENDED')
                                            <span class="badge text-bg-danger">{{ $project->status }}</span>
                                        @endif
                                    </td>
                                    <td>{{ $project->name }}</td>
                                    <td></td>
                                    {{-- <td>{{ $project->fullname }}</td> --}}
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
                <div class="card-footer d-flex align-items-center ms-auto">
                    {!! $projectmodels->appends(Request::except('page'))->links('pagination::bootstrap-5') !!}
                </div>
            </div>
        </div>
    </div>

    {{-- Modals Tambah --}}
    <div class="modal fade" id="tambah_project" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal2Label">Project Name</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('workspace.projects.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="project_name">Project Name</label>
                            <input type="text" class="form-control mt-1" name="project_name"
                                placeholder="Masukkan Project name" required />
                        </div>
                        <div class="mb-3">
                            <label for="start_date">Start Date</label>
                            <input type="date" class="form-control mt-1" id="start_date" name="start_date"
                                placeholder="Start Date" required />
                        </div>
                        <div class="mb-3">
                            <label for="end_date">End Date</label>
                            <input type="date" class="form-control mt-1" id="end_date" name="end_date"
                                placeholder="Masukkan alamat" required />
                        </div>
                        <div class="mb-3">
                            <label for="status">Status</label>
                            <select class="form-control mt-1" name="status">
                                <option value="">Select Status</option>
                                <option value="ACTIVE">ACTIVE</option>
                                <option value="PENDING">PENDING</option>
                                <option value="ENDED">ENDED</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="client">Nama Client</label>
                            <select class="form-control mt-1" name="id_client" id="id_client">
                                <option value="">Select client</option>
                                @foreach ($clients as $client)
                                    @if ($client->user_id == auth()->user()->id)
                                        <option value="{{ $client->id }}">{{ $client->name }}</option>
                                    @endif
                                @endforeach


                            </select>
                        </div>
                        {{-- <div class="mb-3">
            <label for="freelance">Nama Freelance</label>
            <select class="form-control mt-1" name="user_id" id="user_id">
              <option value="">Select freelance</option>
              @foreach ($freelances as $freelance)
              <option value="{{ $freelance->id }}">{{ $freelance->fullname }}</option>
              @endforeach
          </select>
           </div> --}}
                </div>
                <div class="modal-footer">
                    <a type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</a>
                    <button type="submit" class="btn btn-primary">Add Project</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#data_count_shows').on('input',function() {
                var count_shows = $(this).val();
                // update the table and the pagination
                $.ajax({
                    url: "{{ route('workspace.projects') }}",
                    type: 'GET',
                    data: {
                        data_count_shows: count_shows
                    },
                    success: function(response) {
                        console.log(response);
                        var newTable = $(response).find('.datatable');
                        var newPagination = $(response).find('.pagination');
                        $('.datatable').html(newTable.html());
                        $('.pagination').html(newPagination.html());
                    }
                });
            });

            $('#search').on('input',function() {
                var search = $(this).val();
                // update only the table

                $.ajax({
                    url: "{{ route('workspace.projects') }}",
                    type: 'GET',
                    data: {
                        search: search
                    },
                    success: function(response) {
                        var newTable = $(response).find('.datatable');
                        $('.datatable').html(newTable.html());
                    }
                });
                
            });
        });
    </script>
@endsection
