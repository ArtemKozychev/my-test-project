<?php

namespace Tests\Feature\App\Http\Client\Hall;

use Domain\Hall\Models\Hall;
use Domain\User\Models\Concerns\UserRole;
use Domain\User\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HallUpdateControllerTest extends TestCase
{
    use RefreshDatabase;

    private ?User $user;

    private ?Hall $hall;

    private array $updateData;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create(['role' => UserRole::ROLE_ADMINISTRATOR]);
        $this->hall = Hall::factory()->create(['user_id' => $this->user->id]);
        $this->updateData = Hall::factory()->make()->getAttributes();

//        $this->mock(HallUpdateAction::class)->shouldNotReceive('handle');
    }

    /** @test */
    public function is_administrator_can_update_an_hall(): void
    {
        $this->actingAs($this->user);

        $this
            ->patchJson(route('hall.update', ['hall' => $this->hall]), $this->updateData)
            ->assertOk();
    }

    /** @test */
    public function is_user_can_not_set_same_number_for_some_hall(): void
    {
        $this->actingAs($this->user);

        $this->updateData['number'] = 2;

        Hall::factory()->create($this->updateData);

        $this
            ->patchJson(route('hall.update', ['hall' => $this->hall]), $this->updateData)
            ->assertJsonValidationErrors('number');
    }

    /** @test */
    public function is_visitor_can_not_update_an_hall(): void
    {
        $this->user->role = UserRole::ROLE_VISITOR;
        $this->actingAs($this->user);

        $this
            ->patchJson(route('hall.update', ['hall' => $this->hall]), $this->updateData)
            ->assertForbidden();
    }

    /** @test */
    public function is_guest_can_not_update_an_hall(): void
    {
        $this
            ->patchJson(route('hall.update', ['hall' => $this->hall]), $this->updateData)
            ->assertUnauthorized();
    }
}
