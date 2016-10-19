<div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
    <label  class="col-lg-2 col-sm-2 control-label">{{ trans('ui.permission.name') }}</label>
    <div class="col-lg-8">

        {!! Form::text('name', null, ['class' => 'form-control']) !!}
        @if ($errors->has('name'))
          <span class="help-block">
            <strong>{{ $errors->first('name') }}</strong>
          </span>
        @endif

    </div>
</div>

<!--
<div class="form-group {{ $errors->has('slug') ? ' has-error' : '' }}">
    <label  class="col-lg-2 col-sm-2 control-label">{{ trans('ui.permission.slug') }}</label>
    <div class="col-lg-8">

        {!! Form::text('slug', null, ['class' => 'form-control']) !!}
        @if ($errors->has('slug'))
          <span class="help-block">
            <strong>{{ $errors->first('slug') }}</strong>
          </span>
        @endif

    </div>
</div>
-->


<div class="form-group {{ $errors->has('description') ? ' has-error' : '' }}">
    <label  class="col-lg-2 col-sm-2 control-label">{{ trans('ui.permission.description') }}</label>
    <div class="col-lg-8">

        {!! Form::text('description', null, ['class' => 'form-control']) !!}
        @if ($errors->has('description'))
          <span class="help-block">
            <strong>{{ $errors->first('description') }}</strong>
          </span>
        @endif

    </div>
</div>

<div class="form-group">
    <div class="col-lg-offset-2 col-lg-8">

        {!! Form::submit($button, ['class' => 'btn btn-primary','id'=>'agregar']) !!}
        <a href="{{ url('auth/permission') }}">
        {!! Form::button(trans('ui.user.button_cancelar'), ['class' => 'btn btn-warning','id' =>'cancelar']) !!}
        </a>
    </div>
</div>