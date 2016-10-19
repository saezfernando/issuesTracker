<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
    <label  class="col-lg-2 col-sm-2 control-label">{{ trans('ui.role.name') }}<span class="obligatorio"> * </span></label>
    <div class="col-lg-8">

        {!! Form::text('name', null, ['class' => 'form-control']) !!}
        @if ($errors->has('name'))
          <span class="help-block">
            <strong>{{ $errors->first('name') }}</strong>
          </span>
        @endif
    </div>
</div>

<!--
<div class="form-group {{ $errors->has('slug') ? ' has-error' : '' }}">
    <label  class="col-lg-2 col-sm-2 control-label">{{ trans('ui.role.slug') }}</label>
    <div class="col-lg-8">

        {!! Form::text('slug', null, ['class' => 'form-control']) !!}
        @if ($errors->has('slug'))
          <span class="help-block">
            <strong>{{ $errors->first('slug') }}</strong>
          </span>
        @endif

    </div>
</div>
-->

<div class="form-group {{ $errors->has('description') ? ' has-error' : '' }}">
    <label  class="col-lg-2 col-sm-2 control-label">{{ trans('ui.role.description') }}</label>
    <div class="col-lg-8">

        {!! Form::text('description', null, ['class' => 'form-control']) !!}
        @if ($errors->has('description'))
          <span class="help-block">
            <strong>{{ $errors->first('description') }}</strong>
          </span>
        @endif

    </div>
</div>

<!--
<div class="form-group {{ $errors->has('level') ? ' has-error' : '' }}">
    <label  class="col-lg-2 col-sm-2 control-label">{{ trans('ui.role.level') }}</label>
    <div class="col-lg-8">

        {!! Form::number('level', null, ['class' => 'form-control']) !!}
        @if ($errors->has('level'))
          <span class="help-block">
            <strong>{{ $errors->first('level') }}</strong>
          </span>
        @endif

    </div>
</div>
-->

<div class="form-group">
    <label  class="col-lg-2 col-sm-2 control-label">{{ trans('ui.permission.names') }}</label>
    <div class="col-lg-10">

    {!! Form::select('permission_id[]', $permissions, isset($role_permission) ? $role_permission : null, array('multiple' => true, 'class' => 'multi-select', 'id' => 'permissionSelect')) !!}

    </div>
</div>

<div class="form-group">
    <div class="col-lg-offset-2 col-lg-8">

        {!! Form::submit($button, ['class' => 'btn btn-primary','id'=>'agregar']) !!}
        <a href="{{ url('auth/role') }}">
        {!! Form::button(trans('ui.user.button_cancelar'), ['class' => 'btn btn-warning','id' =>'cancelar']) !!}
        </a>


    </div>
</div>