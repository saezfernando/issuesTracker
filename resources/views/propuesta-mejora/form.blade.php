<div class="form-group {{ $errors->has('propuestaImplementar') ? ' has-error' : '' }}">
    <label  class="col-lg-2 col-sm-2 control-label">{{ trans('ui.pm.propuestaImplementar') }}<span class="obligatorio"> * </span></label>
    <div class="col-lg-8">

        {!! Form::textarea('propuestaImplementar', null, ['class' => 'form-control','rows' => '4']) !!}
        @if ($errors->has('propuestaImplementar'))
          <span class="help-block">
            <strong>{{ $errors->first('propuestaImplementar') }}</strong>
          </span>
        @endif
    </div>
</div>

<div class="form-group {{ $errors->has('procedimientos') ? ' has-error' : '' }}">
    <label  class="col-lg-2 col-sm-2 control-label">{{ trans('ui.pm.procedimientos') }}
    <span class="obligatorio"> * </span></label>
    <div class="col-lg-8">

        {!! Form::select('procedimientos[]', $procedimientos ,isset($propuestaMejoraProcedimientos) ? $propuestaMejoraProcedimientos : null, array(
    'multiple' => true, 'class' => 'multi-select', 'id' => 'procedimientoSelect')) !!}
        @if ($errors->has('procedimientos'))
          <span class="help-block">
            <strong>{{ $errors->first('procedimientos') }}</strong>
          </span>
        @endif

    </div>
</div>


<div class="form-group {{ $errors->has('recursosNecesarios') ? ' has-error' : '' }}">
    <label  class="col-lg-2 col-sm-2 control-label">{{ trans('ui.pm.recursosNecesarios') }}
    <span class="obligatorio"> * </span></label>
    <div class="col-lg-8">

        {!! Form::textarea('recursosNecesarios', null, ['class' => 'form-control','rows' => '4']) !!}
        @if ($errors->has('recursosNecesarios'))
          <span class="help-block">
            <strong>{{ $errors->first('recursosNecesarios') }}</strong>
          </span>
        @endif
    </div>
</div>


<div class="form-group {{ $errors->has('fecha') ? ' has-error' : '' }}">
    <label  class="col-lg-2 col-sm-2 control-label">{{ trans('ui.pm.fecha') }}
    <span class="obligatorio"> * </span></label>
    <div class="col-lg-8">

        {!! Form::date('fecha',  \Carbon\Carbon::now(), ['class' => 'form-control']) !!}
        @if ($errors->has('fecha'))
          <span class="help-block">
            <strong>{{ $errors->first('fecha') }}</strong>
          </span>
        @endif
    </div>
</div>

<div class="form-group {{ $errors->has('accionRealizada') ? ' has-error' : '' }}">
    <label  class="col-lg-2 col-sm-2 control-label">{{ trans('ui.pm.accionRealizada') }}
    <span class="obligatorio"> * </span></label>
    <div class="col-lg-8">

        {!! Form::textarea('accionRealizada', null, ['class' => 'form-control','rows' => '4']) !!}
        @if ($errors->has('accionRealizada'))
          <span class="help-block">
            <strong>{{ $errors->first('accionRealizada') }}</strong>
          </span>
        @endif
    </div>
</div>

<div class="form-group {{ $errors->has('fechaImplementacionEstimada') ? ' has-error' : '' }}">
    <label  class="col-lg-2 col-sm-2 control-label">{{ trans('ui.pm.fechaImplementacionEstimada') }}
    </label>
    <div class="col-lg-8">

        {!! Form::date('fechaImplementacionEstimada',  \Carbon\Carbon::now(), ['class' => 'form-control']) !!}
        @if ($errors->has('fechaImplementacionEstimada'))
          <span class="help-block">
            <strong>{{ $errors->first('fechaImplementacionEstimada') }}</strong>
          </span>
        @endif
    </div>
</div>

<div class="form-group {{ $errors->has('estado') ? ' has-error' : '' }}">
    <label  class="col-lg-2 col-sm-2 control-label">{{ trans('ui.pm.estado') }}
    <span class="obligatorio"> * </span></label>
    <div class="col-lg-8">

        {!! Form::select('estado', $estados ,null, ['class' => 'form-control']) !!}
        @if ($errors->has('estado'))
          <span class="help-block">
            <strong>{{ $errors->first('estado') }}</strong>
          </span>
        @endif

    </div>
</div>


<div class="form-group {{ $errors->has('doc') ? ' has-error' : '' }}">
    <label  class="col-lg-2 col-sm-2 control-label">{{ trans('ui.nc.doc') }}</label>
    <div class="col-lg-8">

 @if (!empty($nc))
  @if (!empty($nc->nombre_archivo_original)) 
    <a href="{{url('no-conformidad/file') . '/' . $nc->id }}">
    <i class="fa fa-file"></i>
  {{ $nc->nombre_archivo_original }} @else {{ trans('ui.nc.sinadjunto') }} @endif
</a>
 @endif

        {!! Form::file('doc', null, ['class' => 'form-control']) !!}

        @if ($errors->has('doc'))
          <span class="help-block">
            <strong>{{ $errors->first('doc') }}</strong>
          </span>
        @endif

    </div>
</div>


<div class="form-group">
    <div class="col-lg-offset-2 col-lg-8">

        {!! Form::submit($button, ['class' => 'btn btn-primary','id'=>'agregar']) !!}
        <a href="{{ url('informe-auditoria') }}">
        {!! Form::button(trans('ui.user.button_cancelar'), ['class' => 'btn btn-warning','id' =>'cancelar']) !!}
        </a>
    </div>
</div>
