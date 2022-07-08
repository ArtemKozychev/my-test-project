<?php

namespace Tests\Feature\Domain\Callboard\Actions;

use Domain\Callboard\Actions\CallboardUpdateAction;
use Domain\Callboard\Data\CallboardUpdateData;
use Domain\Callboard\Models\Callboard;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class CallboardUpdateActionTest extends TestCase
{
    use RefreshDatabase;

    private ?Callboard $callboard;

    private mixed $updateData;

    public function setUp(): void
    {
        parent::setUp();

        $this->callboard = Callboard::factory()->create();
        $this->updateData = Callboard::factory()->make();
    }

    /** @test */
    public function it_update_event()
    {
        Event::fake();

        app(CallboardUpdateAction::class)
            ->handle($this->callboard, new CallboardUpdateData($this->updateData->getAttributes()));

        $this->assertSame($this->updateData->name, $this->callboard->name);
    }
}
