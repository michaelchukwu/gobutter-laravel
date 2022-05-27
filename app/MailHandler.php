<?php

namespace App;

use App\Models\ReceivedMail;
use App\Models\Ticket;
use BeyondCode\Mailbox\InboundEmail;
use App\Models\Message;
use App\Models\User;

class MailHandler
{
    public function __invoke(InboundEmail $email)
    {
        // get the subject and relate it to the ticket that has been sent
        $subject = $email->subject();
        $subject = explode(" ", $subject);
        $number = end($subject);
        $number = str_replace('#', '', $number);
        // $number = str_replace('#', '', end(explode(" ", $email->subject())));
        $ticket = Ticket::where('number', $number)->first();
        $user = User::where('email', $email->from())->first();
        if ($user && $ticket) {
            Message::create([
                'ticket_id' => $ticket->id,
                'subject' => null,
                'ip' => '0.0.0.0',
                'status' => 'Awaiting Response',
                'user_id' => $user->id,
                'body' => $email->text()
            ]);
            $ticket->status = "Awaiting Response";
            $ticket->updated_at = now();
            $ticket->save();
            // get all the messages form the ticket
            $messages = Message::where('ticket_id', $ticket->id)->get();
            // get the users from the this that are agents

            foreach ($messages as $message) {
                $user = $message->user;
                $user->notify(new UserResponded($ticket, $user));
            }
        }

        // break down the subject to an array
        // get the last element of the array
        // remove the hashtag
        // compare the number to the tickets
        // update the message
        // if there is no ticket number create a new  ticket and send the email
        ReceivedMail::create([
            'sender'    => $email->from(),
            'subject'   => $email->subject(),
            'body'      => $email->text(),
        ]);
    }
}
