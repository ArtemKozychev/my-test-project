<?php

namespace Tests\Feature\Domain\Event\Actions;

use Domain\Event\Actions\EventDeleteAction;
use Domain\Event\Models\Event;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EventDeleteActionTest extends TestCase
{
    use RefreshDatabase;

    private ?Event $event;

    public function setUp(): void
    {
        parent::setUp();

        $this->event = Event::factory()->create();
    }

    /** @test */
    public function it_delete_event()
    {
        app(EventDeleteAction::class)->handle($this->event);

        $this->assertDatabaseMissing('events', $this->event->only('id'));
    }
}
