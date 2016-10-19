@extends('layouts.master')

@section('style')
    <link href="{{ asset('themes/admin/js/jquery-multi-select/css/multi-select.css') }}" rel="stylesheet" />
@stop

@section('content')
    <section class="wrapper">
        @include('partials.message')
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-heading">{{ trans('ui.enc.edit_enc') }}</div>
                        <div class="panel-body">
                            @include('errors.form_error')

                            {!! Form::model($encuesta, ['method' => 'PUT', 'files' => true, 'route' => ['encuesta.update', $encuesta->id], 'class' => 'cmxform form-horizontal', 'id' => 'encuestaForm']) !!}
                            
                            <!-- pasa ci y tablas auxiliares -->
                            @include('encuesta.form', array('encuesta' => $encuesta) + compact('procedimientos','create'), ['button' => trans('ui.enc.button_update')])

                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script src="{{ asset('themes/admin/js/validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('themes/admin/js/validation/validation-init.js') }}"></script>
    <script src="{{ asset('themes/admin/js/jquery-multi-select/js/jquery.multi-select.js') }}"></script>
    <script src="{{ asset('themes/admin/js/multi-select-init.js') }}"></script>

    <script type="text/javascript">

    $( document ).ready(function() {

        if($('#tratamientoDesfavorable').val() == 0){
           $('#porcentaje').attr('disabled','disabled');
            $('#causa').attr('disabled','disabled');
            $('#accionCorrectiva').attr('disabled','disabled');     
        }

    $('#tratamientoDesfavorable').change(function(){
        
        if($('#tratamientoDesfavorable').val() == 1) {
            $('#porcentaje').removeAttr('disabled');
            $('#causa').removeAttr('disabled');;
            $('#accionCorrectiva').removeAttr('disabled');;
        }
        else
        {
            $('#porcentaje').attr('disabled','disabled');
            $('#causa').attr('disabled','disabled');
            $('#accionCorrectiva').attr('disabled','disabled');
        }
    });
})
    </script>


@stop