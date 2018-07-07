<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ParticipateinForumTest extends TestCase
{
    use DatabaseMigrations;

    /** @test * */
    public function an_auth_user_may_participate_in_forum_threads()
    {
        $this->be($user = factory('App\User')->create());
        $thread = factory('App\Thread')->create();
        $reply = factory('App\Reply')->make();
        $this->post('/threads/' . $thread->id . '/replies', $reply->toArray());
        $this->get(route('threads.show', [$thread->channel->slug, $thread->id]))
            ->assertSee($reply->body);

    }
}
