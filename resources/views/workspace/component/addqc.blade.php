@extends('template')

@section('body')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <form class="card">
                    <div class="card-header">
                        <h3 class="card-title">Your Project</h3>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label required">Name Your Project</label>
                            <div>
                                <input type="text" class="form-control" placeholder="Project Name" name="project_name">
                            </div>
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
                        <div class="mb-3">
                            <label class="form-label">Select</label>
                            <div>
                                <select class="form-select">
                                    <option>Option 1</option>
                                    <optgroup label="Optgroup 1">
                                        <option>Option 1</option>
                                        <option>Option 2</option>
                                    </optgroup>
                                    <option>Option 2</option>
                                    <optgroup label="Optgroup 2">
                                        <option>Option 1</option>
                                        <option>Option 2</option>
                                    </optgroup>
                                    <optgroup label="Optgroup 3">
                                        <option>Option 1</option>
                                        <option>Option 2</option>
                                    </optgroup>
                                    <option>Option 3</option>
                                    <option>Option 4</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Checkboxes</label>
                            <div>
                                <label class="form-check">
                                    <input class="form-check-input" type="checkbox" checked="">
                                    <span class="form-check-label">Option 1</span>
                                </label>
                                <label class="form-check">
                                    <input class="form-check-input" type="checkbox">
                                    <span class="form-check-label">Option 2</span>
                                </label>
                                <label class="form-check">
                                    <input class="form-check-input" type="checkbox" disabled="">
                                    <span class="form-check-label">Option 3</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
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
