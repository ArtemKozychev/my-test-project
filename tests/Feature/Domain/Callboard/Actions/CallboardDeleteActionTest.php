<?php

namespace Tests\Feature\Domain\Callboard\Actions;

use Domain\Callboard\Actions\CallboardDeleteAction;
use Domain\Callboard\Models\Callboard;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CallboardDeleteActionTest extends TestCase
{
    use RefreshDatabase;

    private ?Callboard $callboard;

    public function setUp(): void
    {
        parent::setUp();

        $this->callboard = Callboard::factory()->create();
    }

    /** @test */
    public function it_delete_callboard()
    {
        app(CallboardDeleteAction::class)->handle($this->callboard);

        $this->assertDatabaseMissing('callboards', $this->callboard->only('id'));
    }
}
