<?php

namespace Tests\Feature\App\Http\Client\Callboard;

use Domain\Callboard\Models\Callboard;
use Domain\User\Models\Concerns\UserRole;
use Domain\User\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CallboardCreateControllerTest extends TestCase
{
    use RefreshDatabase;

    private ?User $user;

    private array $createData;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create(['role' => UserRole::ROLE_ADMINISTRATOR]);
        $this->createData = Callboard::factory()->make()->getAttributes();

//        $this->mock(HallCreateAction::class)->shouldNotReceive('handle');
    }

    /** @test */
    public function is_administrator_can_create_an_сallboard(): void
    {
        $this->actingAs($this->user);

        $this
            ->postJson(route('callboard.create'), $this->createData)
            ->assertOk();
    }

    /** @test */
    public function is_visitor_can_not_create_an_сallboard(): void
    {
        $this->user->role = UserRole::ROLE_VISITOR;
        $this->actingAs($this->user);

        $this
            ->postJson(route('callboard.create'), $this->createData)
            ->assertForbidden();
    }

    /** @test */
    public function is_guest_can_not_create_an_сallboard(): void
    {
        $this
            ->postJson(route('callboard.create'), $this->createData)
            ->assertUnauthorized();
    }
}
