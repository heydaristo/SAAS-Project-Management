@php
    $title = "Upgrade";
    $pretitle = "upgrade/pay";
@endphp

@extends('template')

@section('body')
<div class="container d-flex justify-content-center align-items-center mt-5">
    <div class="page page-center">
        <div class="text-center text-secondary mt-3">
            Powered by Midtrans and Tim Magang Techarea 2024 
          </div>
      <div class="container container-tight py-4">
        <div class="card card-md">
            <div class="card-status-top bg-green"></div>
          <div class="card-body">
            <h3 class="h3 text-center mb-4">Do you want to pay this (Paket Premium) ?</h3>
            <p style="text-align: center;" class="fs-3">
              You will upgrade to the Premium Package at a price Rp. {{ $transaction->amount }}.
            </p>
          </div>
          <div class="card-footer">
            <div style="display: flex; justify-content: space-between;">
                <a href="{{ route('workspace.subscriptions.upgradeshow') }}" class="btn btn-danger">No, I want back</a>
                <a href="#" class="btn btn-success" id="pay-button">Yes, I want to pay</a>
              </div>
          </div>
        </div>
        
      </div>
    </div>
  </div>
@endsection

@section('script')
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
    <script type="text/javascript">
        document.getElementById('pay-button').onclick = function() {
            // SnapToken acquired from previous step
            snap.pay('{{ $transaction->snap_token }}', {
                // Optional
                onSuccess: function(result) {
                    /* You may add your own js here, this is just example */
                    window.location.href = '{{ route('workspace.subscriptions.success', $transaction->id) }}'
                },
                // Optional
                onPending: function(result) {
                    /* You may add your own js here, this is just example */
                    document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                },
                // Optional
                onError: function(result) {
                    /* You may add your own js here, this is just example */
                    document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                }
            });
        };
    </script>
@endsection
