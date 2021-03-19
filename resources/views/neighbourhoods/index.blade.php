@extends('layouts.app')
@section('page_title')
    Neighbourhoods
@endsection
@section('content')
    <div class="card-body">
        <a href="{{ route('neighbourhood.create') }}" class="btn btn-primary">
            <i class="fa fa-plus"></i>
            New Neighbourhood</a>
        @include('flash::message')
        @if (count($model))
            <div class="table-responsive">
                <div class="box-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>Name</th>
                                <th>City</th>
                                <th class="text-center">Edit</th>
                                <th class="text-center">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($model as $model)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td><a href="{{ url(route('neighbourhood.show', $model->id)) }}">{{ $model->name }}</a></td>
                                    <td><a href="{{url(route('city.show', $model->city->id))}}">{{$model->city->name}}</a></td>
                                    <td class="text-center">
                                        <a href="{{ url(route('neighbourhood.edit', $model->id)) }}"
                                            class="btn btn-success btn-xs"><i class="fa fa-edit"></i></a>
                                    </td>
                                    <td class="text-center">
                                        {!! Form::open([
    'action' => ['App\Http\Controllers\NeighbourhoodsController@destroy', $model->id],
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
@endsection
