@component('profiles.activities.activity')
    @slot('heading')
        <a href="{{$activity->subject->favorited->path()}}">
            {{$userProfile->name}}
            favorited a reply
        </a>

        {{--        <a
                        href="{{route('threads.show',[$activity->subject->thread->channel->slug,$activity->subject->thread_id])}}">{{$activity->subject->thread->title}}</a>--}}
    @endslot
    @slot('body')
        {{$activity->subject->favorited->body}}

    @endslot
@endcomponent
