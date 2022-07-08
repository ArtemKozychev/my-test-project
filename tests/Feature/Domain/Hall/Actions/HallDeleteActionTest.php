<?php

namespace Tests\Feature\Domain\Hall\Actions;

use Domain\Hall\Actions\HallDeleteAction;
use Domain\Hall\Models\Hall;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HallDeleteActionTest extends TestCase
{
    use RefreshDatabase;

    private ?Hall $hall;

    public function setUp(): void
    {
        parent::setUp();

        $this->hall = Hall::factory()->create();
    }

    /** @test */
    public function it_delete_event()
    {
        app(HallDeleteAction::class)->handle($this->hall);

        $this->assertDatabaseMissing('halls', $this->hall->only('id'));
    }
}
