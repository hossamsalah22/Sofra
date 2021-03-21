@extends('layouts.app')
@section('page_title')
    Order Details
@endsection
@section('content')
    <section class="content">
        <div class="box box-primary">
            <div class="box-body">
                <section class="invoice">
                    <!-- title row -->
                    <div class="row">
                        <div class="col-xs-12">
                            <h2 class="page-header">
                                <i class="fa fa-globe"></i>Order Details {{ $model->id }}
                                <small class="pull-left"><i class="fa fa-calendar-o"></i>{{ $model->created_at }}
                                </small>
                            </h2>
                        </div><!-- /.col -->
                    </div>
                    <!-- info row -->
                    <div class="row invoice-info">
                        <div class="col-sm-4 invoice-col">
                            Ordered By: {{ $model->client->name }}
                            <address>
                                Phone Number:{{ $model->client->phone }}
                                <br>
                                Email Address: {{ $model->client->email }}
                                <br>
                                Adress:{{ $model->client->neighbourhood->city->name }}
                            </address>
                        </div><!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                            <address>
                                <strong>Restaurant Name:{{ $model->resturant->name }} </strong>
                                <br>
                                <strong>Address: {{ $model->resturant->neighbourhood->name }}</strong>
                                <br>
                                <strong>Phone Number: {{ $model->resturant->phone }}</strong>
                            </address>
                        </div><!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                            <Strong>Order No. {{ $model->id }}</Strong>
                            </b><br>
                            <b>Order Details: {{ $model->notes }}</b><br>
                            <b> Status:
                                <i>{{ $model->order_state }}</i>
                            </b><br>
                            <b> Total Price:{{ $model->total_price }}
                            </b>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                    <!-- Table row -->
                    <div class="row">
                        <div class="col-xs-12 table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Product Name</th>
                                        <th>Qty</th>
                                        <th>Price</th>
                                        <th>Notes</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($model->products as $product)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $product->name }}</td>
                                            <td>{{ $product->pivot->quantity }}</td>
                                            <td>{{ $product->pivot->price }}</td>
                                            <td>{{ $product->pivot->notes }}</td>
                                        </tr>
                                        @endforeach
                                        <tr>
                                            <td>--</td>
                                            <td>Delivery</td>
                                            <td>-</td>
                                            <td>{{ $model->delivery }} Pound</td>
                                            <td></td>
                                        </tr>
                                        <tr class="bg-success">
                                            <td>--</td>
                                            <td>Total</td>
                                            <td>-</td>
                                            <td>
                                                {{ $model->total_price }} Pound
                                            </td>
                                            <td></td>
                                        </tr>
                                </tbody>
                            </table>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </section><!-- /.content -->
                <div class="clearfix"></div>

            </div>
        </div>


    </section>

@endsection
