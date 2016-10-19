<div class="form-group {{ $errors->has('titulo') ? ' has-error' : '' }}">
    <label  class="col-lg-3 col-sm-2 control-label">{{ trans('ui.proc.titulo') }}<span class="obligatorio"> * </span>
    </label>
    <div class="col-lg-7">

        {!! Form::text('titulo', null, ['class' => 'form-control']) !!}
         @if ($errors->has('titulo'))
          <span class="help-block">
            <strong>{{ $errors->first('titulo') }}</strong>
          </span>
        @endif

    </div>
</div>

<div class="form-group {{ $errors->has('dueño') ? ' has-error' : '' }}">
    <label  class="col-lg-3 col-sm-2 control-label">{{ trans('ui.proc.dueño') }}
    <span class="obligatorio"> * </span></label>
    <div class="col-lg-7">

        {!! Form::select('dueño', $usuarios ,null, ['class' => 'form-control']) !!}
        @if ($errors->has('dueño'))
          <span class="help-block">
            <strong>{{ $errors->first('dueño') }}</strong>
          </span>
        @endif

    </div>
</div>

<div class="form-group {{ $errors->has('codigo') ? ' has-error' : '' }}">
    <label  class="col-lg-3 col-sm-2 control-label">{{ trans('ui.proc.codigo') }}<span class="obligatorio"> * </span></label>
    <div class="col-lg-7">

        {!! Form::text('codigo', null, ['class' => 'form-control']) !!}
         @if ($errors->has('codigo'))
          <span class="help-block">
            <strong>{{ $errors->first('codigo') }}</strong>
          </span>
        @endif

    </div>
</div>

<div class="form-group {{ $errors->has('certificado') ? ' has-error' : '' }}">
    <label  class="col-lg-3 col-sm-2 control-label">{{ trans('ui.proc.certificado') }}
    <span class="obligatorio"> * </span></label>
    <div class="col-lg-7">

        {!! Form::select('certificado', $certificados ,null, ['class' => 'form-control']) !!}
        @if ($errors->has('certificado'))
          <span class="help-block">
            <strong>{{ $errors->first('certificado') }}</strong>
          </span>
        @endif

    </div>
</div>

<div class="form-group {{ $errors->has('fechaEmision') ? ' has-error' : '' }}">
    <label  class="col-lg-3 col-sm-2 control-label">{{ trans('ui.proc.fechaEmision') }}<span class="obligatorio"> * </span></label>
    <div class="col-lg-7">

        {!! Form::date('fechaEmision',  \Carbon\Carbon::now(), ['class' => 'form-control']) !!}
        @if ($errors->has('fechaEmision'))
          <span class="help-block">
            <strong>{{ $errors->first('fechaEmision') }}</strong>
          </span>
        @endif
    </div>
</div>

<div class="form-group {{ $errors->has('version') ? ' has-error' : '' }}">
    <label  class="col-lg-3 col-sm-2 control-label">{{ trans('ui.proc.version') }}</label>
    <div class="col-lg-7">

        {!! Form::number('version', ($create) ? 1 : null, ['class' => 'form-control','disabled'=>'disabled']) !!}
        @if ($errors->has('version'))
          <span class="help-block">
            <strong>{{ $errors->first('version') }}</strong>
          </span>
        @endif
    </div>
</div>

<div class="form-group {{ $errors->has('revision') ? ' has-error' : '' }}">
    <label  class="col-lg-3 col-sm-2 control-label">{{ trans('ui.proc.revision') }}</label>
    <div class="col-lg-7">

        {!! Form::number('revision',  ($create) ? 1 : null, ['class' => 'form-control','disabled'=>'disabled']) !!}
        @if ($errors->has('revision'))
          <span class="help-block">
            <strong>{{ $errors->first('revision') }}</strong>
          </span>
        @endif
    </div>
</div>

@if($create)
<div class="form-group {{ $errors->has('estado') ? ' has-error' : '' }}">
    <label  class="col-lg-3 col-sm-2 control-label">{{ trans('ui.proc.estado') }}
    <span class="obligatorio"> * </span></label>
    <div class="col-lg-7">

        {!! Form::select('estado', ['2'=>'Revisión','3'=>'Borrador'] ,2, ['class' => 'form-control']) !!}
        @if ($errors->has('estado'))
          <span class="help-block">
            <strong>{{ $errors->first('estado') }}</strong>
          </span>
        @endif

    </div>
</div>


<div class="form-group {{ $errors->has('doc') ? ' has-error' : '' }}">
    <label  class="col-lg-3 col-sm-2 control-label">{{ trans('ui.proc.doc') }}<span class="obligatorio"> * </span></label>
    <div class="col-lg-7">

     @if (!empty($procedimiento))
              
        @foreach($procedimiento->ultimaVersion as $version)
        <a href="{{url('procedimiento-operativo/file') . '/' . $version->id }}">
        <i class="fa fa-file"></i>
        {{ $version->nombre_archivo_original }} </a>

        @endforeach
      @endif


        {!! Form::file('doc', null, ['class' => 'form-control']) !!}

        @if ($errors->has('doc'))
          <span class="help-block">
            <strong>{{ $errors->first('doc') }}</strong>
          </span>
        @endif

    </div>
</div>
@endif

<div class="form-group">
    <div class="col-lg-offset-2 col-lg-8">

        {!! Form::submit($button, ['class' => 'btn btn-primary','id'=>'agregar']) !!}
      <a href="{{ url('procedimiento-operativo') }}">
        {!! Form::button(trans('ui.user.button_cancelar'), ['class' => 'btn btn-warning','id' =>'cancelar']) !!}
        </a>
    </div>
</div>