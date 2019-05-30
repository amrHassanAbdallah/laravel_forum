@extends('layouts.app')

@section('content')
    <thread-view inline-template :initial-replies-count="{{$thread->replies_count}}">
        <div class="container">
            <div class="row ">
                <div class="col-md-10">
                    @include('threads.thread_temp')
                    <replies :data="{{$thread->replies}}" @removed="repliesCount--" @added="repliesCount++"></replies>
                    {{--    @foreach($replies as $reply)
                            @include('threads.reply')
                        @endforeach
                        {{$replies->links()}}--}}
                </div>
                <div class="col-md-2">
                    <div class="card">
                        <div class="card-body">
                            This thread was published {{$thread->created_at->diffForHumans()}} by <a
                                    href="{{route('users.show',$thread->creator->name)}}">{{$thread->creator->name}}</a>
                            ,
                            and currently has <span v-text="repliesCount"></span> {{str_plural
                        ('comment',
                        $thread->replies_count)}}
                        </div>
                    </div>
                </div>


            </div>


        </div>


    </thread-view>
@endsection
