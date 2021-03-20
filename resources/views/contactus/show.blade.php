@extends('layouts.app')
@section('page_title')
{{$model->name}}
@endsection
@section('content')
<section class="content">

    <!-- Default box -->
    <div class="card card-solid">
      <div class="card-body">
        <div class="row mt-4">
          <nav class="w-100">
            <div class="nav nav-tabs" id="product-tab" role="tablist">
              <a class="nav-item nav-link active" id="product-desc-tab" data-toggle="tab" href="#product-desc" role="tab" aria-controls="product-desc" aria-selected="true">Message Details</a>
              <a class="nav-item nav-link" id="product-details-tab" data-toggle="tab" href="#product-details" role="tab" aria-controls="product-details" aria-selected="false">Contact Details</a>
            </div>
          </nav>
          <div class="tab-content p-3" id="nav-tabContent">
            <div class="tab-pane fade show active" id="product-desc" role="tabpanel" aria-labelledby="product-desc-tab"> {{$model->message}} </div>
            <div class="tab-pane fade" id="product-details" role="tabpanel" aria-labelledby="product-details-tab">
                {!! Form::label('name', 'Name: '.$model->name) !!} <br>
                {!! Form::label('email', 'Email: '.$model->email) !!} <br>
                {!! Form::label('phone', 'Phone: '.$model->phone) !!} <br>
                {!! Form::label('type', 'Message Type: '.$model->type) !!} <br>
            </div>
          </div>
        </div>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->

  </section>
@endsection