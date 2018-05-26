<?php

namespace App\Http\Controllers;

use App\Thread;

class ReplyController extends Controller
{
    public function store(Thread $thread)
    {
        $thread->addReply([
            'body' => \request('body'),
            'user_id' => auth()->user()->id
        ]);

        return back();
    }
}
