@extends('layouts.app')
@inject('model', 'Spatie\Permission\Models\Role')
@section('page_title')
  Create Role    
@endsection
@section('content')

  <!-- Main content -->
  <section class="content">
      <div class="card-body">
        {!! Form::model($model,[
          'action' => 'App\Http\Controllers\RolesController@store'
        ]) !!}
        <div class="form-group">
          @include('partials.validation_error')
          @include('roles.form')

          <div class="form-group">
            <button class="btn btn-primary" type="submit">Add Role</button>
          </div>
        {!! Form::close() !!}
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </section>
  <!-- /.content -->
@endsection
