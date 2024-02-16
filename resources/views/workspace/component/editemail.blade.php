@extends('template')

@section('body')
    <div class="container">
        <h1>Edit Email</h1>
        <form method="post" action="{{ route('workspace.quotation.sendemail', $quotation->id) }}">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="recipient" class="form-label">To:</label>
                <input type="text" class="form-control" id="recipient" name="recipient" value="{{ $client->email }}" required>
            </div>
            <div class="mb-3">
                <label for="subject" class="form-label">Subject:</label>
                <input type="text" class="form-control" id="subject" name="subject" value="{{ $quotation->quotation_name }}" required>
            </div>
            <div class="mb-3">
                <label for="message" class="form-label">Message:</label>
                <textarea class="form-control" id="message" name="message" rows="6" required></textarea>
            </div>
            <div class="mb-3">
                <button type="button" class="btn btn-secondary">Preview Email</button>
                <button type="submit" class="btn btn-primary">Send Email</button>
            </div>
        </form>
    </div>
@endsection
