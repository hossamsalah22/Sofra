@extends('layouts.app')
@inject('model', 'App\Models\Commission')
@section('page_title')
    Create Payment
@endsection
@section('content')

    <!-- Main content -->
    <section class="content">
        <div class="card-body">
            {!! Form::model($model, [
    'action' => 'App\Http\Controllers\ResturantPaymentsController@store',
]) !!}
            <div class="form-group">
                @include('partials.validation_error')
                @include('resturantPayments.form')

                <div class="form-group">
                    <button class="btn btn-primary" type="submit">Add Payments</button>
                </div>

                {!! Form::close() !!}
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </section>
    <!-- /.content -->
@endsection

