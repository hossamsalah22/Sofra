@extends('layouts.app')
@inject('model', 'App\Models\User')
@section('page_title')
    Change Password
@endsection
@section('content')

    <!-- Main content -->
    <section class="content">
        <div class="card-body">
            @include('flash::message')
            {!! Form::model($model, [
    'action' => 'App\Http\Controllers\ChangePasswordController@store',
]) !!}
            <div class="form-group">
                @include('partials.validation_error')
                @include('change_password.form')

                <div class="form-group">
                    <button class="btn btn-primary" type="submit">Change Password</button>
                </div>

                {!! Form::close() !!}
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </section>
    <!-- /.content -->
@endsection

