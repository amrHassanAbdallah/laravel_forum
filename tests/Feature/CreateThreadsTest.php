<?php

namespace Tests\Feature;

use App\Thread;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class CreateThreadsTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @test
     */
    public function guests_may_not_create_threads()
    {
        $this->expectException('Illuminate\Auth\AuthenticationException');
        $thread = factory('App\Thread')->raw();
        $this->post('/threads', $thread);

        $this->expectException('Illuminate\Auth\AuthenticationException');
        $this->get(route('threads.create'))->assertRedirect('/login');
    }



    /**
     * @test
     */
    public function an_auth_user_can_create_new_forum_threads()
    {
        $this->singIn();

        $thread = make('App\Thread');

        $this->post('/threads', $thread->toArray());
        $thread = Thread::latest()->first();

        $this->get(route('threads.show', [$thread->channel->slug, $thread->id]))
            ->assertSee($thread->title)
            ->assertSee($thread->body);

    }


    /**
     * @test
     */
    public function unauth_user_cannot_delete_threads()
    {

        $thread = create('App\Thread');
        $this->expectException('Illuminate\Auth\AuthenticationException');
        $this->json('DELETE', route('threads.destroy', $thread->id))->assertStatus(204);

        $this->singIn();
        $this->delete(route('threads.destroy', $thread->id))->assertStatus(403);

    }


    /**
     * @test
     */
    public function a_auth_user_can_delete_a_thread()
    {
        $this->singIn();
        $thread = create('App\Thread', ['user_id' => auth()->id()]);
        $reply = create('App\Reply', ['thread_id' => $thread->id]);

        $this->json('DELETE', route('threads.destroy', $thread->id))->assertStatus(204);

        $this->assertDatabaseMissing('threads', $thread->toArray());
        $this->assertDatabaseMissing('replies', $reply->toArray());


    }




}
