<?php

namespace App\Http\Controllers;

use App\Reply;
use App\Thread;

class ReplyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Thread $thread)
    {
        $thread->addReply([
            'body' => \request('body'),
            'user_id' => auth()->user()->id
        ]);

        return back()->with('flash', 'Your reply has been left. ');
    }

    public function destroy(Reply $reply)
    {
        $this->authorize('update', $reply);
        $reply->delete();
        if (request()->expectsJson()) {
            return response(['status' => 'Reply deleted']);
        }
        return back();
    }

    public function update(Reply $reply)
    {
        $this->authorize('update', $reply);

        $reply->update(["body" => request('body')]);
    }

}
