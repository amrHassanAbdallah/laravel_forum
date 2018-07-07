@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row ">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header"><a href="#">{{$thread->creator->name}}</a> posted:
                        <legend>{{$thread->title}}</legend>
                    </div>

                    <div class="card-body">
                        {{$thread->body}}
                    </div>
                </div>
                @foreach($thread->replies as $reply)
                    @include('threads.reply')
                @endforeach
            </div>
            <div class="col-md-2">
                <div class="card">
                    <div class="card-body">
                        This thread was published {{$thread->created_at->diffForHumans()}} by {{$reply->owner->name}} ,
                        and currently has {{$thread->replies->count()}} comments
                    </div>
                </div>
            </div>


        </div>


    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-8" style="margin-top: 10px">
                @if(auth()->check())
                    <form action="{{route('replies.store',$thread->id)}}" method="post">
                        {{csrf_field()}}
                        <div class="form-group">
                            <textarea style="width: 100%" name="body" id="body" placeholder="Have something to say ?"
                                      rows="5"></textarea>
                        </div>

                        <button class="btn btn-default" type="submit">post</button>
                    </form>

                @else
                    <p class="text-center"> Please <a href="{{route('login')}}">sign in</a> to participate in this
                        discussion.</p>

                @endif
            </div>
        </div>
    </div>

@endsection
