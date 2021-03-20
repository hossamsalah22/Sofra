@extends('layouts.app')
@section('page_title')
    Contacts
@endsection
@section('content')
    <div class="card-body">
        @include('flash::message')
        <div class="table-responsive">
            <div class="box-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>About Us</th>
                            <th>Content</th>
                            <th>Text</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Commission</th>
                            <th>Maximum</th>
                            <th class="text-center">Edit</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $model->id }}</td>
                            <td>{{ $model->about_us }}</td>
                            <td>{{ $model->content }}</td>
                            <td>{{ $model->text }}</td>
                            <td>{{ $model->phone }}</td>
                            <td>{{ $model->email }}</td>
                            <td>{{ $model->commission }}</td>
                            <td>{{ $model->maximum }}</td>
                            <td class="text-center">
                                <a href="{{ url(route('setting.edit', $model->id)) }}"
                                    class="btn btn-success btn-xs"><i class="fa fa-edit"></i></a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>
@endsection
