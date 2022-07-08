<?php

namespace Tests\Feature\App\Http\Client\Callboard;

use Domain\Callboard\Models\Callboard;
use Domain\User\Models\Concerns\UserRole;
use Domain\User\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CallboardUpdateControllerTest extends TestCase
{
    use RefreshDatabase;

    private ?User $user;

    private ?Callboard $callboard;

    private array $updateData;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create(['role' => UserRole::ROLE_ADMINISTRATOR]);
        $this->callboard = Callboard::factory()->create(['user_id' => $this->user->id]);
        $this->updateData = Callboard::factory()->make()->getAttributes();

//        $this->mock(СallboardUpdateAction::class)->shouldNotReceive('handle');
    }

    /** @test */
    public function is_administrator_can_update_an_сallboard(): void
    {
        $this->actingAs($this->user);

        $this
            ->patchJson(route('callboard.update', ['callboard' => $this->callboard]), $this->updateData)
            ->assertOk();
    }

    /** @test */
    public function is_visitor_can_not_update_an_сallboard(): void
    {
        $this->user->role = UserRole::ROLE_VISITOR;
        $this->actingAs($this->user);

        $this
            ->patchJson(route('callboard.update', ['callboard' => $this->callboard]), $this->updateData)
            ->assertForbidden();
    }

    /** @test */
    public function is_guest_can_not_update_an_сallboard(): void
    {
        $this
            ->patchJson(route('callboard.update', ['callboard' => $this->callboard]), $this->updateData)
            ->assertUnauthorized();
    }
}
