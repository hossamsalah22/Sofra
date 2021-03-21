@extends('layouts.app')
@inject('resturant', 'App\Models\Resturant')
@section('page_title')
    Orders
@endsection
@section('content')
    <div>
        {!! Form::open([
    'method' => 'get',
    'id' => 'search',
]) !!}
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    {!! Form::select('resturant_id', $resturant->pluck('name', 'id')->toArray(), request()->input('resturant_id'), [
    'class' => 'form-control',
    'placeholder' => 'Resturant',
]) !!}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    {!! Form::text('id', request()->input('id'), [
    'class' => 'form-control',
    'placeholder' => 'Order Id',
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
                    <button class="btn btn-danger btn-block" type="submit"><a href="{{ url(route('restaurant.index')) }}"
                            style="color: white">Reset</a></button>
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
                                <th>Order No.</th>
                                <th>Restaurant</th>
                                <th>Total Price</th>
                                <th>State</th>
                                <th>Notes</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($model as $model)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td><a href="{{url(route('order.show', $model->id))}}">{{$model->id}}</a></td>
                                    <td>{{$model->resturant->name}}</td>
                                    <td>{{$model->total_price}}</td>
                                    <td>{{$model->order_state}}</td>
                                    <td>{{$model->notes}}</td>
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
