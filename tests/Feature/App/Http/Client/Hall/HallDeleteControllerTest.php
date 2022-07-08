<?php

namespace Tests\Feature\App\Http\Client\Hall;

use Domain\Hall\Models\Hall;
use Domain\User\Models\Concerns\UserRole;
use Domain\User\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HallDeleteControllerTest extends TestCase
{
    use RefreshDatabase;

    private ?User $user;

    private ?Hall $hall;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create(['role' => UserRole::ROLE_ADMINISTRATOR]);
        $this->hall = Hall::factory()->create(['user_id' => $this->user->id]);

//        $this->mock(HallDeleteAction::class)->shouldNotReceive('handle');
    }

    /** @test */
    public function is_administrator_can_delete_an_hall(): void
    {
        $this->actingAs($this->user);

        $this
            ->delete(route('hall.delete', ['hall' => $this->hall]))
            ->assertOk();
    }

    /** @test */
    public function is_visitor_can_not_delete_an_hall(): void
    {
        $visitor = User::factory()->create(['role' => UserRole::ROLE_VISITOR]);
        $this->actingAs($visitor);

        $this
            ->delete(route('hall.delete', ['hall' => $this->hall]))
            ->assertForbidden();
    }

    /** @test */
    public function is_guest_can_not_delete_an_hall(): void
    {
        $this
            ->deleteJson(route('hall.delete', ['hall' => $this->hall]))
            ->assertUnauthorized();
    }
}
