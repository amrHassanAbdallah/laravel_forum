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
        $this->get(route('threads.show', $thread->id))
            ->assertSee($thread->title)
            ->assertSee($thread->body);

    }
}
