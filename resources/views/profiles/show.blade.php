@extends('layouts.app')
@section('content')

    <div class="container">
        <div class="page-header">
            <h1>
                {{$userProfile->name}}
                <small>Since {{$userProfile->created_at->diffForHumans() }}</small>
            </h1>
        </div>
        <br>
        <br>
        @foreach($threads as $thread)
            <div class="card">


                <div class="card-header">
                    <div class="row">
                        <div class="col-md-10">
                            posted:
                            <legend>{{$thread->title}}</legend>
                        </div>
                        <div class="col-md-2">{{$thread->created_at->diffForHumans()}}</div>
                    </div>

                </div>

                <div class="card-body">
                    {{$thread->body}}
                </div>
            </div>

        @endforeach

        {{$threads->links()}}
    </div>
@endsection