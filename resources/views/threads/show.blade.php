@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header yellow"><h3><b>{{$thread->title}}</b>
                            by
                            <a href="{{url('threads') }}?by={{  $thread->owner->name }}">

                                @if (auth()->check() && auth()->user()->id == $thread->owner['id'])
                                    Mine
                                @else
                                    {{$thread->owner->name}}
                                @endif


                            </a>
                            in <a href="{{$thread->channel->path()}}"> {{$thread->channel->name}}</a>
                        </h3></div>

                    <div class="card-body">
                        <p class="text-lg-left">  {{$thread->body}}</p>
                    </div>
                </div>


            </div>
        </div>

        <br>
        @if (count($thread->replies ))

            <div class="row">
                <div class="col-md-12">


                    <div class="card">
                        <div class="card-header"><h4>Replies</h4></div>
                        <div class="card-body">
                            @foreach($thread->replies as $reply)
                                <div class="card">
                                    <div class="card-header"><a href=""> {{$reply->owner->name}}</a>
                                        since {{$reply->created_at->diffForHumans()}}</div>
                                    <div class="card-body">

                                        <p class="text-sm-left">  {{$reply->body}}</p>
                                    </div>
                                </div>
                                <br>
                            @endforeach
                        </div>
                    </div>


                </div>

            </div>

        @else

            <div class="alert alert-warning text-center" role="alert">
                <strong>No comments!</strong>
            </div>

        @endif


        <br>
        @if (auth()->check())
            {{--Determine if the current user is authenticated. --}}

            <div class="row">
                <div class="col-md-12">

                    <form action="{{$thread->path().'/replies'}}" method="post">
                        {{csrf_field()}}
                        <div class="form-group">
                            <textarea name="body" rows="5" class="form-control"
                                      placeholder="have something to say?"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary float-right">Reply
                        </button>
                    </form>


                </div>
            </div>
        @else
            <div class="alert alert-warning text-center" role="alert">
                <strong>Please <a href="{{route('login')}}">Login</a> to participate!</strong>
            </div>

        @endif
        <br>



@endsection
