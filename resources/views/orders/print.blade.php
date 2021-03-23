<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sofra Admin DashBoard</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('Admin/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('Admin/dist/css/adminlte.min.css') }}">
</head>
<body onload="window.print();">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="callout callout-info">
                        <h5><i class="fas fa-info"></i> Order Status:
                            {{ $model->order_state }}</h5><br>
                    </div>
                    <!-- Main content -->
                    <div class="invoice p-3 mb-3">
                        <!-- title row -->
                        <div class="row">
                            <div class="col-12">
                                <h4>
                                    <i class="fas fa-circle"></i> Order Details:
                                </h4>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- info row -->
                        <div class="row invoice-info">
                            <div class="col-sm-4 invoice-col">
                                <strong> Ordered By: </strong>{{ $model->client->name }}
                                <address><strong>
                                        Phone Number:</strong>
                                    {{ $model->client->phone }}
                                    <br><strong>
                                        Email Address:</strong> {{ $model->client->email }}
                                    <br><strong>
                                        Address:</strong>
                                    {{ $model->client->neighbourhood->city->name }},
                                    {{ $model->client->neighbourhood->name }}
                                </address>
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4 invoice-col">
                                <Strong>Order No. {{ $model->id }}</Strong>
                                </b><br>
                                <b> Total Price:{{ $model->total_price }}
                                </b>
                                <address><strong>
                                        Restaurant Name:</strong>
                                    {{ $model->resturant->name }}
                                    <br><strong>
                                        Address: </strong>
                                    {{ $model->resturant->neighbourhood->city->name }},
                                    {{ $model->resturant->neighbourhood->name }}
                                    <br><strong>
                                        Phone Number: </strong>
                                    {{ $model->resturant->phone }}
                                </address>
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4 invoice-col">
                                <b>Contact Info:</b><br>
                                <b>Email:</b> {{ $model->resturant->email }}<br>
                                <b>Phone:</b> {{ $model->resturant->phone }}<br>
                                <b>Restaurant Phone:</b> {{ $model->resturant->resturant_phone }}<br>
                                <b>Whatsapp:</b> {{ $model->resturant->whats_num }}<br>
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
                                            <td>Delivery Cost</td>
                                            <td>-</td>
                                            <td>{{ $model->delivery }}$</td>
                                            <td></td>
                                        </tr>
                                        <tr class="bg-success">
                                            <td>--</td>
                                            <td>Total</td>
                                            <td>-</td>
                                            <td>
                                                {{ $model->total_price }}$
                                            </td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.col -->
                        </div>
                        <div class="col-xs-12">
                            <a href="{{ $model->id }}/print" target="_blank" class="btn btn-default"><i
                                    class="fa fa-print"></i>
                                Print</a>
                            </button>                        
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.invoice -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
</body>
