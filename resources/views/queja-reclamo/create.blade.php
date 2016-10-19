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
                        <div class="panel-heading">{{ trans('ui.qr.new_qr') }}</div>
                        <div class="panel-body">
                            @include('errors.form_error')
                            <!--enctype="multipart/form-data"-->
                            {!! Form::open(array('url' => 'queja-reclamo','files' => true, 'class' => 'cmxform form-horizontal', 'id' => 'quejaReclamoForm')) !!}

                            @include('queja-reclamo/form', ['button' => trans('ui.qr.button_add')])

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
    <script src="{{ asset('themes/admin/js/calidad.js') }}"></script>
@stop
