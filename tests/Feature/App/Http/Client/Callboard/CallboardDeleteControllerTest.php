<?php

namespace Tests\Feature\App\Http\Client\Callboard;

use Domain\Callboard\Models\Callboard;
use Domain\User\Models\Concerns\UserRole;
use Domain\User\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CallboardDeleteControllerTest extends TestCase
{
    use RefreshDatabase;

    private ?User $user;

    private ?Callboard $callboard;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create(['role' => UserRole::ROLE_ADMINISTRATOR]);
        $this->callboard = Callboard::factory()->create(['user_id' => $this->user->id]);

//        $this->mock(HallDeleteAction::class)->shouldNotReceive('handle');
    }

    /** @test */
    public function is_administrator_can_delete_an_сallboard(): void
    {
        $this->actingAs($this->user);

        $this
            ->delete(route('callboard.delete', ['callboard' => $this->callboard]))
            ->assertOk();
    }

    /** @test */
    public function is_visitor_can_not_delete_an_сallboard(): void
    {
        $visitor = User::factory()->create(['role' => UserRole::ROLE_VISITOR]);
        $this->actingAs($visitor);

        $this
            ->delete(route('callboard.delete', ['callboard' => $this->callboard]))
            ->assertForbidden();
    }

    /** @test */
    public function is_guest_can_not_delete_an_сallboard(): void
    {
        $this
            ->deleteJson(route('callboard.delete', ['callboard' => $this->callboard]))
            ->assertUnauthorized();
    }
}
