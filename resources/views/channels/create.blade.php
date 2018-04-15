@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><h4>New Channel</h4></div>
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

                        {!! Form::open(['url' => 'channels']) !!}
                        {{csrf_field()}}

                        <div class="form-group">
                            <label for="title">Name</label>
                            <input required type="text" class="form-control" name="name" id="name"
                                   aria-describedby="helpId"
                                   placeholder="">

                        </div>

                        <button type="submit" class="btn btn-primary float-right">Publish
                        </button>
                        {!! Form::close() !!}

                    </div>
                </div>


            </div>
        </div>



@endsection
