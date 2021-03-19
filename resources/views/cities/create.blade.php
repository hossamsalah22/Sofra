@extends('layouts.app')
@inject('model', 'App\Models\City')
@section('page_title')
    Create City
@endsection
@section('content')

    <!-- Main content -->
    <section class="content">
        <div class="card-body">
            {!! Form::model($model, [
    'action' => 'App\Http\Controllers\CitiesController@store',
]) !!}
            <div class="form-group">
                @include('partials.validation_error')
                @include('cities.form')

                <div class="form-group">
                    <button class="btn btn-primary" type="submit">Add City</button>
                </div>

                {!! Form::close() !!}
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </section>
    <!-- /.content -->
@endsection
