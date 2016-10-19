<div class="form-group {{ $errors->has('numero') ? ' has-error' : '' }}">
    <label  class="col-lg-4 col-sm-2 control-label">{{ trans('ui.ia.numero') }}
    <span class="obligatorio"> * </span></label>
    <div class="col-lg-8">

        {!! Form::number('numero', null, ['class' => 'form-control']) !!}
        @if ($errors->has('numero'))
          <span class="help-block">
            <strong>{{ $errors->first('numero') }}</strong>
          </span>
        @endif

    </div>
</div>

<div class="form-group {{ $errors->has('tipo') ? ' has-error' : '' }}">
    <label  class="col-lg-4 col-sm-2 control-label">{{ trans('ui.ia.tipo') }}
    <span class="obligatorio"> * </span></label>
    <div class="col-lg-8">

        {!! Form::select('tipo', $tipos ,null, ['class' => 'form-control']) !!}
        @if ($errors->has('tipo'))
          <span class="help-block">
            <strong>{{ $errors->first('tipo') }}</strong>
          </span>
        @endif

    </div>
</div>

<div class="form-group {{ $errors->has('fecha') ? ' has-error' : '' }}">
    <label  class="col-lg-4 col-sm-2 control-label">{{ trans('ui.ia.fecha') }}
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


<div class="form-group {{ $errors->has('auditorLider') ? ' has-error' : '' }}">
    <label  class="col-lg-4 col-sm-2 control-label">{{ trans('ui.ia.auditorLider') }}
    <span class="obligatorio"> * </span></label>
    <div class="col-lg-8">

        {!! Form::select('auditorLider', $auditores ,null, ['class' => 'form-control']) !!}
        @if ($errors->has('auditorLider'))
          <span class="help-block">
            <strong>{{ $errors->first('auditorLider') }}</strong>
          </span>
        @endif

    </div>
</div>

<div class="form-group {{ $errors->has('auditorEquipo') ? ' has-error' : '' }}">
    <label  class="col-lg-4 col-sm-2 control-label">{{ trans('ui.ia.auditorEquipo') }}
    <span class="obligatorio"> * </span></label>
    <div class="col-lg-8">

        {!! Form::select('auditorEquipo[]', $auditores , isset($informeAuditoriaAuditores) ? $informeAuditoriaAuditores : null, array('multiple' => true, 'class' => 'multi-select', 'id' => 'auditorEquipoSelect')) !!}
        @if ($errors->has('auditorEquipo'))
          <span class="help-block">
            <strong>{{ $errors->first('auditorEquipo') }}</strong>
          </span>
        @endif

    </div>
</div>

<div class="form-group {{ $errors->has('nivelAuditado') ? ' has-error' : '' }}">
    <label  class="col-lg-4 col-sm-2 control-label">{{ trans('ui.ia.nivelesAuditados') }}
    <span class="obligatorio"> * </span></label>
    <div class="col-lg-8">

        {!! Form::select('nivelAuditado', $niveles ,null, ['class' => 'form-control']) !!}
        @if ($errors->has('nivelAuditado'))
          <span class="help-block">
            <strong>{{ $errors->first('nivelAuditado') }}</strong>
          </span>
        @endif

    </div>
</div>



<div class="form-group {{ $errors->has('procedimientos') ? ' has-error' : '' }}">
    <label  class="col-lg-4 col-sm-2 control-label">{{ trans('ui.ia.procedimientos') }}
    <span class="obligatorio"> * </span></label>
    <div class="col-lg-8">

        {!! Form::select('procedimientos[]', $procedimientos ,isset($informeAuditoriaProcedimientos) ? $informeAuditoriaProcedimientos : null, array(
    'multiple' => true, 'class' => 'multi-select', 'id' => 'procedimientoSelect')) !!}
        @if ($errors->has('procedimientos'))
          <span class="help-block">
            <strong>{{ $errors->first('procedimientos') }}</strong>
          </span>
        @endif

    </div>
</div>


<div class="form-group {{ $errors->has('doc') ? ' has-error' : '' }}">
    <label  class="col-lg-4 col-sm-2 control-label">{{ trans('ui.nc.doc') }}</label>
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
