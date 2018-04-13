@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Threads


                        @if (auth()->check())
                            <span class="float-right"><a name="" id=""
                                                         class="btn btn-primary"
                                                         href="{{url('threads','create')}}"
                                                         role="button">New</a>
                            </span>
                        @endif
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

                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($threads as $thread)
                                            <tr>
                                                <td scope="row"><a href="{{ $thread->path() }}"> {{$thread->title}}</a>
                                                </td>
                                                <td>{{$thread->channel['name']}}</td>
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
