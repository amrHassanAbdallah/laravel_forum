<div id="reply-{{$reply->id}}" class="card" style="margin-top: 30px">

    <div class="card-header">
        <div class="level row">
            <div class="col-sm-10">
                <a href="{{route('users.show',$thread->creator->name)}}">{{$reply->owner->name}} </a>
                said {{$reply->created_at->diffForHumans()}}

            </div>


            <div class="col-sm-2">
                <form action="{{route('favorites.store',[$reply->id])}}" method="post">
                    {{csrf_field()}}
                    <button type="submit"
                            class="btn btn-default" {{$reply->isFavorited()?'disabled':''}}>{{$reply->favoritesCount()}} {{str_plural('Favorite',$reply->favoritesCount())}}</button>
                </form>
            </div>
        </div>
    </div>

        <div class="card-body">
            <article>
                <div class="body">{{$reply->body}}</div>
            </article>
            <hr>

        </div>
    </div>
