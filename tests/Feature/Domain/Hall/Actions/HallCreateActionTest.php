<?php

namespace Tests\Feature\Domain\Hall\Actions;

use Domain\Hall\Actions\HallCreateAction;
use Domain\Hall\Data\HallCreateData;
use Domain\Hall\Models\Hall;
use Domain\User\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HallCreateActionTest extends TestCase
{
    use RefreshDatabase;

    private mixed $createData;

    public function setUp(): void
    {
        parent::setUp();

        $this->createData = Hall::factory()->make();
    }

    /** @test */
    public function it_creates_hall()
    {
        $result = app(HallCreateAction::class)->handle(new HallCreateData(
            $this->createData->toArray()
        ));

        $this->assertDatabaseHas('halls', [
            'user_id' => $this->createData->user_id,
        ]);

        $this->assertNotNull($result->created_at);
        $this->assertNotNull($result->updated_at);
    }
}
