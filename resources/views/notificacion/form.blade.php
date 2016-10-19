<div class="form-group {{ $errors->has('motivo') ? ' has-error' : '' }}">
    <label  class="col-lg-2 col-sm-2 control-label">{{ trans('ui.notificacion.motivo') }}</label>
    <div class="col-lg-8">

        {!! Form::text('motivo', null, ['class' => 'form-control']) !!}
         @if ($errors->has('motivo'))
          <span class="help-block">
            <strong>{{ $errors->first('motivo') }}</strong>
          </span>
        @endif

    </div>
</div>

<div class="form-group {{ $errors->has('body') ? ' has-error' : '' }}">
    <label  class="col-lg-2 col-sm-2 control-label">{{ trans('ui.notificacion.body') }}</label>
    <div class="col-lg-8">
        {!! Form::textarea('body', null, ['class' => 'form-control','rows' => '4']) !!}
        @if ($errors->has('body'))
          <span class="help-block">
            <strong>{{ $errors->first('body') }}</strong>
          </span>
        @endif
    </div>
</div>


<div class="form-group {{ $errors->has('tipo') ? ' has-error' : '' }}">
    <label  class="col-lg-2 col-sm-2 control-label">{{ trans('ui.notificacion.tipoDestinatario') }}</label>
    <span class="col-lg-8">
        {!! Form::select('notifiable_type',['User'=>'Usuario','Rol'=>'Roles','Area'=>'Areas','All'=>'Todos'], 'User',['class' => 'form-control','id'=>'notifiable_type']) !!}
        @if ($errors->has('tipo'))
          <span class="help-block">
            <strong>{{ $errors->first('tipo') }}</strong>
          </span>
        @endif
</span>
</div>


<div id="notifiable_id" class="form-group {{ $errors->has('notifiable_id') ? ' has-error' : '' }}">
    <label  class="col-lg-2 col-sm-2 control-label">{{ trans('ui.notificacion.destinatario') }}</label>
    <div class="col-lg-8">

        {!! Form::select('notifiable_id', $usuarios, null,['class' => 'form-control']) !!}
        @if ($errors->has('notifiable_id'))
          <span class="help-block">
            <strong>{{ $errors->first('notifiable_id') }}</strong>
          </span>
        @endif
    </div>
</div>


<div id="notif_area" class="form-group">
    <label  class="col-lg-2 col-sm-2 control-label">{{ trans('ui.notificacion.areas') }}</label>
    <div class="col-lg-10">

    {!! Form::select('area_id[]', $areas,null, array(
    'multiple' => true, 'class' => 'multi-select', 'id' => 'areaSelect')) !!}

    </div>
</div>


<div id="notif_rol" class="form-group">
    <label  class="col-lg-2 col-sm-2 control-label">{{ trans('ui.role.names') }}</label>
    <div class="col-lg-10">

    {!! Form::select('role_id[]', $roles,null, array(
    'multiple' => true, 'class' => 'multi-select', 'id' => 'roleSelect')) !!}

    </div>
</div>





<div class="form-group">
    <div class="col-lg-offset-2 col-lg-8">

        {!! Form::submit($button, ['class' => 'btn btn-primary','id'=>'agregar']) !!}
        <a href="{{ url('notificacion') }}">
        {!! Form::button(trans('ui.user.button_cancelar'), ['class' => 'btn btn-warning','id' =>'cancelar']) !!}
        </a>
    </div>
</div>