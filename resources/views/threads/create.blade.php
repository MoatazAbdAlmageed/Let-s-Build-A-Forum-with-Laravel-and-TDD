@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><h4>New</h4></div>
                    <div class="card-body">

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif



                        {!! Form::open(['url' => 'threads']) !!}


                        {{csrf_field()}}

                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" name="title" id="title"
                                   aria-describedby="helpId"
                                   placeholder="">

                        </div>

                        <div class="form-group">
                            <label for="title">Channel</label>
                            {{--{{ Form::select('channel_id', $channels,null, ['class' => 'form-control']) }}--}}
                            {{--{!! Form::select('channel_id', $channels, null, ['class' => 'form-control']) !!}--}}

                            {{--{{ Form::select('channel_id', $channels, null, ['class'=>'form-control']) }}--}}

                            <select id="channel_id" name="channel_id" class="form-control">
                                @foreach ($channels as $channel)
                                    <option value="{{ $channel->id }}">{{ $channel->name }}</option>
                                @endforeach
                            </select>
                        </div>


                        <div class="form-group">
                            <label for="body">Body</label>
                            <textarea name="body" rows="5" class="form-control"
                                      placeholder="have something to share?"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary float-right">Publish
                        </button>
                        {!! Form::close() !!}

                    </div>
                </div>


            </div>
        </div>



@endsection
