<?php

namespace Tests\Feature\Domain\Subscription\Actions;

use Domain\Subscription\Actions\SubscriptionCreateAction;
use Domain\Subscription\Data\SubscriptionData;
use Domain\User\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SubscriptionCreateActionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_creates_subscribe()
    {
        $createData = User::factory()->make();

        $subscribeCount = app(SubscriptionCreateAction::class)
            ->handle(new SubscriptionData(['email' => $createData->email]));

        app(SubscriptionCreateAction::class)
            ->handle(new SubscriptionData(['email' => $createData->email]));

        $this->assertDatabaseHas('subscribers', [
            'email' => $createData->email,
        ]);

        $this->assertDatabaseCount(
            'subscribers',
            (int)$subscribeCount,
        );
    }
}
