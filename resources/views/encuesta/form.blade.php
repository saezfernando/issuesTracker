<div class="form-group {{ $errors->has('nombre') ? ' has-error' : '' }}">
    <label  class="col-lg-4 col-sm-2 control-label">{{ trans('ui.enc.nombre') }}<span class="obligatorio"> * </span>
    </label>
    <div class="col-lg-8">

        {!! Form::text('nombre', null, ['class' => 'form-control']) !!}
        @if ($errors->has('nombre'))
          <span class="help-block">
            <strong>{{ $errors->first('nombre') }}</strong>
          </span>
        @endif
    </div>
</div>



<div class="form-group {{ $errors->has('periodo') ? ' has-error' : '' }}">
    <label  class="col-lg-4 col-sm-2 control-label">{{ trans('ui.enc.periodo') }}
    <span class="obligatorio"> * </span></label>
    <div class="col-lg-8">

        {!! Form::date('periodo',  \Carbon\Carbon::now(), ['class' => 'form-control']) !!}
        @if ($errors->has('periodo'))
          <span class="help-block">
            <strong>{{ $errors->first('periodo') }}</strong>
          </span>
        @endif
    </div>
</div>


<div class="form-group {{ $errors->has('procedimiento') ? ' has-error' : '' }}">
    <label  class="col-lg-4 col-sm-2 control-label">{{ trans('ui.enc.procedimiento') }}
    <span class="obligatorio"> * </span></label>
    <div class="col-lg-8">

        {!! Form::select('procedimiento', $procedimientos ,null, array('id' => 'procedimiento')) !!}
        @if ($errors->has('procedimiento'))
          <span class="help-block">
            <strong>{{ $errors->first('procedimiento') }}</strong>
          </span>
        @endif

    </div>
</div>

<div class="form-group {{ $errors->has('porcentajeSatisfaccion') ? ' has-error' : '' }}">
    <label  class="col-lg-4 col-sm-2 control-label">{{ trans('ui.enc.porcentajeSatisfaccion') }}
    </label>
    <div class="col-lg-8">

        {!! Form::number('porcentajeSatisfaccion', $create ? 0 : null, ['class' => 'form-control']) !!}
        @if ($errors->has('porcentajeSatisfaccion'))
          <span class="help-block">
            <strong>{{ $errors->first('porcentajeSatisfaccion') }}</strong>
          </span>
        @endif
    </div>
</div>

<div class="form-group {{ $errors->has('enlaceEncuesta') ? ' has-error' : '' }}">
    <label  class="col-lg-4 col-sm-2 control-label">{{ trans('ui.enc.enlaceEncuesta') }}
    </label>
    <div class="col-lg-5">

        {!! Form::text('enlaceEncuesta', null, ['class' => 'form-control','id' => 'enlaceEncuesta']) !!}
        @if ($errors->has('enlaceEncuesta'))
          <span class="help-block">
            <strong>{{ $errors->first('enlaceEncuesta') }}</strong>
          </span>
        @endif
    </div>
    <div class="col-lg-3">
        {!! Form::button(trans('ui.in.button_probar'), ['class' => 'btn btn-info','id' =>'probar']) !!}
    </div>

</div>


<div class="form-group {{ $errors->has('enlaceReporte') ? ' has-error' : '' }}">
    <label  class="col-lg-4 col-sm-2 control-label">{{ trans('ui.enc.enlaceReporte') }}
    </label>
    <div class="col-lg-5">

        {!! Form::text('enlaceReporte', null, ['class' => 'form-control','id' => 'enlaceReporte']) !!}
        @if ($errors->has('enlaceReporte'))
          <span class="help-block">
            <strong>{{ $errors->first('enlaceReporte') }}</strong>
          </span>
        @endif
    </div>
    <div class="col-lg-3">
        {!! Form::button(trans('ui.in.button_probar'), ['class' => 'btn btn-info','id' =>'probarReporte']) !!}
    </div>
</div>


<div class="form-group {{ $errors->has('tratamientoDesfavorable') ? ' has-error' : '' }}">
    <label  class="col-lg-4 col-sm-2 control-label">{{ trans('ui.enc.tratamientoDesfavorable') }}
    <span class="obligatorio"> * </span></label>
    <div class="col-lg-8">

        {!! Form::select('tratamientoDesfavorable', ['1'=>'Si','0'=>'No'] ,$create ? '0' : null, array('class' => 'form-control','id' => 'tratamientoDesfavorable')) !!}
        @if ($errors->has('tratamientoDesfavorable'))
          <span class="help-block">
            <strong>{{ $errors->first('tratamientoDesfavorable') }}</strong>
          </span>
        @endif

    </div>
</div>


<div class="form-group {{ $errors->has('porcentaje') ? ' has-error' : '' }}">
    <label  class="col-lg-4 col-sm-2 control-label">{{ trans('ui.enc.porcentaje') }}
    </label>
    <div class="col-lg-8">

        {!! Form::number('porcentaje', $create ? 0 : null, ['class' => 'form-control','id' => 'porcentaje']) !!}
        @if ($errors->has('porcentaje'))
          <span class="help-block">
            <strong>{{ $errors->first('porcentaje') }}</strong>
          </span>
        @endif
    </div>
</div>


<div class="form-group {{ $errors->has('causa') ? ' has-error' : '' }}">
    <label  class="col-lg-4 col-sm-2 control-label">{{ trans('ui.enc.causa') }}</label>
    <div class="col-lg-8">

        {!! Form::textarea('causa', null, ['class' => 'form-control','rows' => '4','id' => 'causa']) !!}
        @if ($errors->has('causa'))
          <span class="help-block">
            <strong>{{ $errors->first('causa') }}</strong>
          </span>
        @endif
    </div>
</div>


<div class="form-group {{ $errors->has('accionCorrectiva') ? ' has-error' : '' }}">
    <label  class="col-lg-4 col-sm-2 control-label">{{ trans('ui.enc.accionCorrectiva') }}</label>
    <div class="col-lg-8">

        {!! Form::textarea('accionCorrectiva', null, ['class' => 'form-control','rows' => '4','id' => 'accionCorrectiva']) !!}
        @if ($errors->has('accionCorrectiva'))
          <span class="help-block">
            <strong>{{ $errors->first('accionCorrectiva') }}</strong>
          </span>
        @endif
    </div>
</div>





<div class="form-group {{ $errors->has('doc') ? ' has-error' : '' }}">
    <label  class="col-lg-4 col-sm-2 control-label">{{ trans('ui.enc.doc') }}</label>
    <div class="col-lg-8">
 @if (!empty($enc))
  @if (!empty($enc->nombre_archivo_original)) 
    <a href="{{url('encuesta/file') . '/' . $enc->id }}">
    <i class="fa fa-file"></i>
  {{ $enc->nombre_archivo_original }} @else {{ trans('ui.enc.sinadjunto') }} @endif
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
    <div class="col-lg-offset-4 col-lg-8">

        {!! Form::submit($button, ['class' => 'btn btn-primary','id'=>'agregar']) !!}
        <a href="{{ url('encuesta') }}">
        {!! Form::button(trans('ui.user.button_cancelar'), ['class' => 'btn btn-warning','id' =>'cancelar']) !!}
        </a>
    </div>
</div>
