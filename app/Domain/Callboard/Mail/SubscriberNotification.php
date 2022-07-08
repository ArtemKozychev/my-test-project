<?php

namespace Domain\Callboard\Mail;

use Domain\Callboard\Models\Callboard;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SubscriberNotification extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Callboard $callboard)
    {
    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject($this->callboard->name)
            ->from('text@laravel.com', 'Laravel')
            ->view('mails.test', ['callboard' => $this->callboard]);
    }
}
