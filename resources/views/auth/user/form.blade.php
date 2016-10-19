<div class="form-group {{ $errors->has('nombre') ? ' has-error' : '' }}">
    <label  class="col-lg-2 col-sm-2 control-label">{{ trans('ui.user.nombre') }}<span class="obligatorio"> * </span></label>
    <div class="col-lg-8">

        {!! Form::text('nombre', null, ['class' => 'form-control']) !!}
         @if ($errors->has('nombre'))
          <span class="help-block">
            <strong>{{ $errors->first('nombre') }}</strong>
          </span>
        @endif

    </div>
</div>


<div class="form-group {{ $errors->has('apellido') ? ' has-error' : '' }}">
    <label  class="col-lg-2 col-sm-2 control-label">{{ trans('ui.user.apellido') }}<span class="obligatorio"> * </span></label>
    <div class="col-lg-8">

        {!! Form::text('apellido', null, ['class' => 'form-control']) !!}
        @if ($errors->has('apellido'))
          <span class="help-block">
            <strong>{{ $errors->first('apellido') }}</strong>
          </span>
        @endif
    </div>
</div>

<div class="form-group {{ $errors->has('dni') ? ' has-error' : '' }}">
    <label  class="col-lg-2 col-sm-2 control-label">{{ trans('ui.user.dni') }}<span class="obligatorio"> * </span></label>
    <div class="col-lg-8">

        {!! Form::text('dni', null, ['class' => 'form-control']) !!}
        @if ($errors->has('dni'))
          <span class="help-block">
            <strong>{{ $errors->first('dni') }}</strong>
          </span>
        @endif
    </div>
</div>

<div class="form-group {{ $errors->has('telefono') ? ' has-error' : '' }}">
    <label  class="col-lg-2 col-sm-2 control-label">{{ trans('ui.user.telefono') }}</label>
    <div class="col-lg-8">

        {!! Form::text('telefono', null, ['class' => 'form-control']) !!}
        @if ($errors->has('telefono'))
          <span class="help-block">
            <strong>{{ $errors->first('telefono') }}</strong>
          </span>
        @endif

    </div>
</div>


<div class="form-group {{ $errors->has('area') ? ' has-error' : '' }}">
    <label  class="col-lg-2 col-sm-2 control-label">{{ trans('ui.user.area') }}<span class="obligatorio"> * </span></label>
    <div class="col-lg-8">

        {!! Form::select('area', $areas ,null, ['class' => 'form-control']) !!}
        @if ($errors->has('area'))
          <span class="help-block">
            <strong>{{ $errors->first('area') }}</strong>
          </span>
        @endif

    </div>
</div>

<div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
    <label  class="col-lg-2 col-sm-2 control-label">{{ trans('ui.user.email') }}<span class="obligatorio"> * </span></label>
    <div class="col-lg-8">

        {!! Form::text('email', null, ['class' => 'form-control']) !!}
        @if ($errors->has('email'))
          <span class="help-block">
            <strong>{{ $errors->first('email') }}</strong>
          </span>
        @endif

    </div>
</div>

@if ($create)
<div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
    <label  class="col-lg-2 col-sm-2 control-label">{{ trans('ui.user.password') }}<span class="obligatorio"> * </span></label>
    <div class="col-lg-8">

        {!! Form::password('password', ['class' => 'form-control','id'=>'password']) !!}
        @if ($errors->has('password'))
          <span class="help-block">
            <strong>{{ $errors->first('password') }}</strong>
          </span>
        @endif

    </div>
</div>

<div class="form-group {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
    <label class="col-lg-2 col-sm-2 control-label">{{ trans('ui.user.password_confirmation') }}<span class="obligatorio"> * </span></label>
    <div class="col-lg-8">

        {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
        @if ($errors->has('password_confirmation'))
          <span class="help-block">
            <strong>{{ $errors->first('password_confirmation') }}</strong>
          </span>
        @endif

    </div>
</div>
@endif <!-- fin de si es create-->

<div class="form-group">
    <label  class="col-lg-2 col-sm-2 control-label">{{ trans('ui.role.names') }}</label>
    <div class="col-lg-10">

    {!! Form::select('role_id[]', $roles, isset($roles_user) ? $roles_user : null, array(
    'multiple' => true, 'class' => 'multi-select', 'id' => 'roleSelect')) !!}

    </div>
</div>

<div class="form-group">
    <div class="col-lg-offset-2 col-lg-8">

        {!! Form::submit($button, ['class' => 'btn btn-primary','id' =>'agregar']) !!}
        
        <a href="{{ url('auth/user') }}">
        {!! Form::button(trans('ui.user.button_cancelar'), ['class' => 'btn btn-warning','id' =>'cancelar']) !!}
        </a>

    </div>
</div>
