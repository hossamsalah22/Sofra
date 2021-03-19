<label for="name">Name</label>
{!! Form::text('name', null, [
    'class' => 'form-control',
]) !!}

{{-- <label for="governorate">Select Governorate</label> --}}
@inject('city', 'App\Models\City')
{{ Form::label('city') }}
{{ Form::select('city_id', $city->pluck('name', 'id'), null, ['class' => 'form-control', 'placeholder' => 'Please select ...']) }}


</div>
