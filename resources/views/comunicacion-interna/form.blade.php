
<div class="form-group {{ $errors->has('comunicacion') ? ' has-error' : '' }}">
    <label  class="col-lg-4 col-md-4 col-sm-2 control-label">
    {{trans('ui.comi.comunicacion') }} 
    <span class="obligatorio"> * </span>
    </label>
    <div class="col-lg-8 col-md-8">

        {!! Form::text('comunicacion', null, ['class' => 'form-control']) !!}
         @if ($errors->has('comunicacion'))
          <span class="help-block">
            <strong>{{ $errors->first('comunicacion') }}</strong>
          </span>
        @endif

    </div>
</div>

<div class="form-group {{ $errors->has('tipoComunicacion') ? ' has-error' : '' }}">
    <label  class="col-lg-4 col-sm-2 control-label">{{ trans('ui.comi.tipo') }}
    <span class="obligatorio"> * </span></label>
    <div class="col-lg-8">

        {!! Form::select('tipoComunicacion', $tipos ,null, ['class' => 'form-control']) !!}
        @if ($errors->has('tipoComunicacion'))
          <span class="help-block">
            <strong>{{ $errors->first('tipoComunicacion') }}</strong>
          </span>
        @endif

    </div>
</div>

<div class="form-group {{ $errors->has('fecha') ? ' has-error' : '' }}">
    <label  class="col-lg-4 col-sm-2 control-label">{{ trans('ui.comi.fecha') }}
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

<div class="form-group {{ $errors->has('dueño') ? ' has-error' : '' }}">
    <label  class="col-lg-4 col-sm-2 control-label">{{ trans('ui.comi.dueño') }} 
    <span class="obligatorio"> * </span></label>
    <div class="col-lg-8">

        {!! Form::text('dueño', null, ['class' => 'form-control']) !!}
         @if ($errors->has('dueño'))
          <span class="help-block">
            <strong>{{ $errors->first('dueño') }}</strong>
          </span>
        @endif

    </div>
</div>

<div class="form-group {{ $errors->has('contenido') ? ' has-error' : '' }}">
    <label  class="col-lg-4 col-sm-2 control-label">{{ trans('ui.comi.contenido') }}
    <span class="obligatorio"> * </span></label>
    <div class="col-lg-8">

        {!! Form::textarea('contenido', null, ['class' => 'form-control','rows' => '4']) !!}
        @if ($errors->has('contenido'))
          <span class="help-block">
            <strong>{{ $errors->first('contenido') }}</strong>
          </span>
        @endif
    </div>
</div>



<div class="form-group {{ $errors->has('doc') ? ' has-error' : '' }}">
    <label  class="col-lg-4 col-sm-2 control-label">{{ trans('ui.comi.doc') }}</label>
    <div class="col-lg-8">

 @if (!empty($comunicacionInterna))
  @if (!empty($comunicacionInterna->nombre_archivo_original)) 
    <a href="{{url('comunicacion-interna/file') . '/' . $comunicacionInterna->id }}">
    <i class="fa fa-file"></i>
  {{ $comunicacionInterna->nombre_archivo_original }} @else {{ trans('ui.comi.sinadjunto') }} @endif
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

        {!! Form::submit($button, ['class' => 'btn btn-primary','id' => 'agregar']) !!}
        <a href="{{ url('comunicacion-interna') }}">
        {!! Form::button(trans('ui.user.button_cancelar'), ['class' => 'btn btn-warning','id' =>'cancelar']) !!}
        </a>
    </div>
</div>
