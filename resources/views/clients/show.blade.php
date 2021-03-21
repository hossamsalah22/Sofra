@extends('layouts.app')
@section('page_title')
    {{ $model->name }}
@endsection
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="callout callout-info">
                        <h5><i class="fas fa-info"></i> Restaurant Status:
                            {{ $model->status }}</h5>
                    </div>
                    <div class="callout callout-info">
                        <h5><i class="fas fa-info"></i> Restaurant Activation:
                            @if($model->activated)
                            Activate
                            @else 
                            De-Activate 
                            @endif
                        </h5>
                    </div>

                    
                    <!-- Main content -->
                    <div class="invoice p-3 mb-3">
                        <!-- title row -->
                        <div class="row">
                            <div class="col-12">
                                <h4>
                                    <i class="fas fa-circle"></i> {{ $model->name }} Restaurant:
                                </h4>
                                <img src="{{ asset($model->image) }}" alt="Restaurant image" width="250">
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- info row -->
                        <div class="row invoice-info">
                            <div class="col-sm-4 invoice-col">
                                Location:
                                <address>
                                    <strong>{{ $model->neighbourhood->city->name }},
                                        {{ $model->neighbourhood->name }}</strong><br>
                                </address>
                                Categories:
                                <address>
                                    @foreach ($model->categories as $category)
                                        <strong>{{ $category->name }},</strong>
                                    @endforeach
                                </address>
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4 invoice-col">
                                Minimum Charge:
                                <address>
                                    <strong>{{ $model->min_charge }}$</strong><br>
                                </address>
                                Delivery Cost:
                                <address>
                                    <strong>{{ $model->delivery }}$</strong><br>
                                </address>
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4 invoice-col">
                                <b>Contact Info:</b><br>
                                <br>
                                <b>Email:</b> {{ $model->email }}<br>
                                <b>Phone:</b> {{ $model->phone }}<br>
                                <b>Restaurant Phone:</b> {{ $model->resturant_phone }}<br>
                                <b>Whatsapp:</b> {{ $model->whats_num }}<br>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <!-- Products Table -->
                        <div class="row">
                            <div class="col-12 table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <h4>Products Table:</h4>
                                        <tr>
                                            <th>#</th>
                                            <th>Product Name</th>
                                            <th>Ingredients</th>
                                            <th>Product Price</th>
                                            <th>Time To Make(Minute)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($model->products as $product)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $product->name }}</td>
                                                <td>{{ $product->ingredients }}</td>
                                                <td>{{ $product->price }}$</td>
                                                <td>{{ $product->time_to_make }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                        <!-- Orders Table -->
                        <div class="row">
                            <div class="col-12 table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <h4>Orders Table:</h4>
                                        @if(count($model->orders))
                                        <tr>
                                            <th>#</th>
                                            <th>Client Name</th>
                                            <th>Address</th>
                                            <th>Order Price</th>
                                            <th>Order Notes</th>
                                            <th>Order Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($model->orders as $order)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $order->client->name }}</td>
                                                <td>{{ $order->address }}</td>
                                                <td>{{ $order->total_price }}$</td>
                                                <td>{{ $order->notes }}</td>
                                                <td>{{ $order->order_state }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    @else
                                    <h1>No Orders yet, Be the first one</h1>
                                    @endif
                                </table>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <div class="row">
                            <!-- accepted payments column -->
                            <div class="col-6">
                                <p class="lead">Offers: </p>
                                @if (count($model->offers))
                                    @foreach ($model->offers as $offer)
                                        <img src="{{ asset($offer->image) }}" alt="Visa" height="50" width="50">
                                        <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                                            {{ $offer->description }}
                                        </p>
                                    @endforeach
                                @else
                                    <h4>Sorry there is no offers right now</h4>
                                @endif
                            </div>
                            <!-- /.col -->
                            <div class="col-6">
                                <p class="lead">Reviews: </p>

                                <div class="table-responsive">
                                    <table class="table">
                                        @if (count($model->reviews))
                                            @foreach ($model->reviews as $review)
                                                <tr>
                                                    <th style="width:50%">{{ $review->rate }}</th>
                                                    <td>{{ $review->content }}</td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <h4>No Reviews yet be the first one</h4>
                                        @endif
                                    </table>
                                </div>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.invoice -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
@endsection
