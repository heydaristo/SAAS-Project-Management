@extends('template')

@section('body')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <form action="{{ route('workspace.projects.store') }}" method="post">
                    @csrf
                    <div class="row mb-3">
                        <div class="col">
                            <h3 class="card-title">Create Your Project</h3>
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
                                <div>
                                    <input type="text" class="form-control" placeholder="Project Name"
                                        name="project_name">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label required">Client Name</label>
                                <select class="form-control mt-1" name="id_client" id="id_client">
                                    <option value="">Select client</option>
                                    @foreach ($clients as $client)
                                        @if ($client->user_id == auth()->user()->id)
                                            <option value="{{ $client->id }}">{{ $client->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label required">Start Date</label>
                                <div>
                                    <input type="date" class="form-control" name="start_date">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">End Date</label>
                                <div>
                                    <input type="date" class="form-control" name="end_date">
                                    {{-- tambahakan small message --}}
                                    <small>Empty the date if open date.</small>
                                </div>
                            </div>
                        </fieldset>

                        {{-- project service --}}
                        <fieldset class="form-fieldset">
                            <legend>Services</legend>
                            <div id="serviceContainer">
                                <!-- Initial service input fields -->
                                <div class="service-row">
                                    Service Number:
                                    <span class="service-number">1</span>
                                    <input type="text" class="form-control service-name" name="service_name[]"
                                        placeholder="Service Name">
                                    <input type="number" class="form-control service-price" name="service_price[]"
                                        placeholder="Price">
                                    <select class="form-control service-fee-method" name="service_fee_method[]">
                                        <option value="fixed">Fixed</option>
                                        <option value="percentage">Percentage</option>
                                    </select>
                                    <input type="text" class="form-control service-description"
                                        name="service_description[]" placeholder="Description">
                                </div>
                            </div>
                            <button type="button" id="addService" class="btn btn-primary mt-2">Add Other Service</button>
                        </fieldset>
                        <fieldset class="form-fieldset">
                            <legend>Billing Schedule</legend>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="requireDeposit" name="require_deposit">
                                <label class="form-check-label" for="requireDeposit">Require Deposit?</label>
                            </div>
                            <div id="depositFields" style="display: none;">
                                <div class="mb-3">
                                    <label class="form-label">Deposit Percentage</label>
                                    <input type="number" class="form-control" id="depositPercentage"
                                        name="deposit_percentage" placeholder="Percentage">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Deposit Amount</label>
                                    <input type="text" class="form-control" id="depositAmount" name="deposit_amount"
                                        readonly>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="clientAgreesDeposit"
                                        name="client_agrees_deposit">
                                    <label class="form-check-label" for="clientAgreesDeposit">Make deposit payment mandatory for approval?</label>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label required">Final Invoice Date</label>
                                <input type="date" class="form-control" name="final_invoice_date">
                            </div>
                        </fieldset>


                        <div class="card-footer text-end">
                            {{-- make two col for summary service price and submit button --}}
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="form-label">Summary Service Price: <span id="totalCost">0</span></label>
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

    @section('sweetalert')
        <script>
            // Auto-close the alert messages after 3 seconds (3000 milliseconds)
            setTimeout(function() {
                $('.swal2-popup').fadeOut();
            }, 3000);
        </script>
    @endsection
