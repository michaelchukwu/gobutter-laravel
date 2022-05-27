<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TicketCreated extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($details)
    {
        $this->details = $details;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if ($this->details['user_status'] == 'old') {
            return $this->subject("Ticket #" . $this->details['ticket']['number'])->markdown('emails.ticketCreated')->with('details', $this->details);
        } else {
            return $this->subject("Ticket #" . $this->details['ticket']['number'])->markdown('emails.ticketUserCreated')->with('details', $this->details);
        }
    }
}
