<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ReplyTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();
        $this->reply = factory('App\Reply')->create();

    }

    public function testOwner()
    {
        $this->assertInstanceOf('App\User', $this->reply->owner);
    }
}
