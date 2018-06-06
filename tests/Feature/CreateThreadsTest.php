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
    public function an_auth_user_can_create_new_forum_threads()
    {
        $this->actingAs(factory('App\User')->create());

        $thread = factory('App\Thread')->make();

        $this->post('/threads', $thread->toArray());

        $thread = Thread::where($thread->toArray())->first();
        var_dump($thread);
        $this->get(route('threads.show', $thread->id))
            ->assertSee($thread->title)
            ->assertSee($thread->body);

    }
}
