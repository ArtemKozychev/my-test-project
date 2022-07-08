<?php

namespace Tests\Feature\App\Http\Client\Hall;

use Domain\Hall\Models\Hall;
use Domain\User\Models\Concerns\UserRole;
use Domain\User\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HallCreateControllerTest extends TestCase
{
    use RefreshDatabase;

    private ?User $user;

    private array $createData;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create(['role' => UserRole::ROLE_ADMINISTRATOR]);
        $this->createData = Hall::factory()->make()->getAttributes();

//        $this->mock(HallCreateAction::class)->shouldNotReceive('handle');
    }

    /** @test */
    public function is_administrator_can_create_an_hall(): void
    {
        $this->actingAs($this->user);

        $this
            ->postJson(route('hall.create'), $this->createData)
            ->assertOk();
    }

    /** @test */
    public function is_user_can_not_create_same_number_hall(): void
    {
        $this->actingAs($this->user);

        Hall::factory()->create([
            'number' => 1
        ]);

        $this->createData['number'] = 1;

        $this
            ->postJson(route('hall.create'), $this->createData)
            ->assertJsonValidationErrors('number');
    }

    /** @test */
    public function is_visitor_can_not_create_an_hall(): void
    {
        $this->user->role = UserRole::ROLE_VISITOR;
        $this->actingAs($this->user);

        $this
            ->postJson(route('hall.create'), $this->createData)
            ->assertForbidden();
    }

    /** @test */
    public function is_guest_can_not_create_an_hall(): void
    {
        $this
            ->postJson(route('hall.create'), $this->createData)
            ->assertUnauthorized();
    }
}
