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
        @forelse($activities as $date => $activity)
            <h3 class="page-header*"> {{$date}} </h3>
            <br>
            @foreach($activity as $record)
                @if(view()->exists("profiles.activities.{$record->type}"))
                    @include("profiles.activities.{$record->type}",['activity'=>$record])
                @endif
        @endforeach
            <br>
            <br>
        @empty
            <p>there is no activity</p>
        @endforelse

    </div>
@endsection