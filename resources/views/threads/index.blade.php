@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Threads

                            @if (request('by'))
                                by {{$user->name}}
                            @endif


                            @if (isset($channel))
                                in {{$channel->name}}
                            @endif


                            @if (auth()->check())
                                <span class="float-right"><a name="" id=""
                                                             class="btn btn-primary"
                                                             href="{{url('threads','create')}}"
                                                             role="button">New</a>
                            </span>
                            @endif</h4>
                    </div>

                    <div class="card-body">


                        <ol>
                            @if (count($threads))


                                <div class="table-responsive">
                                    <table class="table table-hover table-bordered">
                                        <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th>Channel</th>

                                            @if (!request('by'))
                                                <th>Author</th>
                                            @endif


                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($threads as $thread)
                                            <tr>
                                                <td scope="row"><a href="{{ $thread->path() }}"> {{$thread->title}}</a>
                                                </td>
                                                <td>
                                                    <a href="{{$thread->channel->path()}}">{{$thread->channel['name']}}</a>
                                                </td>

                                                @if (!request('by'))
                                                    <td>
                                                        <a href="/threads?by={{$thread->owner->name}}">

                                                            @if (auth()->check() && auth()->user()->id == $thread->owner['id'])
                                                                Mine
                                                            @else
                                                                {{$thread->owner->name}}
                                                            @endif

                                                        </a>
                                                    </td>
                                                @endif


                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>






                            @else
                                <div class="alert alert-warning text-center" role="alert">
                                    <strong>No Items!</strong>
                                </div>
                        @endif
                    </div>
                    </ol>
                </div>
            </div>
        </div>
    </div>
@endsection
