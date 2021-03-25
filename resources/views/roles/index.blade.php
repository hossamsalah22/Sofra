@extends('layouts.app')
@section('page_title')
  Roles    
@endsection
@section('content')

  <!-- Main content -->
  <section class="content">
      <div class="card-body">
        <a href="{{route('role.create')}}" class="btn btn-primary">
          <i class="fa fa-plus"></i>
           New Role</a>
        @include('flash::message')
          @if(count($model))
          <div class="table-responsive">
            <div class="box-body">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th style="width: 10px">#</th>
                    <th>Name</th>
                    <th>Permissions</th>
                    <th class="text-center">Edit</th>
                    <th class="text-center">Delete</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($model as $model)
                  <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$model->name}}</td>
                    <td>
                      @foreach($model->permissions as $permission)
                        ({{$permission->name}}),
                      @endforeach
                    </td>
                    <td class="text-center">
                      <a href="{{url(route('role.edit', $model->id))}}" class="btn btn-success btn-xs"><i class="fa fa-edit"></i></a>   
                    </td>
                    <td class="text-center">
                      {!! Form::open([
                        'action' => ['App\Http\Controllers\RolesController@destroy', $model->id],
                        'method' => 'delete'
                      ]) !!}
                      <button type="submit" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button>
                      {!! Form::close() !!}
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
          @else
            <div class="alert alert-danger" role="alert">
              No Data Found
            </div>
          @endif
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </section>
  <!-- /.content -->
@endsection
