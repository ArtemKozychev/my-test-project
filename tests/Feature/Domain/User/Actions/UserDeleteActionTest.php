<?php

namespace Tests\Feature\Domain\User\Actions;

use Domain\User\Actions\UserDeleteAction;
use Domain\User\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserDeleteActionTest extends TestCase
{
    use RefreshDatabase;

    private ?User $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
    }

    /** @test */
    public function it_delete_user()
    {
        app(UserDeleteAction::class)->handle($this->user);

        $this->assertDatabaseMissing('events', $this->user->only('id'));
    }
}
