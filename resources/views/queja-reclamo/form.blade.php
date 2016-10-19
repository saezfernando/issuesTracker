<div class="form-group {{ $errors->has('titulo') ? ' has-error' : '' }}">
    <label  class="col-lg-4 col-sm-2 control-label">{{ trans('ui.qr.titulo') }}
    <span class="obligatorio"> * </span></label>
    <div class="col-lg-8">

        {!! Form::text('titulo',  null, ['class' => 'form-control']) !!}
        @if ($errors->has('titulo'))
          <span class="help-block">
            <strong>{{ $errors->first('titulo') }}</strong>
          </span>
        @endif


    </div>
</div>

<div class="form-group {{ $errors->has('estado') ? ' has-error' : '' }}">
    <label  class="col-lg-4 col-sm-2 control-label">{{ trans('ui.qr.estado') }}
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

<div class="form-group {{ $errors->has('fechaCreacion') ? ' has-error' : '' }}">
    <label  class="col-lg-4 col-sm-2 control-label">{{ trans('ui.nc.fechaCreacion') }}</label>
    <div class="col-lg-8">

        {!! Form::date('fechaCreacion',  \Carbon\Carbon::now(), ['class' => 'form-control']) !!}
        @if ($errors->has('fechaCreacion'))
          <span class="help-block">
            <strong>{{ $errors->first('fechaCreacion') }}</strong>
          </span>
        @endif
    </div>
</div>

<div class="form-group {{ $errors->has('descripcion') ? ' has-error' : '' }}">
    <label  class="col-lg-4 col-sm-2 control-label">{{ trans('ui.qr.descripcion') }}</label>
    <div class="col-lg-8">

        {!! Form::textarea('descripcion', null, ['class' => 'form-control','rows'=>'4']) !!}
        @if ($errors->has('descripcion'))
          <span class="help-block">
            <strong>{{ $errors->first('descripcion') }}</strong>
          </span>
        @endif
    </div>
</div>

<div class="form-group {{ $errors->has('responsable') ? ' has-error' : '' }}">
    <label  class="col-lg-4 col-sm-2 control-label">{{ trans('ui.qr.responsable') }}
    <span class="obligatorio"> * </span></label>
    <div class="col-lg-8">

        {!! Form::select('responsable', $responsables ,null, ['class' => 'form-control']) !!}
        @if ($errors->has('responsable'))
          <span class="help-block">
            <strong>{{ $errors->first('responsable') }}</strong>
          </span>
        @endif

    </div>
</div>

<div class="form-group {{ $errors->has('derivadoA') ? ' has-error' : '' }}">
    <label  class="col-lg-4 col-sm-2 control-label">{{ trans('ui.qr.derivadoA') }}</label>
    <div class="col-lg-8">

        {!! Form::text('derivadoA', null, ['class' => 'form-control']) !!}
        @if ($errors->has('derivadoA'))
          <span class="help-block">
            <strong>{{ $errors->first('derivadoA') }}</strong>
          </span>
        @endif
    </div>
</div>

<div class="form-group {{ $errors->has('solicitante') ? ' has-error' : '' }}">
    <label  class="col-lg-4 col-sm-2 control-label">{{ trans('ui.qr.solicitante') }}</label>
    <div class="col-lg-8">

        {!! Form::text('solicitante', null, ['class' => 'form-control']) !!}
        @if ($errors->has('solicitante'))
          <span class="help-block">
            <strong>{{ $errors->first('solicitante') }}</strong>
          </span>
        @endif
    </div>
</div>

<div class="form-group {{ $errors->has('datosContacto') ? ' has-error' : '' }}">
    <label  class="col-lg-4 col-sm-2 control-label">{{ trans('ui.qr.datosContacto') }}</label>
    <div class="col-lg-8">

        {!! Form::text('datosContacto', null, ['class' => 'form-control']) !!}
        @if ($errors->has('datosContacto'))
          <span class="help-block">
            <strong>{{ $errors->first('datosContacto') }}</strong>
          </span>
        @endif
    </div>
</div>

<div class="form-group {{ $errors->has('solucion') ? ' has-error' : '' }}">
    <label  class="col-lg-4 col-sm-2 control-label">{{ trans('ui.qr.solucion') }}</label>
    <div class="col-lg-8">

        {!! Form::textarea('solucion', null, ['class' => 'form-control','rows'=>'4']) !!}
        @if ($errors->has('solucion'))
          <span class="help-block">
            <strong>{{ $errors->first('solucion') }}</strong>
          </span>
        @endif
    </div>
</div>

<div class="form-group {{ $errors->has('fechaImplementacion') ? ' has-error' : '' }}">
    <label  class="col-lg-4 col-sm-2 control-label">{{ trans('ui.nc.fechaImplementacion') }}</label>
    <div class="col-lg-8">

        {!! Form::date('fechaImplementacion', null, ['class' => 'form-control']) !!}
        @if ($errors->has('fechaImplementacion'))
          <span class="help-block">
            <strong>{{ $errors->first('fechaImplementacion') }}</strong>
          </span>
        @endif
    </div>
</div>

<div class="form-group {{ $errors->has('fechaCierre') ? ' has-error' : '' }}">
    <label  class="col-lg-4 col-sm-2 control-label">{{ trans('ui.qr.fechaCierre') }}</label>
    <div class="col-lg-8">

        {!! Form::date('fechaCierre',  null, ['class' => 'form-control']) !!}
        @if ($errors->has('fechaCierre'))
          <span class="help-block">
            <strong>{{ $errors->first('fechaCierre') }}</strong>
          </span>
        @endif
    </div>
</div>

<div class="form-group {{ $errors->has('pnc') ? ' has-error' : '' }}">
    <label  class="col-lg-4 col-sm-2 control-label">{{ trans('ui.qr.pnc') }}
    <span class="obligatorio"> * </span></label>
    <div class="col-lg-8">

        {!! Form::select('pnc', $pncs ,null, ['class' => 'form-control']) !!}
        @if ($errors->has('pnc'))
          <span class="help-block">
            <strong>{{ $errors->first('pnc') }}</strong>
          </span>
        @endif

    </div>
</div>

<div class="form-group {{ $errors->has('añoCreacion') ? ' has-error' : '' }}">
    <label  class="col-lg-4 col-sm-2 control-label">{{ trans('ui.qr.añoCreacion') }}</label>
    <div class="col-lg-8">

        {!! Form::number('añoCreacion', 2016, ['class' => 'form-control']) !!}
        @if ($errors->has('añoCreacion'))
          <span class="help-block">
            <strong>{{ $errors->first('añoCreacion') }}</strong>
          </span>
        @endif
    </div>
</div>

<div class="form-group {{ $errors->has('comentarios') ? ' has-error' : '' }}">
    <label  class="col-lg-4 col-sm-2 control-label">{{ trans('ui.qr.comentarios') }}</label>
    <div class="col-lg-8">

        {!! Form::textarea('comentarios', null, ['class' => 'form-control','rows' => '4']) !!}
        @if ($errors->has('comentarios'))
          <span class="help-block">
            <strong>{{ $errors->first('comentarios') }}</strong>
          </span>
        @endif
    </div>
</div>

<div class="form-group {{ $errors->has('doc') ? ' has-error' : '' }}">
    <label  class="col-lg-4 col-sm-2 control-label">{{ trans('ui.qr.doc') }}</label>
    <div class="col-lg-8">

 @if (!empty($qr))
  @if (!empty($qr->nombre_archivo_original)) 
    <a href="{{url('queja-reclamo/file') . '/' . $qr->id }}">
    <i class="fa fa-file"></i>
  {{ $qr->nombre_archivo_original }} @else {{ trans('ui.qr.sinadjunto') }} @endif
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
        <a href="{{ url('queja-reclamo') }}">
        {!! Form::button(trans('ui.qr.button_cancelar'), ['class' => 'btn btn-warning','id' =>'cancelar']) !!}
        </a>
    </div>
</div>
