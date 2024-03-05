<?php

namespace App\Mail;

use App\Models\Client;
use App\Models\Invoice;
use App\Models\ProjectModel;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Queue\SerializesModels;

class InvoiceMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(
        protected Invoice $invoice,
        protected Client $client,
        protected User $user,
        protected ProjectModel $project,
        protected $serviceDetail,
        protected $message,
        public $subject,
    ) {


    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address($this->user->email, $this->user->fullname),
            subject: $this->subject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'workspace.invoices.customermail',
            with:[
                'invoice' => $this->invoice,
                'project' => $this->project,
                'client' => $this->client,
                'user'=> $this->user,
                'serviceDetails' => $this->serviceDetail,
                'msg' => $this->message
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
