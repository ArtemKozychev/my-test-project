<?php

namespace Tests\Feature\Domain\User\Actions;

use Domain\User\Actions\UserCreateAction;
use Domain\User\Data\UserCreateData;
use Domain\User\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserCreateActionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_creates_user()
    {
        $createData = User::factory()->make();

        $result = app(UserCreateAction::class)->handle(new UserCreateData($createData->getAttributes()));

        $this->assertDatabaseHas('users', [
            'name' => $result->name,
        ]);

        $this->assertNotNull($result->created_at);
        $this->assertNotNull($result->updated_at);
    }
}
