<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ThreadsTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();
        $this->seed('ThreadsSeeder');
        $this->thread = factory('App\Thread')->create();

    }

    /**
     * @test
     */
    public function a_user_can_browse_threads()
    {
        $response = $this->get('/threads');
        $response->assertStatus(200);
        $response->assertSee($this->thread->title);

        $response = $this->get(route('threads.show', [$this->thread->channel->slug, $this->thread->id]));
        $response->assertSee($this->thread->title);
    }


    /**
     * @test
     */
    public function a_user_can_read_a_thread()
    {
        $response = $this->get(route('threads.show', [$this->thread->channel->slug, $this->thread->id]));
        $response->assertSee($this->thread->title);
    }

    /**
     * @test
     */
    public function a_user_can_read_replies_that_are_associated_with_a_thread()
    {
        $reply = factory('App\Reply')->create(['thread_id' => $this->thread->id]);
        $this->get(route('threads.show', [$this->thread->channel->slug, $this->thread->id]))
            ->assertSee($reply->body);

    }

    public function testCreator()
    {
        $this->assertInstanceOf('App\User', $this->thread->creator);
    }

    /** @test * */
    public function a_thread_can_add_a_reply()
    {
        $this->thread->addReply([
            'body' => 'fooooooooooooooo',
            'user_id' => 1
        ]);
        $this->assertCount(1, $this->thread->replies);
    }


    /**
     * @test
     */
    public function a_thread_belongs_to_channel()
    {
        $thread = create('App\Thread')->channel;
        $this->assertInstanceOf('App\Channel', $thread);

    }


}
