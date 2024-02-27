@extends('template')

@section('body')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <form action="{{ route('workspace.contract.update', $contract->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row mb-3">
                        <div class="col">
                            <h3 class="card-title">Update Contract</h3>
                        </div>
                        <div class="col d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                    <div class="card-body">
                        {{-- project detail --}}
                        <fieldset class="form-fieldset">
                            <legend>Project Details</legend>
                            <div class="mb-3">
                                <label class="form-label required">Project Name</label>
                                <div>
                                    <input type="text" class="form-control" placeholder="Project Name"
                                        name="project_name" value="{{ $contract->contract_name }}">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label required">Client Name</label>
                                <select class="form-control mt-1" name="id_client" id="id_client">
                                    <option value="">Select client</option>
                                    @foreach ($clients as $client)
                                        <option value="{{ $client->id }}" {{ $client->id == $contract->id_client ? 'selected' : '' }}>{{ $client->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label required">Start Date</label>
                                <div>
                                    <input type="date" class="form-control" name="start_date" value="{{ $contract->start_date }}">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">End Date</label>
                                <div>
                                    <input type="date" class="form-control" name="end_date" value="{{ $contract->end_date }}">
                                    <small>Leave empty for open-ended.</small>
                                </div>
                            </div>
                        </fieldset>

                        {{-- project service --}}
                        <fieldset class="form-fieldset">
                            <legend>Services</legend>
                            <div id="serviceContainer">
                                @foreach ($services as $service)
                                    <div class="service-row">
                                        Service Number: <span class="service-number">{{ $loop->iteration }}</span>
                                        <input type="text" class="form-control service-name" name="services[{{ $loop->iteration - 1 }}][service_name]" placeholder="Service Name" value="{{ $service->service_name }}">
                                        <input type="number" class="form-control service-price" name="services[{{ $loop->iteration - 1 }}][price]" placeholder="Price" value="{{ $service->price }}">
                                        <select class="form-control service-fee-method" name="services[{{ $loop->iteration - 1 }}][pay_method]">
                                            <option value="fixed" {{ $service->pay_method == 'fixed' ? 'selected' : '' }}>Fixed</option>
                                            <option value="percentage" {{ $service->pay_method == 'percentage' ? 'selected' : '' }}>Percentage</option>
                                        </select>
                                        <input type="text" class="form-control service-description" name="services[{{ $loop->iteration - 1 }}][description]" placeholder="Description" value="{{ $service->description }}">
                                    </div>
                                    @if (!$loop->last)
                                        <div class="service-separator"></div>
                                    @endif
                                @endforeach
                            </div>
                            <button type="button" id="addService" class="btn btn-primary mt-2">Add Another Service</button>
                        </fieldset>

                        {{-- Billing Schedule --}}
                        <fieldset class="form-fieldset">
                            <legend>Billing Schedule</legend>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="requireDeposit" name="require_deposit" {{ $contract->require_deposit ? 'checked' : '' }}>
                                <label class="form-check-label" for="requireDeposit">Require Deposit?</label>
                            </div>
                            <div id="depositFields" style="{{ $contract->require_deposit ? 'display: block;' : 'display: none;' }}">
                                <div class="mb-3">
                                    <label class="form-label">Deposit Percentage</label>
                                    <input type="number" class="form-control" id="depositPercentage"
                                        name="deposit_percentage" placeholder="Percentage" value="{{ $contract->deposit_percentage }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Deposit Amount</label>
                                    <input type="text" class="form-control" id="depositAmount" name="deposit_amount"
                                        readonly value="{{ $contract->deposit_amount }}">
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="clientAgreesDeposit"
                                        name="client_agrees_deposit" {{ $contract->client_agrees_deposit ? 'checked' : '' }}>
                                    <label class="form-check-label" for="clientAgreesDeposit">Make deposit payment mandatory for approval?</label>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label required">Final Invoice Date</label>
                                <input type="date" class="form-control" name="final_invoice_date" value="{{ $contract->final_invoice_date }}">
                            </div>
                        </fieldset>

                        <div class="card-footer text-end">
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="form-label">Total Service Price: <span id="totalCost">{{ $totalServicePrice }}</span></label>
                                </div>
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('sweetalert')
    <script>
        // Auto-close the alert messages after 3 seconds (3000 milliseconds)
        setTimeout(function() {
            $('.swal2-popup').fadeOut();
        }, 3000);
    </script>
@endsection
