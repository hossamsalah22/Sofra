@extends('layouts.app')

@section('page_title')
    Edit Payment Method
@endsection
@section('content')

    <!-- Main content -->
    <section class="content">
        <div class="card-body">
            {!! Form::model($model, [
    'action' => ['App\Http\Controllers\PaymentMethodsController@update', $model->id],
    'method' => 'put',
]) !!}
            <div class="form-group">
                @include('partials.validation_error')
                @include('paymentMethods.form')

                <div class="form-group">
                    <button class="btn btn-primary" type="submit">update Payment Method</button>
                </div>

                {!! Form::close() !!}
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </section>
    <!-- /.content -->
@endsection

