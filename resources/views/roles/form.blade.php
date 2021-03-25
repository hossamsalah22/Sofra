@inject('per', 'Spatie\Permission\Models\Permission')

<label for="name">Name</label>
    {!! Form::text('name',Null,[
    'class' => 'form-control'
    ]) !!}
<br>
<label for="permissions">Permissions</label><br>
<input id="auth" type="checkbox"><label for='selectAll'>Select All</label>
    <div class="row">
        @foreach ($per->all() as $permission)
            <div class="col-sm-3">
                <div class="checkbox">
                    <label>
                        <input value="{{$permission->id}}" type="checkbox" name="permissions[]"
                            @if($model->hasPermissionTo($permission->name))
                                checked
                            @endif
                        > 
                        {{$permission->name}}
                    </label>
                </div>
            </div>
        @endforeach
    </div>
    @push('roles')
        <script>
            $("#selectAll").click(function() {
            $("input[type=checkbox]").prop("checked", $(this).prop("checked"));
            });
        </script>
    @endpush
</div>


    