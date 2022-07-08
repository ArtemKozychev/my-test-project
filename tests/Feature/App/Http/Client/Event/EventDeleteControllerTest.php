<?php

namespace Tests\Feature\App\Http\Client\Event;

use Domain\Event\Models\Event;
use Domain\User\Models\Concerns\UserRole;
use Domain\User\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EventDeleteControllerTest extends TestCase
{
    use RefreshDatabase;

    private ?User $user;

    private ?Event $event;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create(['role' => UserRole::ROLE_ADMINISTRATOR]);
        $this->event = Event::factory()->create(['user_id' => $this->user->id]);

//        $this->mock(EventDeleteAction::class)->shouldNotReceive('handle');
    }

    /** @test */
    public function is_administrator_can_delete_an_event(): void
    {
        $this->actingAs($this->user);

        $this
            ->delete(route('event.delete', ['event' => $this->event]))
            ->assertOk();
    }

    /** @test */
    public function is_visitor_can_not_delete_an_event(): void
    {
        $visitor = User::factory()->create(['role' => UserRole::ROLE_VISITOR]);
        $this->actingAs($visitor);

        $this
            ->delete(route('event.delete', ['event' => $this->event]))
            ->assertForbidden();
    }

    /** @test */
    public function is_guest_can_not_delete_an_event(): void
    {
        $this
            ->deleteJson(route('event.delete', ['event' => $this->event]))
            ->assertUnauthorized();
    }
}
