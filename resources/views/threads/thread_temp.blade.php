<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-sm-10">
                <a
                        href="{{route('users.show',$thread->creator->name)}}">{{$thread->creator->name}}</a>
                posted:
                <legend>{{$thread->title}}</legend>
            </div>


            @can('update',$thread)
                <div class="col-sm-2">
                    <form action="{{route('threads.destroy',[$thread->id])}}" method="post">
                        {{csrf_field()}}
                        {{method_field('DELETE')}}
                        <button type="submit"
                                class="btn btn-link">Delete thread
                        </button>
                    </form>
                </div>
            @endif

        </div>
    </div>


    <div class="card-body">
        {{$thread->body}}
    </div>
</div>