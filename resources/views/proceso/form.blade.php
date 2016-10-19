<div class="form-group {{ $errors->has('nombre') ? ' has-error' : '' }}">
    <label  class="col-lg-2 col-sm-2 control-label">{{ trans('ui.proceso.nombre') }}</label>
    <div class="col-lg-8">

        {!! Form::text('nombre', null, ['class' => 'form-control']) !!}
         @if ($errors->has('nombre'))
          <span class="help-block">
            <strong>{{ $errors->first('nombre') }}</strong>
          </span>
        @endif

    </div>
</div>


<div class="form-group {{ $errors->has('body') ? ' has-error' : '' }}">
    <label  class="col-lg-2 col-sm-2 control-label">{{ trans('ui.proceso.body') }}</label>
    <div class="col-lg-8">

        {!! Form::text('body', null, ['class' => 'form-control']) !!}
        @if ($errors->has('body'))
          <span class="help-block">
            <strong>{{ $errors->first('body') }}</strong>
          </span>
        @endif
    </div>
</div>

<div class="form-group {{ $errors->has('creador') ? ' has-error' : '' }}">
    <label  class="col-lg-2 col-sm-2 control-label">{{ trans('ui.proceso.creador') }}</label>
    <div class="col-lg-8">

        {!! Form::text('creador', null, ['class' => 'form-control']) !!}
        @if ($errors->has('creador'))
          <span class="help-block">
            <strong>{{ $errors->first('creador') }}</strong>
          </span>
        @endif
    </div>
</div>

<div class="form-group {{ $errors->has('estado') ? ' has-error' : '' }}">
    <label  class="col-lg-2 col-sm-2 control-label">{{ trans('ui.proceso.estado') }}</label>
    <div class="col-lg-8">

        {!! Form::text('estado', null, ['class' => 'form-control']) !!}
        @if ($errors->has('estado'))
          <span class="help-block">
            <strong>{{ $errors->first('estado') }}</strong>
          </span>
        @endif

    </div>
</div>


<div class="form-group {{ $errors->has('doc') ? ' has-error' : '' }}">
    <label  class="col-lg-2 col-sm-2 control-label">{{ trans('ui.proceso.doc') }}</label>
    <div class="col-lg-8">

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
        {!! Form::button(trans('ui.user.button_cancelar'), ['class' => 'btn btn-warning','id' =>'cancelar']) !!}
        </a>
    </div>
</div>