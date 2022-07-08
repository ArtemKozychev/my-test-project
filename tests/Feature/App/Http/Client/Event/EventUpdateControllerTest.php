<?php

namespace Tests\Feature\App\Http\Client\Event;

use Domain\Event\Actions\EventUpdateAction;
use Domain\Event\Models\Event;
use Domain\User\Models\Concerns\UserRole;
use Domain\User\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EventUpdateControllerTest extends TestCase
{
    use RefreshDatabase;

    private ?User $user;

    private ?Event $event;

    private array $updateData;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create(['role' => UserRole::ROLE_ADMINISTRATOR]);
        $this->event = Event::factory()->create(['user_id' => $this->user->id]);
        $this->updateData = Event::factory()->make()->getAttributes();

//        $this->mock(EventUpdateAction::class)->shouldNotReceive('handle');
    }

    /** @test */
    public function is_administrator_can_update_an_event(): void
    {
        $this->actingAs($this->user);

        $this
            ->patchJson(route('event.update', ['event' => $this->event]), $this->updateData)
            ->assertOk();
    }

    /** @test */
    public function is_user_can_not_set_same_date_for_some_events(): void
    {
        $this->actingAs($this->user);

        $this->updateData['date_start'] = now()->parse('2021-08-24 17:35:00');
        $this->updateData['date_end'] = now()->parse('2021-08-25 19:35:00');

        Event::factory()->create($this->updateData);

        $this
            ->patchJson(route('event.update', ['event' => $this->event]), $this->updateData)
            ->assertJsonValidationErrors('date_start');
    }

    /** @test */
    public function is_visitor_can_not_update_an_event(): void
    {
        $this->user->role = UserRole::ROLE_VISITOR;
        $this->actingAs($this->user);

        $this
            ->patchJson(route('event.update', ['event' => $this->event]), $this->updateData)
            ->assertForbidden();
    }

    /** @test */
    public function is_guest_can_not_update_an_event(): void
    {
        $this
            ->patchJson(route('event.update', ['event' => $this->event]), $this->updateData)
            ->assertUnauthorized();
    }
}
