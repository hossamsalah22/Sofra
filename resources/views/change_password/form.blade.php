
<label for="old_password">old password</label>
{!! Form::password('old_password', [
    'class' => 'form-control',
]) !!}

<label for="new_password">new password</label>
{!! Form::password('new_password', [
    'class' => 'form-control',
]) !!}

<label for="new_password_confirmation">Confirm new password</label>
{!! Form::password('new_password_confirmation', [
    'class' => 'form-control',
]) !!}
</div>
