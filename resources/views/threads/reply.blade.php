<div class="card" style="margin-top: 30px">

    <div class="card-header">
        <div class="level row">
            <div class="col-sm-10">
                <a href="#">{{$reply->owner->name}} </a>
                said {{$reply->created_at->diffForHumans()}}

            </div>


            <div class="col-sm-2">
                <form action="{{route('markAsFavorite',$reply->id)}}">
                    {{csrf_field()}}
                    <button type="submit" class="btn btn-default">favorite</button>
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
