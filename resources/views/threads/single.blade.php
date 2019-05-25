@extends('layouts.app')

@section('content')
    <thread-view inline-template :initial-replies-count="{{$thread->replies_count}}">
        <div class="container">
            <div class="row ">
                <div class="col-md-10">
                    @include('threads.thread_temp')
                    <replies :data="{{$thread->replies}}" @removed="repliesCount--"></replies>
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

        <div class="container">
            <div class="row">
                <div class="col-md-10" style="margin-top: 10px">
                    <div v-if="signedIn">
                        <form action="{{route('replies.store',$thread->id)}}" method="post">
                            {{csrf_field()}}
                            <div class="form-group">
                            <textarea style="width: 100%" name="body" id="body" placeholder="Have something to say ?"
                                      rows="5"></textarea>
                            </div>

                            <button class="btn btn-default" type="submit">post</button>
                        </form>
                    </div>
                    <div v-else>

                        <p class="text-center"> Please <a href="{{route('login')}}">sign in</a> to participate in this
                            discussion.</p>
                    </div>


                </div>
            </div>
        </div>
    </thread-view>
@endsection
