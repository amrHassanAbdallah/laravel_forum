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


    /**
     * @test
     */
    public function unauth_users_cannot_delete_a_reply()
    {
        $this->expectException('Illuminate\Auth\AuthenticationException');

        $reply = create('App\Reply');

        $this->delete("/replies/{$reply->id}")
            ->assertRedirect('login');

    }


    /**
     * @test
     */
    public function a_user_can_not_delete_a_reply_does_not_belong_to_him()
    {
        $this->expectException('Illuminate\Auth\Access\AuthorizationException');

        $reply = create('App\Reply');

        $this->singIn()
            ->delete("/replies/{$reply->id}")
            ->assertStatus(403);

    }

    /**
     * @test
     */
    public function a_user_can_not_update_a_reply_does_not_belong_to_him()
    {
        $this->expectException('Illuminate\Auth\Access\AuthorizationException');

        $reply = create('App\Reply');

        $this->singIn()
            ->delete("/replies/{$reply->id}")
            ->assertStatus(403);

    }

    /**
     * @test
     */
    public function auth_user_delete_his_reply()
    {
        $this->singIn();

        $reply = create('App\Reply', ["user_id" => auth()->id()]);

        $this->delete("/replies/{$reply->id}")
            ->assertStatus(302);

        $this->assertDatabaseMissing('replies', $reply->toArray());

    }


    /**
     * @test
     */
    public function auth_users_can_update_replies()
    {
        $this->singIn();

        $reply = create('App\Reply', ["user_id" => auth()->id()]);
        $updatedReply = 'You been changed , fool';
        $this->patch("/replies/{$reply->id}", ['body' => $updatedReply]);
        $this->assertDatabaseHas('replies', ['id' => $reply->id, 'body' => $updatedReply]);

    }


}
