<?php

namespace Tests\Feature\Domain\Callboard\Actions;

use Domain\Callboard\Actions\CallboardCreateAction;
use Domain\Callboard\Data\CallboardCreateData;
use Domain\Callboard\Models\Callboard;
use Domain\User\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CallboardCreateActionTest extends TestCase
{
    use RefreshDatabase;

    private mixed $createData;

    public function setUp(): void
    {
        parent::setUp();

        $this->createData = Callboard::factory()->make();
    }

    /** @test */
    public function it_creates_callboard()
    {
        $result = app(CallboardCreateAction::class)->handle(new CallboardCreateData(
            $this->createData->toArray()
        ));

        $this->assertDatabaseHas('callboards', [
            'user_id' => $this->createData->user_id,
        ]);

        $this->assertNotNull($result->created_at);
        $this->assertNotNull($result->updated_at);
    }
}
