<label for="name">Name</label>
{!! Form::text('name', null, [
    'class' => 'form-control',
]) !!}
<label for="password">Password</label>
{!! Form::password('password', [
    'class' => 'form-control',
]) !!}

<label for="password_confirmation">Confirm Password</label>
{!! Form::password('password_confirmation', [
    'class' => 'form-control',
]) !!}
<label for="email">E-mail</label>
{!! Form::email('email', null, [
    'class' => 'form-control',
]) !!}
{!! Form::label('Role') !!}
{!! Form::select('list_roles[]', $roles, null, ['class' => 'form-control', 'multiple' => 'multiple', 'placeholder' => 'Select Role']) !!}
</div>
