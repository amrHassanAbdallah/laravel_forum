@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Forum Threads</div>

                    <div class="card-body">
                        @foreach($threads as $thread)

                            <article>
                                <div class="row">
                                    <div class="col-sm-10">
                                        <h4>

                                            <a href="{{route('threads.show',[$thread->channel->slug,$thread->id])}}">{{$thread->title}}</a>
                                        </h4>
                                    </div>

                                    <div class="col-sm-2">
                                        <strong>{{$thread->replies_count}} {{str_plural('reply',$thread->replies_count)}}</strong>

                                    </div>

                                </div>
                                <div class="body">{{$thread->body}}</div>
                            </article>
                            <hr>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
