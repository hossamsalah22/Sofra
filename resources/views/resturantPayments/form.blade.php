<label for="paid">Paid</label>
{!! Form::text('paid', null, [
    'class' => 'form-control',
]) !!}
<label for="payment_date">Payment Date</label>
{!! Form::date('payment_date', null, [
    'class' => 'form-control',
]) !!}
@inject('resturants', 'App\Models\Resturant')
<label for="payment_date">Restaurant</label>
{!! Form::select('resturant_id', $resturants->pluck('name', 'id')->toArray(), request()->input('resturant_id'), [
    'placeholder' => 'Resturant',
    'class' => 'form-control',
]) !!}
<label for="notes">Notes</label>
{!! Form::text('notes', null, [
    'class' => 'form-control',
]) !!}

</div>
