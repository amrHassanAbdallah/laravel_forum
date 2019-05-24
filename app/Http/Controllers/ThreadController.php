<?php

namespace App\Http\Controllers;

use App\Channel;
use App\Filters\ThreadFilters;
use App\Thread;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ThreadController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @param Channel $channel
     * @param ThreadFilters $filters
     * @return Response
     */
    public function index(Channel $channel, ThreadFilters $filters)
    {
        $threads = $this->getThreads($channel, $filters);
        if (\request()->wantsJson()) {
            return $threads;
        }
        return view('threads.index')->with('threads', $threads);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('threads.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            'channel_id' => 'required|exists:channels,id'
        ]);

        $thread = Thread::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'channel_id' => $request->channel_id,
            'body' => $request->body,

        ]);

        return redirect(route('threads.show', [$thread->channel->slug, $thread->id]))->with([
            'thread' => $thread,
            'flash' => 'Your thread has been published ! '
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param Thread $thread
     * @return Response
     */
    public function show($channel, Thread $thread)
    {
        //return $thread->load('replies.favorites')->load('replies.owner');

        return view('threads.single')->with([
            'thread' => $thread,
            'replies' => $thread->replies()->paginate(8),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Thread $thread
     * @return Response
     */
    public function edit(Thread $thread)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Thread $thread
     * @return Response
     */
    public function update(Request $request, Thread $thread)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Thread $thread
     * @return Response
     */
    public function destroy(Thread $thread)
    {
        $this->authorize('delete', $thread);
        $thread->delete();

        if (request()->wantsJson()) {

            return response([], 204);
        }

        return redirect(route('threads.index'));
    }

    /**
     * @param Channel $channel
     * @param ThreadFilters $filters
     * @return Channel|Builder|null
     */
    protected function getThreads(Channel $channel, ThreadFilters $filters)
    {
        $threads = Thread::with('channel')->latest();
        $threads = Thread::filter($threads, $filters);
        if ($channel->exists) {
            $threads->where('channel_id', $channel->id);
        }

        return $threads->get();

    }
}
