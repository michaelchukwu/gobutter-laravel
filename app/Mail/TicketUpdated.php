<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TicketUpdated extends Mailable
{
    use Queueable, SerializesModels;
    public $sendr;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($sendr)
    {
        $this->sendr = $sendr;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('ticketUpdated')->with('sendr', $this->sendr);
    }
}
