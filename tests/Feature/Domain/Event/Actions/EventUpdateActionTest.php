<?php

namespace Tests\Feature\Domain\Event\Actions;

use Domain\Event\Actions\EventUpdateAction;
use Domain\Event\Data\EventUpdateData;
use Domain\Event\Models\Event;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EventUpdateActionTest extends TestCase
{
    use RefreshDatabase;

    private ?Event $event;

    public function setUp(): void
    {
        parent::setUp();

        $this->event = Event::factory()->create();
    }

    /** @test */
    public function it_update_event()
    {
        $updateData = Event::factory()->make();

        app(EventUpdateAction::class)->handle(
            $this->event,
            new EventUpdateData($updateData->getAttributes()
            ));

        $this->assertSame($updateData->name, $this->event->name);
    }
}
