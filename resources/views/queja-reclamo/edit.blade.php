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
                        <div class="panel-heading">{{ trans('ui.qr.edit_qr') }}</div>
                        <div class="panel-body">
                            @include('errors.form_error')

                            {!! Form::model($qr, ['method' => 'PUT', 'files' => true, 'route' => ['queja-reclamo.update', $qr->id], 'class' => 'cmxform form-horizontal', 'id' => 'quejaReclamoForm']) !!}
                            
                            <!-- pasa ci y tablas auxiliares -->
                            @include('queja-reclamo.form', array('qr' => $qr) + compact('responsables', 'pncs','estados'), ['button' => trans('ui.qr.button_update')])

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