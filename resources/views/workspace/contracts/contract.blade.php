@extends('template')

@section('body')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Review Contract</div>

                <div class="card-body">
                    <p><strong>Project Name:</strong> {{ $contract->contract_name }}</p>
                    <p><strong>Client Name:</strong> {{ $client->name }}</p>
                    <p><strong>Start Date:</strong> {{ $contract->start_date }}</p>
                    @if ($contract->end_date)
                        <p><strong>End Date:</strong> {{ $contract->end_date }}</p>
                    @else
                        <p><strong>End Date:</strong> Open Date</p>
                    @endif
                    <p><strong>Final Invoice Date:</strong> {{ $contract->final_invoice_date }}</p>
                    <p><strong>Require Deposit:</strong> {{ $contract->require_deposit ? 'Yes' : 'No' }}</p>
                    @if ($contract->require_deposit)
                        <p><strong>Deposit Percentage:</strong> {{ $contract->deposit_percentage }}%</p>
                        <p><strong>Deposit Amount:</strong> ${{ $contract->deposit_amount }}</p>
                        <p><strong>Client Agrees to Deposit:</strong> {{ $contract->client_agrees_deposit ? 'Yes' : 'No' }}
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
