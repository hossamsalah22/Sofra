@extends('layouts.app')
@inject('model', 'App\Models\Neighbourhood')
@section('page_title')
    Create Neighbourhood
@endsection
@section('content')

    <!-- Main content -->
    <section class="content">
        <div class="card-body">
            {!! Form::model($model, [
    'action' => 'App\Http\Controllers\NeighbourhoodsController@store',
]) !!}
            <div class="form-group">
                @include('partials.validation_error')
                @include('neighbourhoods.form')

                <div class="form-group">
                    <button class="btn btn-primary" type="submit">Add Neighbourhood</button>
                </div>

                {!! Form::close() !!}
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </section>
    <!-- /.content -->
@endsection

