@extends('layouts.app')
@inject('model', 'App\Models\PaymentMethod')
@section('page_title')
    Create PaymentMethod
@endsection
@section('content')

    <!-- Main content -->
    <section class="content">
        <div class="card-body">
            {!! Form::model($model, [
    'action' => 'App\Http\Controllers\PaymentMethodsController@store',
]) !!}
            <div class="form-group">
                @include('partials.validation_error')
                @include('paymentMethods.form')

                <div class="form-group">
                    <button class="btn btn-primary" type="submit">Add PaymentMethod</button>
                </div>

                {!! Form::close() !!}
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </section>
    <!-- /.content -->
@endsection

