<?php

namespace Tests\Feature\Domain\User\Actions;

use Domain\User\Actions\UserUpdateAction;
use Domain\User\Data\UserUpdateData;
use Domain\User\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserUpdateActionTest extends TestCase
{
    use RefreshDatabase;

    private ?User $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
    }

    /** @test */
    public function it_update_user()
    {
        $updateData = User::factory()->make();

        app(UserUpdateAction::class)->handle($this->user, new UserUpdateData($updateData->getAttributes()));

        $this->assertSame($updateData->name, $this->user->name);
    }
}
