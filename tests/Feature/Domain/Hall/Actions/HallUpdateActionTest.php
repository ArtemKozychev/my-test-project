<?php

namespace Tests\Feature\Domain\Hall\Actions;

use Domain\Hall\Actions\HallUpdateAction;
use Domain\Hall\Data\HallUpdateData;
use Domain\Hall\Models\Hall;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HallUpdateActionTest extends TestCase
{
    use RefreshDatabase;

    private ?Hall $hall;

    private mixed $updateData;

    public function setUp(): void
    {
        parent::setUp();

        $this->hall = Hall::factory()->create();
        $this->updateData = Hall::factory()->make();
    }

    /** @test */
    public function it_update_hall()
    {
        app(HallUpdateAction::class)
            ->handle($this->hall, new HallUpdateData($this->updateData->getAttributes()));

        $this->assertSame($this->updateData->number, $this->hall->number);
    }
}
