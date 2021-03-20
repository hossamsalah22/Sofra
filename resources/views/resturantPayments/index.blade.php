@extends('layouts.app')
@inject('resturants', 'App\Models\Resturant')
@section('page_title')
    Restaurants Payments
@endsection
@section('content')
    <div>
        {!! Form::open([
    'method' => 'get',
]) !!}
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    {!! Form::select('resturant_id', $resturants->pluck('name', 'id')->toArray(), request()->input('resturant_id'), [
    'placeholder' => 'Resturant',
    'class' => 'form-control',
]) !!}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    {!! Form::text('payment_date', request()->input('payment_date'), [
    'placeholder' => 'Payment Date',
    'class' => 'form-control',
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
        <a href="{{ route('resturants-payments.create') }}" class="btn btn-primary">
            <i class="fa fa-plus"></i>
            New Payment</a>
        @include('flash::message')
        @if (count($model))
            <div class="table-responsive">
                <div class="box-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>Resturant</th>
                                <th>Paid</th>
                                <th>Payment Date</th>
                                <th>Notes</th>
                                <th class="text-center">Edit</th>
                                <th class="text-center">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($model as $model)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $model->resturant->name }}</td>
                                    <td>{{ $model->paid }}</td>
                                    <td>{{ $model->payment_date }}</td>
                                    <td>{{ $model->notes }}</td>
                                    <td class="text-center">
                                        <a href="{{ url(route('resturants-payments.edit', $model->id)) }}"
                                            class="btn btn-success btn-xs"><i class="fa fa-edit"></i></a>
                                    </td>
                                    <td class="text-center">
                                        {!! Form::open([
    'action' => ['App\Http\Controllers\ResturantPaymentsController@destroy', $model->id],
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
