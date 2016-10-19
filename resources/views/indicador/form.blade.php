<div class="form-group {{ $errors->has('titulo') ? ' has-error' : '' }}">
    <label  class="col-lg-3 col-sm-2 control-label">{{ trans('ui.in.titulo') }}</label>
    <div class="col-lg-7">

        {!! Form::text('titulo', null, ['class' => 'form-control']) !!}
         @if ($errors->has('titulo'))
          <span class="help-block">
            <strong>{{ $errors->first('titulo') }}</strong>
          </span>
        @endif

    </div>
</div>

<div class="form-group {{ $errors->has('procedimiento') ? ' has-error' : '' }}">
    <label  class="col-lg-3 col-sm-2 control-label">{{ trans('ui.in.procedimiento') }}
    <span class="obligatorio"> * </span></label>
    <div class="col-lg-7">

        {!! Form::select('procedimiento', $procedimientosValidados ,null, ['class' => 'form-control']) !!}
        @if ($errors->has('procedimiento'))
          <span class="help-block">
            <strong>{{ $errors->first('procedimiento') }}</strong>
          </span>
        @endif

    </div>
</div>


<div class="form-group {{ $errors->has('responsable') ? ' has-error' : '' }}">
    <label  class="col-lg-3 col-sm-2 control-label">{{ trans('ui.in.responsable') }}
    <span class="obligatorio"> * </span></label>
    <div class="col-lg-7">

        {!! Form::select('responsable', $usuarios ,null, ['class' => 'form-control']) !!}
        @if ($errors->has('responsable'))
          <span class="help-block">
            <strong>{{ $errors->first('responsable') }}</strong>
          </span>
        @endif

    </div>
</div>

<div class="form-group {{ $errors->has('actividad') ? ' has-error' : '' }}">
    <label  class="col-lg-3 col-sm-2 control-label">{{ trans('ui.in.actividad') }}</label>
    <div class="col-lg-7">

        {!! Form::text('actividad', null, ['class' => 'form-control']) !!}
         @if ($errors->has('actividad'))
          <span class="help-block">
            <strong>{{ $errors->first('actividad') }}</strong>
          </span>
        @endif

    </div>
</div>

<div class="form-group {{ $errors->has('objetivo') ? ' has-error' : '' }}">
    <label  class="col-lg-3 col-sm-2 control-label">{{ trans('ui.in.objetivo') }}</label>
    <div class="col-lg-7">

        {!! Form::textarea('objetivo', null, ['class' => 'form-control','rows' => '4']) !!}
        @if ($errors->has('objetivo'))
          <span class="help-block">
            <strong>{{ $errors->first('objetivo') }}</strong>
          </span>
        @endif
    </div>
</div>

<div class="form-group {{ $errors->has('indicadorDescripcion') ? ' has-error' : '' }}">
    <label  class="col-lg-3 col-sm-2 control-label">{{ trans('ui.in.indicadorDescripcion') }}</label>
    <div class="col-lg-7">

        {!! Form::textarea('indicadorDescripcion', null, ['class' => 'form-control','rows' => '4']) !!}
        @if ($errors->has('indicadorDescripcion'))
          <span class="help-block">
            <strong>{{ $errors->first('indicadorDescripcion') }}</strong>
          </span>
        @endif
    </div>
</div>

<div class="form-group {{ $errors->has('frecuencia') ? ' has-error' : '' }}">
    <label  class="col-lg-3 col-sm-2 control-label">{{ trans('ui.in.frecuencia') }}
    <span class="obligatorio"> * </span></label>
    <div class="col-lg-7">

        {!! Form::select('frecuencia', $frecuencias ,null, ['class' => 'form-control']) !!}
        @if ($errors->has('frecuencia'))
          <span class="help-block">
            <strong>{{ $errors->first('frecuencia') }}</strong>
          </span>
        @endif

    </div>
</div>

<div class="form-group {{ $errors->has('fecha') ? ' has-error' : '' }}">
    <label  class="col-lg-3 col-sm-2 control-label">{{ trans('ui.in.fecha') }}</label>
    <div class="col-lg-7">

        {!! Form::date('fecha',  \Carbon\Carbon::now(), ['class' => 'form-control']) !!}
        @if ($errors->has('fecha'))
          <span class="help-block">
            <strong>{{ $errors->first('fecha') }}</strong>
          </span>
        @endif
    </div>
</div>

<div class="form-group {{ $errors->has('resultadosObtenidos') ? ' has-error' : '' }}">
    <label  class="col-lg-3 col-sm-2 control-label">{{ trans('ui.in.resultadosObtenidos') }}</label>
    <div class="col-lg-7">

        {!! Form::textarea('resultadosObtenidos', null, ['class' => 'form-control','rows' => '4']) !!}
        @if ($errors->has('resultadosObtenidos'))
          <span class="help-block">
            <strong>{{ $errors->first('resultadosObtenidos') }}</strong>
          </span>
        @endif
    </div>
</div>

<div class="form-group {{ $errors->has('observaciones') ? ' has-error' : '' }}">
    <label  class="col-lg-3 col-sm-2 control-label">{{ trans('ui.in.observaciones') }}</label>
    <div class="col-lg-7">

        {!! Form::textarea('observaciones', null, ['class' => 'form-control','rows' => '4']) !!}
        @if ($errors->has('observaciones'))
          <span class="help-block">
            <strong>{{ $errors->first('observaciones') }}</strong>
          </span>
        @endif
    </div>
</div>

<div class="form-group {{ $errors->has('observacionesDireccion') ? ' has-error' : '' }}">
    <label  class="col-lg-3 col-sm-2 control-label">{{ trans('ui.in.observacionesDireccion') }}</label>
    <div class="col-lg-7">

        {!! Form::textarea('observacionesDireccion', null, ['class' => 'form-control','rows' => '4']) !!}
        @if ($errors->has('observacionesDireccion'))
          <span class="help-block">
            <strong>{{ $errors->first('observacionesDireccion') }}</strong>
          </span>
        @endif
    </div>
</div>


<div class="form-group {{ $errors->has('meta') ? ' has-error' : '' }}">
    <label  class="col-lg-3 col-sm-2 control-label">{{ trans('ui.in.meta') }}</label>
    <div class="col-lg-7">

        {!! Form::number('meta', null, ['class' => 'form-control']) !!}
         @if ($errors->has('meta'))
          <span class="help-block">
            <strong>{{ $errors->first('meta') }}</strong>
          </span>
        @endif

    </div>
</div>


<div class="form-group {{ $errors->has('formula') ? ' has-error' : '' }}">
    <label  class="col-lg-3 col-sm-2 control-label">{{ trans('ui.in.formula') }}</label>
    <div class="col-lg-7">

        {!! Form::textarea('formula', null, ['class' => 'form-control','rows' => '4']) !!}
        @if ($errors->has('formula'))
          <span class="help-block">
            <strong>{{ $errors->first('formula') }}</strong>
          </span>
        @endif
    </div>
</div>


<div class="form-group {{ $errors->has('medida') ? ' has-error' : '' }}">
    <label  class="col-lg-3 col-sm-2 control-label">{{ trans('ui.in.medida') }}
    <span class="obligatorio"> * </span></label>
    <div class="col-lg-7">

        {!! Form::select('medida', $medidas ,null, ['class' => 'form-control']) !!}
        @if ($errors->has('medida'))
          <span class="help-block">
            <strong>{{ $errors->first('medida') }}</strong>
          </span>
        @endif

    </div>
</div>

<div class="form-group {{ $errors->has('fuenteInformacion') ? ' has-error' : '' }}">
    <label  class="col-lg-3 col-sm-2 control-label">{{ trans('ui.in.fuenteInformacion') }}</label>
    <div class="col-lg-7">

        {!! Form::textarea('fuenteInformacion', null, ['class' => 'form-control','rows' => '4']) !!}
        @if ($errors->has('fuenteInformacion'))
          <span class="help-block">
            <strong>{{ $errors->first('fuenteInformacion') }}</strong>
          </span>
        @endif
    </div>
</div>

<div class="form-group {{ $errors->has('enlaceEncuesta') ? ' has-error' : '' }}">
    <label  class="col-lg-3 col-sm-2 control-label">{{ trans('ui.in.enlaceEncuesta') }}</label>
    <div class="col-lg-5">

        {!! Form::text('enlaceEncuesta', null, ['class' => 'form-control','id' => 'enlaceEncuesta'] ) !!}
         @if ($errors->has('enlaceEncuesta'))
          <span class="help-block">
            <strong>{{ $errors->first('enlaceEncuesta') }}</strong>
          </span>
        @endif
    </div>
    <div class="col-lg-2">
        {!! Form::button(trans('ui.in.button_probar'), ['class' => 'btn btn-info','id' =>'probar']) !!}
    </div>
</div>


<div class="form-group {{ $errors->has('doc') ? ' has-error' : '' }}">
    <label  class="col-lg-3 col-sm-2 control-label">{{ trans('ui.in.doc') }}</label>
    <div class="col-lg-7">

     @if (!empty($indicador))
              
        <a href="{{url('indicador/file') . '/' . $indicador->id }}">
        <i class="fa fa-file"></i>
        {{ $indicador->nombre_archivo_original }} </a>

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
      <a href="{{ url('procedimiento-operativo') }}">
        {!! Form::button(trans('ui.in.button_cancelar'), ['class' => 'btn btn-warning','id' =>'cancelar']) !!}
        </a>
    </div>
</div>
