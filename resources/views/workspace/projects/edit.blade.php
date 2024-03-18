@php
    $title = "Proyek";
    $pretitle = "proyek/edit";
@endphp

@extends('template')
@section('body')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <form action="{{ route('workspace.projects.update', $project->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="row mb-3">
                        <div class="col">
                            <h3 class="card-title">Edit Your Project</h3>
                        </div>
                        <div class="col d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                    <div class="card-body">
                        {{-- project detail --}}
                        <fieldset class="form-fieldset">
                            <legend>Project Details</legend>
                            <div class="mb-3">
                                <label class="form-label required">Name Your Project</label>
                                <input type="text" class="form-control" name="project_name"
                                    value="{{ $project->project_name }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label required">Client Name</label>
                                <select class="form-control" name="id_client">
                                    <option value="">Select Client</option>
                                    @foreach ($clients as $client)
                                        <option value="{{ $client->id }}"
                                            @if ($client->id == $project->id_client) selected @endif>
                                            {{ $client->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label required">Start Date</label>
                                <input type="date" class="form-control" name="start_date"
                                    value="{{ $project->start_date }}">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">End Date</label>
                                <div>
                                    <input type="date" class="form-control" name="end_date"
                                        value="{{ $project->end_date }}">
                                    {{-- tambahakan small message --}}
                                    <small>Empty the date if open date.</small>
                                </div>
                            </div>
                        </fieldset>

                        <fieldset class="form-fieldset">
                            <legend>Services</legend>
                            <div id="serviceContainer">
                                @foreach ($serviceDetails as $service)
                                    <div class="service-row">
                                        Service Number: <span class="service-number">{{ $loop->iteration }}</span>
                                        <input type="text" class="form-control service-name" name="service_name[]"
                                            placeholder="Service Name" value="{{ $service->service_name }}">
                                        <input type="number" class="form-control service-price" name="service_price[]"
                                            placeholder="Price" value="{{ $service->price }}">
                                        <select class="form-control service-fee-method" name="service_fee_method[]">
                                            <option value="fixed" {{ $service->pay_method == 'fixed' ? 'selected' : '' }}>
                                                Fixed</option>
                                            <option value="percentage"
                                                {{ $service->pay_method == 'percentage' ? 'selected' : '' }}>Percentage
                                            </option>
                                        </select>
                                        <input type="text" class="form-control service-description"
                                            name="service_description[]" placeholder="Description"
                                            value="{{ $service->description }}">
                                    </div>
                                    @if (!$loop->last)
                                        <div class="service-separator"></div>
                                    @endif
                                @endforeach
                            </div>
                            <button type="button" id="addService" class="btn btn-primary mt-2">Add Another Service</button>
                        </fieldset>
                        <fieldset class="form-fieldset">
                            <legend>Billing Schedule</legend>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="requireDeposit" name="require_deposit"
                                    {{ $project->require_deposit ? 'checked' : '' }}>
                                <label class="form-check-label" for="requireDeposit">Require Deposit?</label>
                            </div>
                            <div id="depositFields"
                                style="{{ $project->require_deposit ? 'display: block;' : 'display: none;' }}">
                                <div class="mb-3">
                                    <label class="form-label">Deposit Percentage</label>
                                    <input type="number" class="form-control" id="depositPercentage"
                                        name="deposit_percentage" placeholder="Percentage"
                                        value="{{ $project->deposit_percentage }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Deposit Amount</label>
                                    <input type="text" class="form-control" id="depositAmount" name="deposit_amount"
                                        readonly value="{{ $project->deposit_amount }}">
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="clientAgreesDeposit"
                                        name="client_agrees_deposit"
                                        {{ $project->client_agrees_deposit ? 'checked' : '' }}>
                                    <label class="form-check-label" for="clientAgreesDeposit">Make deposit payment mandatory
                                        for approval?</label>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label required">Final Invoice Date</label>
                                <input type="date" class="form-control" name="final_invoice_date"
                                    value="{{ $project->final_invoice_date }}">
                            </div>
                        </fieldset>

                        {{-- ganti jadi dinamis aja --}}
                        <div class="card-footer text-end">
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="form-label">Total Service Price: <span id="totalCost">0</span></label>
                                </div>
                            </div>
                        </div>
                </form>
            </div>
        </div>
        {{-- add new service column --}}
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script>
            $(document).ready(function() {
                calculateTotalCost();
                $('#addService').click(function() {
                    var lastServiceRow = $('.service-row').last();
                    var newServiceRow = lastServiceRow.clone();
                    var newServiceNumber = parseInt(lastServiceRow.find('.service-number').text()) + 1;

                    newServiceRow.find('.service-number').text(newServiceNumber);
                    newServiceRow.find('input, select').val(''); // Clear input values

                    // Add delete button for services starting from the third one
                    if (newServiceNumber >= 2) {
                        newServiceRow.append('<button class="btn btn-danger delete-service">Hapus</button>');
                    }

                    $('#serviceContainer').append('<div class="service-separator"></div>'); // Add separator
                    $('#serviceContainer').append(newServiceRow);
                });

                $(document).on('click', '.delete-service', function() {
                    $(this).closest('.service-row').next('.service-separator').remove(); // Remove separator
                    $(this).closest('.service-row').remove(); // Remove service row
                    updateServiceNumbers();
                    calculateTotalCost();
                });

                $(document).on('input', '.service-price, .service-fee-method', function() {
                    calculateTotalCost();
                });


                $('#requireDeposit').change(function() {
                    if (this.checked) {
                        $('#depositFields').show();
                    } else {
                        $('#depositFields').hide();
                    }
                });

                $('#depositPercentage').on('input', function() {
                    var depositPercentage = parseFloat($(this).val()) || 0;
                    var totalCost = parseFloat($('#totalCost').text()) || 0;
                    var depositAmount = (depositPercentage / 100) * totalCost;
                    $('#depositAmount').val(depositAmount.toFixed(2));
                });


                function calculateTotalCost() {
                    var total = 0;
                    $('.service-row').each(function() {
                        var price = parseFloat($(this).find('.service-price').val()) || 0;
                        var feeMethod = $(this).find('.service-fee-method').val();

                        if (feeMethod === 'percentage') {
                            total += price * 0.01; // Convert percentage to decimal
                        } else {
                            total += price;
                        }
                    });

                    $('#totalCost').text(total.toFixed(2));
                }

                function updateServiceNumbers() {
                    $('.service-row').each(function(index) {
                        $(this).find('.service-number').text(index + 1);
                    });
                }
            });
        </script>
    @endsection
