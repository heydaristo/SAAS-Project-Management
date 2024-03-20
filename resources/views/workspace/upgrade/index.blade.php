@php
    $title = "Upgrade";
    $pretitle = "upgrade/list";
@endphp

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
                  Paket Premium Freelancer
                </h2>
              </div>
            </div>
          </div>
        </div>
        <!-- Page body -->
        <div class="page-body">
          <div class="container-xl">
            <div class="row row-cards justify-content-center ">
              @foreach ($plans as $plan )
              <div class="col-md-6 col-lg-4">
                <div class="card">
                  <div class="card-body">
                    <div class="text-center">
                      <div class="mb-2">
                        <span class="badge bg-blue-lt">{{ $plan->plan_name }}</span>
                        {{-- active plan show label --}}
                        <span class="badge bg-green-lt">{{ $plan->id == $currentPlan ? 'Active Plan' : '' }}</span>
                      </div>
                      <div class="h1 mb-3">@currency($plan->price)/tahun</div>
                    </div>
                    <ul class="list-unstyled leading-loose">
                      <li>
                        {{-- make the benefits text center --}}
                        <div class="text-center">
                          <span class="text-muted">
                            {{-- make an enter for automatic --}}
                          {!! nl2br($plan->benefits) !!}
                          </span>
                        </div>
                      </li>
                    </ul>
                    <div class="text-center mt-6">
                      @if($plan->id != $currentPlan && $plan->id != 1)
                      <a href="{{ route('workspace.subscriptions.upgrade', ['planid' => $plan->id]) }}" class="btn btn-primary">Upgrade</a>
                      @endif
                    </div>
                  </div>
                </div>
              </div>
              @endforeach
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  @endsection