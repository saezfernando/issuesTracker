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
                        <div class="panel-heading">{{ trans('ui.comi.edit_comi') }}</div>
                        <div class="panel-body">
                            @include('errors.form_error')

                            {!! Form::model($comunicacionInterna, ['method' => 'PUT', 'files' => true, 'route' => ['comunicacion-interna.update', $comunicacionInterna->id], 'class' => 'cmxform form-horizontal', 'id' => 'userForm']) !!}
                            
                            <!-- pasa ci y tablas auxiliares -->
                            @include('comunicacion-interna.form', array('comunicacionInterna' => $comunicacionInterna) + compact('tipos'), ['button' => trans('ui.comi.button_update')])

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