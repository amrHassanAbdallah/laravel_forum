@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Create a new Thread</div>

                    <div class="card-body">
                        <form method="post" action="{{route('threads.store')}}">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label for="title">Title :</label>
                                <input type="text" class="form-control" id="title" name="title">
                            </div>

                            <div class="form-group">
                                <label for="body">body</label>
                                <textarea name="body" id="body" cols="30" rows="10" class="form-control"></textarea>
                            </div>
                            <div class="form-group">
                                <select name="channel_id">
                                    @foreach($channels as $channel)
                                        <option value="{{$channel->id}}">{{$channel->slug}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-default">Publish</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
