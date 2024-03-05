@extends('template')

@section('body')
    <div class="container">
        <h1>Edit Email</h1>
        <form action="{{ route('workspace.invoice.finishemail', $invoice->id) }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="recipient" class="form-label">To:</label>
                <input type="text" class="form-control" id="recipient" name="recipient" value="{{ $client->email }}"
                    required>
            </div>
            <div class="mb-3">
                <label for="subject" class="form-label">Subject:</label>
                <input type="text" class="form-control" id="subject" name="subject"
                    value="{{ $project->project_name }}" required>
            </div>
            <div class="mb-3">
                <label for="message" class="form-label">Message:</label>
                <textarea rows="7" class="form-control" id="message" name="message" rows="6" required>
Hi !

Please find my invoice attached .

Thanks for your business!

{{ $client->name }}
                </textarea>
            </div>
            <div class="mb-3">
                <button type="button" class="btn btn-secondary">Preview Email</button>
                <button type="submit" class="btn btn-primary">Send Email</button>
            </div>
        </form>
    </div>
@endsection
