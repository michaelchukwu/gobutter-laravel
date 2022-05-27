<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class IncomingMailTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        config(['mail.driver' => 'log']);
    }
    function incoming_mail_is_saved_to_the_mails_table()
    {
        // Given: we have an e-mail
        $email = new TestMail(
            $sender = 'sender@example.com',
            $subject = 'Test E-mail',
            $body = 'Some example text in the body'
        );

        // When: we receive that e-mail
        Mail::to('contact@demo.ceeless.com')->send($email);

        // Then: we assert the e-mails (meta)data was stored
        $this->assertCount(1, ReceivedMail::all());

        tap(ReceivedMail::first(), function ($mail) use ($sender, $subject, $body) {
            logger($mail->id());
            logger($mail->to());
            logger($mail->from());
            logger($mail->subject());
            logger('=====================================');
            $this->assertEquals($sender, $mail->sender);
            $this->assertEquals($subject, $mail->subject);
            $this->assertStringContainsString($body, $mail->body);
        });
    }
}
