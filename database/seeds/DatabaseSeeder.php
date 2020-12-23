<?php

use Illuminate\Database\Seeder;
use Laratube\Channel;
use Laratube\Subscription;
use Laratube\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //Users
        $user1 = factory(User::class)->create([
            'email' => 'john@doe.com'
        ]);

        $user2 = factory(User::class)->create([
            'email' => 'jane@doe.com'
        ]);


        //Channels
        $channel1 = factory(Channel::class)->create([
            'user_id' => $user1->id
        ]);

        $channel2 = factory(Channel::class)->create([
            'user_id' => $user2->id
        ]);

        //Subscriptions
        $channel1->subscriptions()->create([
            'user_id' => $user2->id
        ]);

        $channel2->subscriptions()->create([
            'user_id' => $user1->id
        ]);


        //Test subs
        factory(Subscription::class, 500)->create([
            'channel_id' => $channel1->id
        ]);

        factory(Subscription::class, 500)->create([
            'channel_id' => $channel2->id
        ]);
    }
}
