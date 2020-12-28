<?php

use Illuminate\Database\Seeder;
use Laratube\Channel;
use Laratube\Comment;
use Laratube\Subscription;
use Laratube\User;
use Laratube\Video;

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
        factory(Subscription::class, 100)->create([
            'channel_id' => $channel1->id
        ]);

        factory(Subscription::class, 100)->create([
            'channel_id' => $channel2->id
        ]);

        //test video
        $video = factory(Video::class)->create([
            'channel_id' => $channel1->id
        ]);

        //test comments for the video
        factory(Comment::class, 50)->create([
            'video_id' => $video->id
        ]);

        $comment = Comment::first();

        //test replies for the first comment
        factory(Comment::class, 50)->create([
            'video_id' => $video->id,
            'comment_id' => $comment->id
        ]);
    }
}
