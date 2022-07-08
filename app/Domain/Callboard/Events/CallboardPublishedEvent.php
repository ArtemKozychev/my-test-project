<?php

namespace Domain\Callboard\Events;

use Domain\Callboard\Models\Callboard;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CallboardPublishedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(public Callboard $callboard)
    {

    }
}
