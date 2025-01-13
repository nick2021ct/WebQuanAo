<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;

class OrderSuccessfully extends Mailable
{
    use Queueable, SerializesModels;
    public $bill;
    public $carts;
    public $totalBill;
    /**
     * Create a new message instance.
     */
    public function __construct($bill, $carts, $totalBill)
    {
        $this->bill = $bill;
        $this->carts = $carts;
        $this->totalBill = $totalBill;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('manhnd10803@gmail.com', 'PA2T'),
            subject: 'Cảm ơn bạn đã đặt hàng - PA2T',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.billPDF',
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
