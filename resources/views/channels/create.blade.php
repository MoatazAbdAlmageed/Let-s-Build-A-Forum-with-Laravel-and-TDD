@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><h4>New Channel</h4></div>
                    <div class="card-body">


                        {!! Form::open(['url' => 'threads']) !!}


                        {{csrf_field()}}

                        <div class="form-group">
                            <label for="title">Name</label>
                            <input type="text" class="form-control" name="name" id="name"
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
