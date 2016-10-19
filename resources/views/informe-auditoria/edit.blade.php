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
                        <div class="panel-heading">{{ trans('ui.ia.edit_ia') }}</div>
                        <div class="panel-body">
                            @include('errors.form_error')

                            {!! Form::model($ia, ['method' => 'PUT', 'files' => true, 'route' => ['informe-auditoria.update', $ia->id], 'class' => 'cmxform form-horizontal', 'id' => 'informeAuditoriaForm']) !!}
                            
                            <!-- pasa ci y tablas auxiliares -->
                            @include('informe-auditoria.form', array('ia' => $ia) + compact('tipos','auditores','niveles','procedimientos','informeAuditoriaProcedimientos','informeAuditoriaAuditores'), ['button' => trans('ui.ia.button_update')])

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
@stop