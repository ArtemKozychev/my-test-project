<?php

namespace Tests\Feature\Domain\Event\Actions;

use Domain\Event\Actions\EventCreateAction;
use Domain\Event\Data\EventCreateData;
use Domain\Event\Models\Event;
use Domain\User\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EventCreateActionTest extends TestCase
{
    use RefreshDatabase;

    private mixed $createData;

    public function setUp(): void
    {
        parent::setUp();

        $this->createData = Event::factory()->make();
    }

    /** @test */
    public function it_creates_event()
    {
        $result = app(EventCreateAction::class)->handle(new EventCreateData(
            $this->createData->toArray()
        ));

        $this->assertDatabaseHas('events', [
            'user_id' => $this->createData->user_id,
        ]);

        $this->assertNotNull($result->created_at);
        $this->assertNotNull($result->updated_at);
    }
}
