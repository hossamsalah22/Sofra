@extends('layouts.app')
@inject('city', 'App\Models\City')
@inject('neighbourhoods', 'App\Models\Neighbourhood')
@section('page_title')
    Clients
@endsection
@section('content')
    <div>
        {!! Form::open([
    'method' => 'get',
    'id' => 'search'
]) !!}
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    {!! Form::select('city_id', $city->pluck('name', 'id')->toArray(), null, [
    'class' => 'form-control',
    'placeholder' => 'City',
    'id' => 'cities',
]) !!}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    {!! Form::select('neighbourhood_id', [], request()->input('neighbourhood_id'), [
    'placeholder' => 'Neighbourhood',
    'class' => 'form-control',
    'id' => 'neighbourhoods',
]) !!}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    {!! Form::text('name', request()->input('name'), [
    'class' => 'form-control',
    'placeholder' => 'Name',
]) !!}
                </div>
            </div>
            <div class="col-md-1">
                <div class="form-group">
                    <button class="btn btn-primary btn-block" type="submit"><i class="fa fa-search"></i></button>
                </div>
            </div>
            <div class="col-md-1">
                <div class="form-group">
                    <button class="btn btn-danger btn-block" type="submit"><a href="{{url(route('client.index'))}}" style="color: white">Reset</a></button>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
    <div class="card-body">
        @include('flash::message')
        @if (count($model))
            <div class="table-responsive">
                <div class="box-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>Name</th>
                                <th>E-mail</th>
                                <th>Phone</th>
                                <th>Image</th>
                                <th>Address</th>
                                @if(auth()->user()->hasRole('admin'))
                                <th>Activation</th>
                                @endif
                                <th class="text-center">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($model as $model)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $model->name }}</td>
                                    <td>{{ $model->email }}</td>
                                    <td>{{ $model->phone }}</td>
                                    <td><img src="{{asset($model->image)}}" alt="{{$model->name}} image" width="50"></td>
                                    <td>{{$model->neighbourhood->city->name}}, {{$model->neighbourhood->name}}</td>
                                    @if(auth()->user()->hasRole('admin'))
                                    <td class="text-center">
                                        @if($model->activated)
                                            <a href="client/{{$model->id}}/de-activate" class="btn btn-xs btn-danger"><i class="fa fa-close"></i> De-Activate</a>
                                        @else
                                            <a href="client/{{$model->id}}/activate" class="btn btn-xs btn-success"><i class="fa fa-check"></i> Activate</a>
                                        @endif
                                  </td>
                                  @endif
                                    <td class="text-center">
                                        {!! Form::open([
    'action' => ['App\Http\Controllers\ClientsController@destroy', $model->id],
    'method' => 'delete',
]) !!}
                                        <button type="submit" class="btn btn-danger btn-xs"><i
                                                class="fa fa-trash"></i></button>
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
    </div>
    @push('scripts')
        <script>
            $("#cities").change(function(e) {
                e.preventDefault();
                var city_id = $("#cities").val();
                if (city_id) {
                    $.ajax({
                        url: '{{ url('api/v1/neighbourhoods?city_id=') }}' + city_id,
                        type: 'get',
                        success: function(data) {
                            if (data.status == 1) {
                                $("#neighbourhoods").empty();
                                $("#neighbourhoods").append('<option value="">Neighbourhood</option>');
                                $.each(data.data, function(index, neighbourhood) {
                                    $("#neighbourhoods").append('<option value="' + neighbourhood
                                        .id + '">' + neighbourhood.name + '</option>');
                                });
                            }
                        },
                        error: function(jqXhr, textStatus, errorMessage) {
                            alert(errorMessage);
                        }
                    });
                } else {
                    $("#neighbourhoods").empty();
                    $("#neighbourhoods").append('<option value="">Neighbourhood</option>');
                }
            });

        </script>
    @endpush
@endsection
