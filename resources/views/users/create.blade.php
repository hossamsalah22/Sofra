@extends('layouts.app')
@inject('model', 'App\Models\User')
@section('page_title')
    Create User
@endsection
@section('content')

    <!-- Main content -->
    <section class="content">
        <div class="card-body">
            {!! Form::model($model, [
    'action' => 'App\Http\Controllers\UsersController@store',
]) !!}
            <div class="form-group">
                @include('partials.validation_error')
                @include('users.form')

                <div class="form-group">
                    <button class="btn btn-primary" type="submit">Add User</button>
                </div>

                {!! Form::close() !!}
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </section>
    <!-- /.content -->
@endsection

