<?php

namespace Tests\Feature\App\Http\Client\Event;

use Domain\Event\Actions\EventCreateAction;
use Domain\Event\Models\Event;
use Domain\Hall\Models\Hall;
use Domain\User\Models\Concerns\UserRole;
use Domain\User\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EventCreateControllerTest extends TestCase
{
    use RefreshDatabase;

    private ?User $user;

    private array $createData;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create(['role' => UserRole::ROLE_ADMINISTRATOR]);
        $this->hall = Hall::factory()->create();
        $this->createData = Event::factory()->make(['hall_id' => $this->hall->id])->getAttributes();

//        $this->mock(EventCreateAction::class)->shouldNotReceive('handle');
    }

    /** @test */
    public function is_administrator_can_create_an_event(): void
    {
        $this->actingAs($this->user);

        $this
            ->postJson(route('event.create'), $this->createData)
            ->assertOk();
    }

    /** @test */
    public function is_user_can_not_create_some_events_for_one_period(): void
    {
        $this->actingAs($this->user);


        Event::factory()->create([
            'hall_id' => $this->hall->id,
            'date_start' => now()->parse('2021-08-24 16:35:00'),
            'date_end' => now()->parse('2021-08-24 19:35:00')
        ]);

        $this->createData['hall_id'] = $this->hall->id;
        $this->createData['date_start'] = now()->parse('2021-08-24 17:35:00');
        $this->createData['date_end'] = now()->parse('2021-08-25 19:35:00');

        $this
            ->postJson(route('event.create'), $this->createData)
            ->assertJsonValidationErrors('date_start');
    }

    /** @test */
    public function is_visitor_can_not_create_an_event(): void
    {
        $this->user->role = UserRole::ROLE_VISITOR;
        $this->actingAs($this->user);

        $this
            ->postJson(route('event.create'), $this->createData)
            ->assertForbidden();
    }

    /** @test */
    public function is_guest_can_not_create_an_event(): void
    {
        $this
            ->postJson(route('event.create'), $this->createData)
            ->assertUnauthorized();
    }
}
