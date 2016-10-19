
<div class="form-group {{ $errors->has('titulo') ? ' has-error' : '' }}">
    <label  class="col-lg-4 col-sm-2 control-label">{{ trans('ui.ci.titulo') }} 
    <span class="obligatorio"> * </span></label>
    <div class="col-lg-8">

        {!! Form::text('titulo', null, ['class' => 'form-control']) !!}
         @if ($errors->has('titulo'))
          <span class="help-block">
            <strong>{{ $errors->first('titulo') }}</strong>
          </span>
        @endif

    </div>
</div>

<div class="form-group {{ $errors->has('tipo') ? ' has-error' : '' }}">
    <label  class="col-lg-4 col-sm-2 control-label">{{ trans('ui.ci.tipo') }}
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

<div class="form-group {{ $errors->has('objetivo') ? ' has-error' : '' }}">
    <label  class="col-lg-4 col-sm-2 control-label">{{ trans('ui.ci.objetivo') }}
    <span class="obligatorio"> * </span></label>
    <div class="col-lg-8">

        {!! Form::textarea('objetivo', null, ['class' => 'form-control','rows' => '4']) !!}
        @if ($errors->has('objetivo'))
          <span class="help-block">
            <strong>{{ $errors->first('objetivo') }}</strong>
          </span>
        @endif
    </div>
</div>

<div class="form-group {{ $errors->has('disertantes') ? ' has-error' : '' }}">
    <label  class="col-lg-4 col-sm-2 control-label">{{ trans('ui.ci.disertantes') }}</label>
    <div class="col-lg-8">

        {!! Form::textarea('disertantes', null, ['class' => 'form-control','rows' => '4']) !!}
        @if ($errors->has('disertantes'))
          <span class="help-block">
            <strong>{{ $errors->first('disertantes') }}</strong>
          </span>
        @endif
    </div>
</div>

<div class="form-group {{ $errors->has('procedimiento') ? ' has-error' : '' }}">
    <label  class="col-lg-4 col-sm-2 control-label">{{ trans('ui.ci.procedimiento') }}
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

<div class="form-group {{ $errors->has('area') ? ' has-error' : '' }}">
    <label  class="col-lg-4 col-sm-2 control-label">{{ trans('ui.ci.area') }}</label>
    <div class="col-lg-8">

        {!! Form::select('area', $areas ,null, ['class' => 'form-control']) !!}
        @if ($errors->has('area'))
          <span class="help-block">
            <strong>{{ $errors->first('area') }}</strong>
          </span>
        @endif

    </div>
</div>


<div class="form-group {{ $errors->has('fechaInicio') ? ' has-error' : '' }}">
    <label  class="col-lg-4 col-sm-2 control-label">{{ trans('ui.ci.fechaInicio') }}</label>
    <div class="col-lg-8">

        {!! Form::date('fechaInicio',  \Carbon\Carbon::now(), ['class' => 'form-control']) !!}
        @if ($errors->has('fechaInicio'))
          <span class="help-block">
            <strong>{{ $errors->first('fechaInicio') }}</strong>
          </span>
        @endif
    </div>
</div>

<div class="form-group {{ $errors->has('fechaFin') ? ' has-error' : '' }}">
    <label  class="col-lg-4 col-sm-2 control-label">{{ trans('ui.ci.fechaFin') }}</label>
    <div class="col-lg-8">

        {!! Form::date('fechaFin',null, ['class' => 'form-control']) !!}
        @if ($errors->has('fechaFin'))
          <span class="help-block">
            <strong>{{ $errors->first('fechaFin') }}</strong>
          </span>
        @endif
    </div>
</div>


<div class="form-group {{ $errors->has('estado') ? ' has-error' : '' }}">
    <label  class="col-lg-4 col-sm-2 control-label">{{ trans('ui.ci.estado') }}
    <span class="obligatorio"> * </span></label>
    <div class="col-lg-8">

        {!! Form::select('estado', $estados ,1, ['class' => 'form-control', 'id'=>'estado']) !!}
        @if ($errors->has('estado'))
          <span class="help-block">
            <strong>{{ $errors->first('estado') }}</strong>
          </span>
        @endif

    </div>
</div>

<div class="form-group {{ $errors->has('observaciones') ? ' has-error' : '' }}">
    <label  class="col-lg-4 col-sm-2 control-label">{{ trans('ui.ci.observaciones') }}</label>
    <div class="col-lg-8">

        {!! Form::textarea('observaciones', null, ['class' => 'form-control','rows' => '4']) !!}
        @if ($errors->has('observaciones'))
          <span class="help-block">
            <strong>{{ $errors->first('observaciones') }}</strong>
          </span>
        @endif
    </div>
</div>

<div class="form-group {{ $errors->has('metodoEvaluacion') ? ' has-error' : '' }}">
    <label  class="col-lg-4 col-sm-2 control-label">{{ trans('ui.ci.metodoEvaluacion') }}</label>
    <div class="col-lg-8">

        {!! Form::select('metodoEvaluacion', $metodoEvaluaciones ,null, ['class' => 'form-control']) !!}
        @if ($errors->has('metodoEvaluacion'))
          <span class="help-block">
            <strong>{{ $errors->first('metodoEvaluacion') }}</strong>
          </span>
        @endif

    </div>
</div>

<div class="form-group {{ $errors->has('evaluacionCapacitacion') ? ' has-error' : '' }}">
    <label  class="col-lg-4 col-sm-2 control-label">{{ trans('ui.ci.evaluacionCapacitacion') }}</label>
    <div class="col-lg-8">

        {!! Form::select('evaluacionCapacitacion', $evaluacionCapacitaciones ,3, ['class' => 'form-control','disabled'=>'disabled','id'=>'evaluacionCapacitacion'])!!}
        @if ($errors->has('evaluacionCapacitacion'))
          <span class="help-block">
            <strong>{{ $errors->first('evaluacionCapacitacion') }}</strong>
          </span>
        @endif

    </div>
</div>


<div class="form-group {{ $errors->has('responsableEvaluacion') ? ' has-error' : '' }}">
    <label  class="col-lg-4 col-sm-2 control-label">{{ trans('ui.ci.responsableEvaluacion') }}</label>
    <div class="col-lg-8">

        {!! Form::text('responsableEvaluacion', null, ['class' => 'form-control']) !!}
        @if ($errors->has('responsableEvaluacion'))
          <span class="help-block">
            <strong>{{ $errors->first('responsableEvaluacion') }}</strong>
          </span>
        @endif
    </div>
</div>

<div class="form-group {{ $errors->has('año') ? ' has-error' : '' }}">
    <label  class="col-lg-4 col-sm-2 control-label">{{ trans('ui.ci.año') }}
    <span class="obligatorio"> * </span></label>
    <div class="col-lg-8">

        {!! Form::number('año', 2016, ['class' => 'form-control']) !!}
        @if ($errors->has('año'))
          <span class="help-block">
            <strong>{{ $errors->first('año') }}</strong>
          </span>
        @endif
    </div>
</div>



<div class="form-group {{ $errors->has('doc') ? ' has-error' : '' }}">
    <label  class="col-lg-4 col-sm-2 control-label">{{ trans('ui.ci.doc') }}</label>
    <div class="col-lg-8">

 @if (!empty($capacitacionInterna))
  @if (!empty($capacitacionInterna->nombre_archivo_original)) 
    <a href="{{url('capacitacion-interna/file') . '/' . $capacitacionInterna->id }}">
    <i class="fa fa-file"></i>
  {{ $capacitacionInterna->nombre_archivo_original }} @else {{ trans('ui.ci.sinadjunto') }} @endif
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
        <a href="{{ url('capacitacion-interna') }}">
        {!! Form::button(trans('ui.user.button_cancelar'), ['class' => 'btn btn-warning','id' =>'cancelar']) !!}
        </a>
    </div>
</div>
