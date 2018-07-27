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
            @include('threads.thread_temp')
        @endforeach

        {{$threads->links()}}
    </div>
@endsection