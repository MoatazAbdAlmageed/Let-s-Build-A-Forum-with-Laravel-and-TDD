@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header yellow">Channels


                        @if (auth()->check())
                            <span class="float-right"><a name="" id=""
                                                         class="btn btn-primary"
                                                         href="{{url('channels','create')}}"
                                                         role="button">New</a>
                            </span>
                        @endif
                    </div>

                    <div class="card-body">


                        <ol>
                            @if (count($channels))


                                <div class="table-responsive">
                                    <table class="table table-hover table-bordered">
                                        <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Slud</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($channels as $channel)
                                            <tr>
                                                <td scope="row"><a
                                                            href="{{ $channel->path() }}"> {{$channel->name}}</a>
                                                </td>
                                                <td>{{$channel->slug}}</td>
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
