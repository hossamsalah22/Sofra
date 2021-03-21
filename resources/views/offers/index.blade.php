@extends('layouts.app')
@inject('resturants', 'App\Models\Resturant')
@section('page_title')
    Offers
@endsection
@section('content')
    <div>
        {!! Form::open([
    'method' => 'get',
]) !!}
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    {!! Form::text('name', request()->input('name'), [
    'placeholder' => 'Name',
    'class' => 'form-control',
]) !!}
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    {!! Form::select('resturant_id', $resturants->pluck('name', 'id')->toArray(), request()->input('resturant_id'), [
    'class' => 'form-control',
    'placeholder' => 'Restaurant',
]) !!}
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <button class="btn btn-primary btn-block" type="submit"><i class="fa fa-search"></i></button>
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
                                <th>Restaurant</th>
                                <th class="text-center">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($model as $model)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td><a href="{{ url(route('offer.show', $model->id)) }}">{{ $model->name }}</a></td>
                                    <td>{{ $model->resturant->name }}</td>
                                    <td class="text-center">
                                        {!! Form::open([
    'action' => ['App\Http\Controllers\OffersController@destroy', $model->id],
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
