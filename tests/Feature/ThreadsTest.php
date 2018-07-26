<?php

namespace Tests\Feature;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ThreadsTest extends TestCase
{
    use DispatchesJobs;
    use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();
        //$this->seed('ThreadsSeeder');
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


    /**
     * @test
     */
    public function a_user_can_filter_threads_according_to_a_channel()
    {
        $channel = create('App\Channel');
        $threadChannel = create('App\Thread', ['channel_id' => $channel->id]);
        $threadNotInChannel = create('App\Thread');
        $this->get(route('threads.channel', $channel->slug))
            ->assertSee($threadChannel->title)
            ->assertDontSee($threadNotInChannel->title);
    }


    /**
     * @test
     */
    public function a_user_can_filter_a_thread_by_user_name()
    {
        //filter the threads index with user name by visiting the threads index and return all threads by this user if exist if not return empty

        //create thread with unique user
        $this->singIn();
        $thread = create('App\Thread', ["user_id" => auth()->id()]);
        $threadNotCreatedByThisUser = create('App\Thread');
        $this->json('get',
            route('threads.index') . '?username=' . auth()->user()->name)->assertSee($thread->title)->assertDontSee($threadNotCreatedByThisUser->title);


    }

    /**
     * @test
     */
    public function a_user_can_filter_a_thread_by_popularity()
    {
        $threadWithTwoReplies = create('App\Thread');
        create('App\Reply', ['thread_id' => $threadWithTwoReplies->id], 2);

        $threadWithThreeReplies = create('App\Thread');
        create('App\Reply', ['thread_id' => $threadWithThreeReplies->id], 3);

        $threadWithNoReploes = $this->thread;

        $response = $this->getJson('threads?popular=1')->json();

        $this->assertEquals([3, 2, 0], array_column($response, 'replies_count'));
    }


}
