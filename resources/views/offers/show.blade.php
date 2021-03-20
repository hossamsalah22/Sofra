@extends('layouts.app')
@section('page_title')
{{$model->name}}
@endsection
@section('content')
<section class="content">

    <!-- Default box -->
    <div class="card card-solid">
      <div class="card-body">
        <div class="row">
          <div class="col-12 col-sm-6">
            <h3 class="d-inline-block d-sm-none"></h3>
            <div class="col-12">
              <img src="{{asset($model->image)}}" class="product-image" alt="Product Image">
            </div>
            <div class="col-12 product-image-thumbs">
              <div class="product-image-thumb active"><img src="{{asset($model->image)}}" alt="Product Image"></div>
              <div class="product-image-thumb active"><img src="{{asset($model->resturant->image)}}" alt="Product Image"></div>
            </div>
          </div>
        </div>
        <div class="row mt-4">
          <nav class="w-100">
            <div class="nav nav-tabs" id="product-tab" role="tablist">
              <a class="nav-item nav-link active" id="product-desc-tab" data-toggle="tab" href="#product-desc" role="tab" aria-controls="product-desc" aria-selected="true">Description</a>
              <a class="nav-item nav-link" id="product-details-tab" data-toggle="tab" href="#product-details" role="tab" aria-controls="product-details" aria-selected="false">Details</a>
            </div>
          </nav>
          <div class="tab-content p-3" id="nav-tabContent">
            <div class="tab-pane fade show active" id="product-desc" role="tabpanel" aria-labelledby="product-desc-tab"> {{$model->description}} </div>
            <div class="tab-pane fade" id="product-details" role="tabpanel" aria-labelledby="product-details-tab">
                {!! Form::label('name', 'Offer Name: '.$model->name) !!} <br>
                {!! Form::label('start_at', 'Offer Starts At: '.$model->start_at) !!} <br>
                {!! Form::label('end_at', 'Offer Ends At: '.$model->end_at) !!} <br>
                {!! Form::label('resturant_id', 'Restaurant: '.$model->resturant->name) !!} <br>
            </div>
          </div>
        </div>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->

  </section>
@endsection