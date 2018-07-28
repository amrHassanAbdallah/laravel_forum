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
        @foreach($activities as $date => $activity)
            <h3 class="page-header*"> {{$date}} </h3>
            <br>
            @foreach($activity as $record)
                @include("profiles.activities.{$record->type}",['activity'=>$record])
        @endforeach
            <br>
            <br>
        @endforeach

    </div>
@endsection