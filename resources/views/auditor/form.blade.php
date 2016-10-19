<div class="form-group {{ $errors->has('descripcion') ? ' has-error' : '' }}">
    <label  class="col-lg-3 col-sm-2 control-label">{{ trans('ui.auditor.descripcion') }}
    <span class="obligatorio"> * </span></label>
    <div class="col-lg-9">

        {!! Form::text('descripcion', null, ['class' => 'form-control']) !!}
         @if ($errors->has('descripcion'))
          <span class="help-block">
            <strong>{{ $errors->first('descripcion') }}</strong>
          </span>
        @endif

    </div>
</div>


<div class="form-group">
    <div class="col-lg-offset-2 col-lg-8">

        {!! Form::submit($button, ['class' => 'btn btn-primary','id' =>'agregar']) !!}
        
        <a href="{{ url('area') }}">
        {!! Form::button(trans('ui.auditor.button_cancelar'), ['class' => 'btn btn-warning','id' =>'cancelar']) !!}
        </a>

    </div>
</div>
