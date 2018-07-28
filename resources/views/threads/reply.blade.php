<reply :attributes="{{$reply}}" inline-template v-cloak>


    <div id="reply-{{$reply->id}}" class="card" style="margin-top: 30px">

        <div class="card-header">
            <div class="level row">
                <div class="col-sm-10">
                    <a href="{{route('users.show',$thread->creator->name)}}">{{$reply->owner->name}} </a>
                    said {{$reply->created_at->diffForHumans()}}

                </div>
                @if(Auth::check())
                <favorite :reply="{{$reply}}"></favorite>
                @endif
                {{--
                                <div class="col-sm-2">
                                    <form action="{{route('favorites.store',[$reply->id])}}" method="post">
                                        {{csrf_field()}}
                                        <button type="submit"
                                                class="btn btn-default" {{$reply->isFavorited()?'disabled':''}}>{{$reply->favoritesCount()}} {{str_plural('Favorite',$reply->favoritesCount())}}</button>
                                    </form>
                                </div>
                --}}
            </div>
        </div>

        <div class="card-body">
            <article v-if="editing">
                <textarea class="form-control-plaintext" v-model="body"></textarea>
                <button class="btn btn-xs btn-primary" @click="update">Update</button>
                <button class="btn btn-xs btn-link" @click="editing=false">Cancel</button>
            </article>

            <article v-else v-text="body">
            </article>
            <hr>

        </div>
        @can('update',$reply)

            <div class="card-footer">
                <button class="btn btn-xs d-inline-block" @click="editing=true"> Edit</button>
                <button class="btn btn-danger btn-xs d-inline-block" @click="destroy"> Delete</button>

            </div>
        @endcan
    </div>
</reply>
