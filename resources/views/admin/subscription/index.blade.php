@php
    $title = 'Subscription';
    $pretitle = 'Subcription/list';
@endphp

@extends('admintemplate')

@section('adminbody')
    <div class="row row-deck row-cards">
        {{-- @include('workspace.header')s --}}
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Search Filter</h3>
                </div>
                <div class="card-body border-bottom py-3">
                    <div class="d-flex">
                        <div class="text-muted">
                            <select class="form-select" aria-label="Default select example">
                                <option selected>Select Subscription</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                        <div class="text-muted ms-3">
                            <select class="form-select" aria-label="Default select example">
                                <option selected>Select Subscription</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                        <div class="ms-auto me-3">
                            <select class="form-select" id="select">
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="20">20</option>
                                <option value="50">50</option>
                                <!-- Tambahkan opsi lain sesuai kebutuhan -->
                            </select>
                        </div>
                        <button type="button" class="btn btn-primary font-weight-bolder" data-bs-toggle="modal"
                            data-bs-target="#tambah_Subscription">
                            New Subscription
                        </button>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap datatable">
                        <thead>
                            <tr>
                                <th class="w-1">No.
                                </th>
                                <th>Freelance</th>
                                <th>Plan</th>
                                <th>Remaining Time (months)</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 1 + ($subscriptions->currentPage() - 1) * $subscriptions->perPage();
                            @endphp
                            @foreach ($subscriptions as $subscription)
                                <tr>
                                    <td><span class="text-muted">{{ $i++ }}</span></td>
                                    <td>{{ $subscription->fullname }}</td>
                                    <td>{{ $subscription->plan_name }}</td>
                                    <td>{{ $subscription->duration }}</td>
                                    <td>
                                        @if ($subscription->status == 'ACTIVE')
                                            <span class="badge bg-success">ACTIVE</span>
                                        @elseif ($subscription->status == 'END')
                                            <span class="badge bg-danger">END</span>
                                        @elseif ($subscription->status == 'PENDING')
                                            <span class="badge bg-warning">PENDING</span>
                                        @else
                                            <span class="badge bg-secondary">NOT PAID</span>
                                        @endif
                                    </td>
                                    <td class="d-flex gap-3">
                                        <a href="#" class="btn btn-secondary" data-bs-toggle="modal"
                                            data-bs-target="#modal_edit-{{ $subscription->id }}">
                                            Edit
                                        </a>
                                        <a href="#" class="btn btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#modal_hapus-{{ $subscription->id }}">
                                            Delete
                                        </a>
                                    </td>
                                </tr>
                                {{-- edit modal --}}
                                <div class="modal modal-blur fade" id="modal_edit-{{ $subscription->id }}" tabindex="-1"
                                    role="dialog" aria-hidden="true">
                                    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <form
                                                action="{{ route('admin.subscription.update', ['id' => $subscription->id]) }}"
                                                method="POST" enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Edit Subscription</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label class="form-label">Freelance</label>
                                                        <select class="form-control form-select" name="id_user">
                                                            <option value="{{ $subscription->id_user }}">
                                                                {{ $subscription->fullname }}</option>
                                                            @foreach ($freelances as $freelance)
                                                                <option value="{{ $freelance->id }}">
                                                                    {{ $freelance->fullname }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Plan</label>
                                                        <select class="form-control form-select" name="id_plan">
                                                            <option value="{{ $subscription->id_plan }}">
                                                                {{ $subscription->plan_name }}</option>
                                                            @foreach ($plans as $plan)
                                                                <option value="{{ $plan->id }}">{{ $plan->plan_name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <label class="form-label">Duration</label>
                                                    <fieldset class="form-fieldset">
                                                        <div class="mb-3">
                                                            <label class="form-label">Start Date</label>
                                                            <input type="date" class="form-control" name="start_date"
                                                                value="{{ $subscription->start_date }}">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label">End Date</label>
                                                            <input type="date" class="form-control" name="end_date"
                                                                value="{{ $subscription->end_date }}">
                                                        </div>
                                                    </fieldset>
                                                </div>
                                                <div class="modal-footer">
                                                    <a href="#" class="btn btn-link link-secondary"
                                                        data-bs-dismiss="modal">
                                                        Cancel
                                                    </a>
                                                    <button type="submit" class="btn btn-primary mr-2"
                                                        data-bs-dismiss="modal">
                                                        <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon"
                                                            width="24" height="24" viewBox="0 0 24 24"
                                                            stroke-width="2" stroke="currentColor" fill="none"
                                                            stroke-linecap="round" stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                            <path d="M12 5l0 14" />
                                                            <path d="M5 12l14 0" />
                                                        </svg>
                                                        Edit Subscription
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                {{-- modal hapus --}}
                                <div class="modal modal-blur fade" id="modal_hapus-{{ $subscription->id }}"
                                    tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                            <div class="modal-status bg-danger"></div>
                                            <div class="modal-body text-center py-4">
                                                <!-- Download SVG icon from http://tabler-icons.io/i/alert-triangle -->
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="icon mb-2 text-danger icon-lg" width="24" height="24"
                                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                    fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path
                                                        d="M10.24 3.957l-8.422 14.06a1.989 1.989 0 0 0 1.7 2.983h16.845a1.989 1.989 0 0 0 1.7 -2.983l-8.423 -14.06a1.989 1.989 0 0 0 -3.4 0z" />
                                                    <path d="M12 9v4" />
                                                    <path d="M12 17h.01" />
                                                </svg>
                                                <h3>Are you sure?</h3>
                                                <div class="text-muted">Do you really want to remove the Subscription? What
                                                    you've done cannot be undone.</div>
                                            </div>
                                            <div class="modal-footer">
                                                <div class="w-100">
                                                    <div class="row">
                                                        <form
                                                            action="{{ route('admin.subscription.delete', ['id' => $subscription->id]) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <div class="col"><button type="button" class="btn w-100"
                                                                    data-bs-dismiss="modal">
                                                                    Cancel
                                                                    </a></div>
                                                            <div class="col"><button type="submit"
                                                                    class="btn btn-danger w-100" data-bs-dismiss="modal">
                                                                    Delete Subscription
                                                                    </a></div>
                                                        </form>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                </div>
                @endforeach

                </tbody>
                </table>
            </div>
            <div class="card-footer d-flex align-items-center">
                {!! $subscriptions->appends(Request::except('page'))->links('pagination::bootstrap-5') !!}

            </div>
        </div>
    </div>
    </div>

    {{-- Modal Dialog --}}
    <div class="modal modal-blur fade" id="tambah_Subscription" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <form action="{{ route('admin.subscription.create') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Add Subscription</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Freelance</label>
                            <select class="form-control form-select" name="id_user">
                                <option value="">Select Freelance</option>
                                @foreach ($freelances as $freelance)
                                    <option value="{{ $freelance->id }}">{{ $freelance->fullname }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Plan</label>
                            <select class="form-control form-select" name="id_plan">
                                <option value="">Select Plan</option>
                                @foreach ($plans as $plan)
                                    <option value="{{ $plan->id }}">{{ $plan->plan_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <label class="form-label">Duration</label>
                        <div class="card">
                            <div class="card-header">
                                <ul class="nav nav-tabs card-header-tabs" data-bs-toggle="tabs" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <a href="#duration" class="nav-link active" data-bs-toggle="tab"
                                            aria-selected="true" role="tab">Duration (months)</a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a href="#date" class="nav-link" data-bs-toggle="tab" aria-selected="false"
                                            role="tab" tabindex="-1">Date</a>
                                    </li>
                                    <li class="nav-item ms-auto" role="presentation">
                                        <a href="#tabs-settings-1" class="nav-link" title="Settings"
                                            data-bs-toggle="tab" aria-selected="false" tabindex="-1"
                                            role="tab"><!-- Download SVG icon from http://tabler-icons.io/i/settings -->
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="icon icon-tabler icon-tabler-info-circle" width="24"
                                                height="24" viewBox="0 0 24 24" stroke-width="2"
                                                stroke="currentColor" fill="none" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" />
                                                <path d="M12 9h.01" />
                                                <path d="M11 12h1v4h1" />
                                            </svg>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="tab-pane active show" id="duration" role="tabpanel">
                                        <fieldset class="form-fieldset">
                                            <div class="mb-3">
                                                <input type="number" class="form-control" name="duration"
                                                    placeholder="Fill with Duration">
                                            </div>
                                        </fieldset>
                                    </div>
                                    <div class="tab-pane" id="date" role="tabpanel">
                                        <fieldset class="form-fieldset">
                                            <div class="mb-3">
                                                <label class="form-label">Start Date</label>
                                                <input type="date" class="form-control" name="start_date">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">End Date</label>
                                                <input type="date" class="form-control" name="end_date">
                                            </div>
                                        </fieldset>
                                    </div>
                                    <div class="tab-pane" id="tabs-settings-1" role="tabpanel">
                                        <h4>Info tab</h4>
                                        <div>Please select spesific date</div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                            Cancel
                        </a>
                        <button type="submit" class="btn btn-primary mr-2" data-bs-dismiss="modal">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 5l0 14" />
                                <path d="M5 12l14 0" />
                            </svg>
                            Create new Subscription
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
