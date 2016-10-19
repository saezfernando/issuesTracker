<div class="form-group {{ $errors->has('indicador') ? ' has-error' : '' }}">
    <label  class="col-lg-2 col-sm-2 control-label">{{ trans('ui.seg.indicador') }}
    <span class="obligatorio"> * </span></label>
    <div class="col-lg-8">

        {!! Form::select('indicador', $indicadores ,null, ['class' => 'form-control']) !!}
        @if ($errors->has('indicador'))
          <span class="help-block">
            <strong>{{ $errors->first('indicador') }}</strong>
          </span>
        @endif

    </div>
</div>

<div class="form-group {{ $errors->has('fecha') ? ' has-error' : '' }}">
    <label  class="col-lg-2 col-sm-2 control-label">{{ trans('ui.seg.fecha') }}</label>
    <div class="col-lg-8">

        {!! Form::date('fecha',  \Carbon\Carbon::now(), ['class' => 'form-control']) !!}
        @if ($errors->has('fecha'))
          <span class="help-block">
            <strong>{{ $errors->first('fecha') }}</strong>
          </span>
        @endif
    </div>
</div>


<div class="form-group {{ $errors->has('valorIndicador') ? ' has-error' : '' }}">
    <label  class="col-lg-2 col-sm-2 control-label">{{ trans('ui.seg.valorIndicador') }}</label>
    <div class="col-lg-8">

        {!! Form::number('valorIndicador', null, ['class' => 'form-control']) !!}
         @if ($errors->has('valorIndicador'))
          <span class="help-block">
            <strong>{{ $errors->first('valorIndicador') }}</strong>
          </span>
        @endif

    </div>
</div>


<div class="form-group {{ $errors->has('analisis') ? ' has-error' : '' }}">
    <label  class="col-lg-2 col-sm-2 control-label">{{ trans('ui.seg.analisis') }}</label>
    <div class="col-lg-8">

        {!! Form::textarea('analisis', null, ['class' => 'form-control','rows' => '4']) !!}
        @if ($errors->has('analisis'))
          <span class="help-block">
            <strong>{{ $errors->first('analisis') }}</strong>
          </span>
        @endif
    </div>
</div>

<div class="form-group {{ $errors->has('acciones') ? ' has-error' : '' }}">
    <label  class="col-lg-2 col-sm-2 control-label">{{ trans('ui.seg.acciones') }}</label>
    <div class="col-lg-8">

        {!! Form::textarea('acciones', null, ['class' => 'form-control','rows' => '4']) !!}
        @if ($errors->has('acciones'))
          <span class="help-block">
            <strong>{{ $errors->first('acciones') }}</strong>
          </span>
        @endif
    </div>
</div>



<div class="form-group {{ $errors->has('doc') ? ' has-error' : '' }}">
    <label  class="col-lg-2 col-sm-2 control-label">{{ trans('ui.seg.doc') }}</label>
    <div class="col-lg-8">

     @if (!empty($seguimiento))
              
        <a href="{{url('seguimiento/file') . '/' . $seguimiento->id }}">
        <i class="fa fa-file"></i>
        {{ $seguimiento->nombre_archivo_original }} </a>

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
      <a href="{{ url('proceso') }}">
        {!! Form::button(trans('ui.seg.button_cancelar'), ['class' => 'btn btn-warning','id' =>'cancelar']) !!}
        </a>
    </div>
</div>
