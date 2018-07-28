@component('profiles.activities.activity')
    @slot('heading')
        {{$activity->subject->owner->name}}
        replied to :
        <a
                href="{{route('threads.show',[$activity->subject->thread->channel->slug,$activity->subject->thread_id])}}">{{$activity->subject->thread->title}}</a>
    @endslot
    @slot('body')
        {{$activity->subject->body}}

    @endslot
@endcomponent
