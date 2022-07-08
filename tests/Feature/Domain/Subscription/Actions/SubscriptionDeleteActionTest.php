<?php

namespace Tests\Feature\Domain\Subscription\Actions;

use Domain\Subscription\Actions\SubscriptionDeleteAction;
use Domain\Subscription\Models\Subscribers;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SubscriptionDeleteActionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_delete_subscribe()
    {
        $subscribes = Subscribers::factory(2)->create();

        $subscribeCount = app(SubscriptionDeleteAction::class)
            ->handle($subscribes->first());

        $this->assertDatabaseMissing(
            'subscribers',
            ['email' => $subscribes->first()->email]
        );

        $this->assertDatabaseCount(
            'subscribers',
            (int)$subscribeCount
        );
    }
}
