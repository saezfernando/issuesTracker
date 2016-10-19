<div class="form-group {{ $errors->has('procedimiento') ? ' has-error' : '' }}">
    <label  class="col-lg-4 col-sm-2 control-label">{{ trans('ui.nc.procedimiento') }}
    <span class="obligatorio"> * </span></label>
    <div class="col-lg-8">

        {!! Form::select('procedimiento', $procedimientos ,null, ['class' => 'form-control']) !!}
        @if ($errors->has('procedimiento'))
          <span class="help-block">
            <strong>{{ $errors->first('procedimiento') }}</strong>
          </span>
        @endif

    </div>
</div>


<div class="form-group {{ $errors->has('categoria') ? ' has-error' : '' }}">
    <label  class="col-lg-4 col-sm-2 control-label">{{ trans('ui.nc.categoria') }}
    <span class="obligatorio"> * </span></label>
    <div class="col-lg-8">

        {!! Form::select('categoria', $categorias ,null, ['class' => 'form-control']) !!}
        @if ($errors->has('categoria'))
          <span class="help-block">
            <strong>{{ $errors->first('categoria') }}</strong>
          </span>
        @endif

    </div>
</div>


<div class="form-group {{ $errors->has('requisitoIncumple') ? ' has-error' : '' }}">
    <label  class="col-lg-4 col-sm-2 control-label">{{ trans('ui.nc.requisitoIncumple') }}
    <span class="obligatorio"> * </span></label>
    <div class="col-lg-8">

        {!! Form::select('requisitoIncumple', $requisitos ,null, ['class' => 'form-control']) !!}
        @if ($errors->has('requisitoIncumple'))
          <span class="help-block">
            <strong>{{ $errors->first('requisitoIncumple') }}</strong>
          </span>
        @endif

    </div>
</div>

<div class="form-group {{ $errors->has('descripcion') ? ' has-error' : '' }}">
    <label  class="col-lg-4 col-sm-2 control-label">{{ trans('ui.nc.descripcion') }}
    <span class="obligatorio"> * </span></label>
    <div class="col-lg-8">

        {!! Form::textarea('descripcion', null, ['class' => 'form-control','rows' => '4']) !!}
        @if ($errors->has('descripcion'))
          <span class="help-block">
            <strong>{{ $errors->first('descripcion') }}</strong>
          </span>
        @endif
    </div>
</div>

<div class="form-group {{ $errors->has('origen') ? ' has-error' : '' }}">
    <label  class="col-lg-4 col-sm-2 control-label">{{ trans('ui.nc.origen') }}
    <span class="obligatorio"> * </span></label>
    <div class="col-lg-8">

        {!! Form::select('origen', $origenes ,null, ['class' => 'form-control','id'=>'origen']) !!}
        @if ($errors->has('origen'))
          <span class="help-block">
            <strong>{{ $errors->first('origen') }}</strong>
          </span>
        @endif

    </div>
</div>


<div class="form-group {{ $errors->has('informeAuditoria') ? ' has-error' : '' }}">
    <label  class="col-lg-4 col-sm-2 control-label">{{ trans('ui.nc.informeAuditoria') }}
    <span class="obligatorio"> * </span></label>
    <div class="col-lg-8">

        {!! Form::select('informeAuditoria', array_merge([''=>'Seleccione un Valor'],$informeAuditorias->toArray()) ,null, ['class' => 'form-control','id'=>'informeAuditoria']) !!}
        @if ($errors->has('informeAuditoria'))
          <span class="help-block">
            <strong>{{ $errors->first('informeAuditoria') }}</strong>
          </span>
        @endif

    </div>
</div>


<div class="form-group {{ $errors->has('estado') ? ' has-error' : '' }}">
    <label  class="col-lg-4 col-sm-2 control-label">{{ trans('ui.nc.estado') }}
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


<div class="form-group {{ $errors->has('fechaIntervencion') ? ' has-error' : '' }}">
    <label  class="col-lg-4 col-sm-2 control-label">{{ trans('ui.nc.fechaIntervencion') }}</label>
    <div class="col-lg-8">

        {!! Form::date('fechaIntervencion',  \Carbon\Carbon::now(), ['class' => 'form-control']) !!}
        @if ($errors->has('fechaIntervencion'))
          <span class="help-block">
            <strong>{{ $errors->first('fechaIntervencion') }}</strong>
          </span>
        @endif
    </div>
</div>

<div class="form-group {{ $errors->has('correccion') ? ' has-error' : '' }}">
    <label  class="col-lg-4 col-sm-2 control-label">{{ trans('ui.nc.correccion') }}</label>
    <div class="col-lg-8">

        {!! Form::textarea('correccion', null, ['class' => 'form-control','rows' => '4']) !!}
        @if ($errors->has('correccion'))
          <span class="help-block">
            <strong>{{ $errors->first('correccion') }}</strong>
          </span>
        @endif
    </div>
</div>


<div class="form-group {{ $errors->has('fechaImplementacion') ? ' has-error' : '' }}">
    <label  class="col-lg-4 col-sm-2 control-label">{{ trans('ui.nc.fechaImplementacion') }}</label>
    <div class="col-lg-8">

        {!! Form::date('fechaImplementacion',null, ['class' => 'form-control']) !!}
        @if ($errors->has('fechaImplementacion'))
          <span class="help-block">
            <strong>{{ $errors->first('fechaImplementacion') }}</strong>
          </span>
        @endif
    </div>
</div>

<div class="form-group {{ $errors->has('accionCorrectiva') ? ' has-error' : '' }}">
    <label  class="col-lg-4 col-sm-2 control-label">{{ trans('ui.nc.accionCorrectiva') }}</label>
    <div class="col-lg-8">

        {!! Form::textarea('accionCorrectiva', null, ['class' => 'form-control','rows' => '4']) !!}
        @if ($errors->has('accionCorrectiva'))
          <span class="help-block">
            <strong>{{ $errors->first('accionCorrectiva') }}</strong>
          </span>
        @endif
    </div>
</div>


<div class="form-group {{ $errors->has('fechaImplementacionAC') ? ' has-error' : '' }}">
    <label  class="col-lg-4 col-sm-2 control-label">{{ trans('ui.nc.fechaImplementacionAC') }}</label>
    <div class="col-lg-8">

        {!! Form::date('fechaImplementacionAC',null, ['class' => 'form-control']) !!}
        @if ($errors->has('fechaImplementacionAC'))
          <span class="help-block">
            <strong>{{ $errors->first('fechaImplementacionAC') }}</strong>
          </span>
        @endif
    </div>
</div>

<div class="form-group {{ $errors->has('fechaVerificacionAC') ? ' has-error' : '' }}">
    <label  class="col-lg-4 col-sm-2 control-label">{{ trans('ui.nc.fechaVerificacionAC') }}</label>
    <div class="col-lg-8">

        {!! Form::date('fechaVerificacionAC',null, ['class' => 'form-control']) !!}
        @if ($errors->has('fechaVerificacionAC'))
          <span class="help-block">
            <strong>{{ $errors->first('fechaVerificacionAC') }}</strong>
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
        <a href="{{ url('no-conformidad') }}">
        {!! Form::button(trans('ui.user.button_cancelar'), ['class' => 'btn btn-warning','id' =>'cancelar']) !!}
        </a>
    </div>
</div>
