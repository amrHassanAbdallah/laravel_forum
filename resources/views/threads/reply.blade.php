<div class="card" style="margin-top: 30px">

    <div class="card-header">
        <div class="level row">
            <div class="col-sm-10">
                <a href="#">{{$reply->owner->name}} </a>
                said {{$reply->created_at->diffForHumans()}}

            </div>


            <div class="col-sm-2">
                <form action="{{route('favorites.store',[$reply->id])}}" method="post">
                    {{csrf_field()}}
                    <button type="submit"
                            class="btn btn-default" {{$reply->isFavorited()?'disabled':''}}>{{$reply->favorites->count()}} {{str_plural('Favorite',$reply->favorites->count())}}</button>
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
