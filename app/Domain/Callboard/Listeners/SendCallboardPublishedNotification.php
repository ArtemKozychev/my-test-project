<?php

namespace Domain\Callboard\Listeners;

use Domain\Callboard\Events\CallboardPublishedEvent;
use Domain\Callboard\Mail\SubscriberNotification;
use Domain\Callboard\Models\Callboard;
use Domain\Subscription\Models\Subscribers;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class SendCallboardPublishedNotification implements ShouldQueue
{
    public $delay = 10;

    public function handle(CallboardPublishedEvent $event)
    {
        $callboard = $this->callboard($event);
        $subscribers = Subscribers::all();

        if (!$subscribers) {
            return;
        }

        foreach ($subscribers as $subscriber) {
            if ($this->shouldSend($callboard)) {
                Mail::to($subscriber->email)->queue(new SubscriberNotification($callboard));
            }
        }
    }

    private function callboard(CallboardPublishedEvent $event): Callboard
    {
        return $event->callboard;
    }

    private function shouldSend(Callboard $callboard): bool
    {
        return $callboard->isPublished();
    }
}
