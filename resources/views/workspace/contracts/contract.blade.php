@php
    $title = 'Contract';
    $pretitle = 'contract/reviewcontract';
@endphp

@extends('template')

@section('body')
    <script src="//cdn.ckeditor.com/4.24.0-lts/basic/ckeditor.js"></script>
    <form action="{{ route('workspace.contract.sendemail', ['id' => $contract->id]) }}">
        @csrf
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="row mb-3">
                    <div class="col">
                        <h3 class="card-title">Review Contract</h3>
                    </div>
                    <div class="col d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">Continue</button>
                    </div>
                </div>
                <div class="card">
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
                            <p><strong>Deposit Amount:</strong> @currency($contract->deposit_amount)</p>
                            <p><strong>Client Agrees to Deposit:</strong>
                                {{ $contract->client_agrees_deposit ? 'Yes' : 'No' }}
                            </p>
                        @endif
                    </div>
                </div>
                <div class="card  mt-3">
                    <div class="card-body">
                        <h5 class="card-title">Service Contract</h5>
                        <p class="card-text">This contract (the “Agreement”) is entered into by and between the below named
                            parties (the “Parties”). This offer will expire at the close of business on @if ($contract->end_date)
                                <strong>{{ $contract->end_date }}</strong>
                            @else
                                <strong>Open Date</strong>
                            @endif if not accepted in writing by counter-signing this Agreement by the
                            aforementioned date.</p>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><strong>Client:</strong> {{ $client->name }}</li>
                            <li class="list-group-item"><strong>Email:</strong> {{ $client->email }}</li>
                            <li class="list-group-item"><strong>Contractor:</strong> {{ $user->fullname }}</li>
                            <li class="list-group-item"><strong>Email:</strong> {{ $user->email }}</li>
                        </ul>
                        <h5 class="mt-3">Services</h5>
                        <p>Contractor agrees to perform services as described in Attachment A (the “Services”) and Client
                            agrees
                            to pay Contractor as described in Attachment A.</p>
                        {{-- <h5>Signatures</h5>
                    <p>In witness whereof, the Parties, have executed this Agreement, inclusive of Attachment A and
                        Attachment B, as of the later of the two dates below (the “Effective Date”).</p>
                    <div class="row">
                        <div class="col">
                            <p><strong>Client</strong></p>
                            <p>Signature: ___________________</p>
                            <p>Date: _______________________</p>
                        </div>
                        <div class="col">
                            <p><strong>Contractor (Attaf Riski)</strong></p>
                            <p>Signature: ___________________</p>
                            <p>Date: _______________________</p>
                        </div>
                    </div> --}}
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
                        <p><strong>Total:</strong> {{ $contract->total }}</p>
                    </div>
                </div>
                <div class="card mt-3">
                    <div class="card-body mt-3">
                        <div class="form-group">
                            <label class="form-label">Attachment B: Terms and Conditions</label>
                            <textarea class="form-control" id="contract" readonly>
                            {{ $contract->contract_pdf == 'DEFAULT' ? env('DEFAULT_TERM') : '' }}
                        </textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <script src="https://cdn.ckeditor.com/ckeditor5/35.1.0/classic/ckeditor.js"></script>
    @if ($contract->contract_pdf != 'DEFAULT')
        <script>
            // make ClassicEditor read only
            const myFeatureLockId = Symbol('contract');
            ClassicEditor
                .create(document.querySelector('#contract'), {})
                .then(editor => {
                    const toolbarElement = editor.ui.view.toolbar.element;
                    toolbarElement.style.display = 'none';

                    editor.enableReadOnlyMode(myFeatureLockId);
                })
                .catch(error => {
                    console.error(error);
                });
        </script>
    @else
        <script>
            // make ClassicEditor read only
            const myFeatureLockId = Symbol('contract');
            ClassicEditor
                .create(document.querySelector('#contract'), {})
                .then(editor => {})
                .catch(error => {
                    console.error(error);
                });
        </script>
    @endif
@endsection
