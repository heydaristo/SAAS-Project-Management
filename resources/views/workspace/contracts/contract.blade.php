@extends('template')

@section('body')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Review Contract</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('workspace.contract.store') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="contract_name" class="form-label">Contract Name</label>
                            <input id="contract_name" type="text" class="form-control" name="contract_name"
                                value="{{ old('contract_name') }}" required autofocus>
                        </div>

                        <div class="mb-3">
                            <label for="start_date" class="form-label">Start Date</label>
                            <input id="start_date" type="date" class="form-control" name="start_date"
                                value="{{ old('start_date') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="end_date" class="form-label">End Date</label>
                            <input id="end_date" type="date" class="form-control" name="end_date"
                                value="{{ old('end_date') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select id="status" class="form-control" name="status" required>
                                <option value="Active">Active</option>
                                <option value="Pending">Pending</option>
                                <option value="Inactive">Inactive</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="client" class="form-label">Client</label>
                            <select id="client" class="form-control" name="client" required>
                                @foreach ($clients as $client)
                                    <option value="{{ $client->id }}">{{ $client->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea id="description" class="form-control" name="description"
                                rows="3">{{ old('description') }}</textarea>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">
                                Create Contract
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
