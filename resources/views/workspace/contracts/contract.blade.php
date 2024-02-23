@extends('template')

@section('body')
<script src="//cdn.ckeditor.com/4.24.0-lts/basic/ckeditor.js"></script>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Review Contract</div>

                <div class="card-body">
                    <form>
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
                    </form>
                </div>
            </div>
            <div class="card mt-3">
                <div class="card-body">
                    <label class="form-label">Attachment A: Services</label>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Service Name</th>
                                <th>Price</th>
                                <th>Fee Method</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($serviceDetails as $service)
                                <tr>
                                    <td>{{ $service->service_name }}</td>
                                    <td>{{ $service->price }}</td>
                                    <td>{{ $service->pay_method }}</td>
                                    <td>{{ $service->description }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <p><strong>Total:</strong> {{ $contract->total}}</p>
                </div>
            </div>
            <div class="card mt-3">
                <div class="card-body mt-3">
                    <div class="form-group">
                        <label class="form-label">Attachment B: Terms and Conditions</label>
                        <textarea class="form-control" id="contract">
                            {{($contract->contract_pdf=="DEFAULT")? env('DEFAULT_TERM'):""}}
                        </textarea>
                    </div>
                </div>  
            </div>
        </div>
    </div>
    <script src="https://cdn.ckeditor.com/ckeditor5/35.1.0/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#contract'))
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
