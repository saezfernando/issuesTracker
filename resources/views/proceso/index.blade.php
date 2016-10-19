@extends('layouts.master')

@section('style')
    <link href="{{ asset('themes/admin/js/advanced-datatable/css/demo_page.css') }}" rel="stylesheet" />
    <link href="{{ asset('themes/admin/js/advanced-datatable/css/demo_table.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('themes/admin/js/data-tables/DT_bootstrap.css') }}" />
    @stop

@section('content')

    <!--body wrapper start-->
    <div class="wrapper">
        @include('partials.message')
        <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                <div class="panel panel-default">
                    <header class="panel-heading">
                        {{ trans('ui.proceso.names') }}
            <span class="tools pull-right">
                <a href="javascript:;" class="fa fa-chevron-down"></a>
                <a href="javascript:;" class="fa fa-times"></a>
             </span>
                    </header>
                </div>    
                    <div class="panel-body">
                        <div class="adv-table">
                            @if(Auth::user()->can('Crear Proceso'))
                            <a href="{{ url('proceso/create') }}"><button class="btn btn-primary" type="button"><i class="fa fa-plus-circle"></i> {{ trans("ui.proceso.button_add") }}</button></a>
                            @endif
                            <table  class="display table table-bordered table-striped" id="dynamic-table">
                                <thead>
                                <tr>
                                    <th>{{ trans('ui.proceso.nombre') }}</th>
                                    <th>{{ trans('ui.proceso.body') }}</th>
                                    <th>{{ trans('ui.proceso.creador') }}</th>
                                    <th>{{ trans('ui.proceso.estado') }}</th>
                                    <td>{{ trans('ui.proceso.version') }}</td>
                                    <th>{{ trans('ui.proceso.doc') }}</th>
                                    @if(Auth::user()->can(['Actualizar Proceso', 'Borrar Proceso']))
                                    <th>{{ trans('ui.proceso.operation_label') }}</th>
                                    @endif
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($procesos as $proceso)

                                    <tr class="gradeX">
                                        <td>{{ $proceso->nombre }}</td>
                                        <td>{{ $proceso->body }}</td>
                                        <td>{{ $proceso->creador }}</td>
                                        <td>{{ $proceso->estado }}</td>

                                        <td>{
                                                @foreach($proceso->ultima_version as $version)
                                                
                                                    {{ $version->version }},
                                                
                                                
                                        </td>

                                        <td>
                                            <a href="{{url('proceso/file') . '/' . $version->id }}">
                                            <img src="themes/admin/icon/word16.png">
                                            {{ $version->nombre_archivo_original }}

                                                @endforeach
                                            </a>
                                        </td>
                                        @if(Auth::user()->can(['Actualizar Proceso', 'Borrar Proceso']))
                                        <td>
                                            <p>
                                                @if(Auth::user()->can('Actualizar Proceso'))
                                            <a href="{{ url('proceso/' . $proceso->id . '/edit') }}">
                                                <button class="btn btn-info " type="button"><i class="fa fa-refresh"></i> {{ trans('ui.proceso.button_update') }}</button>
                                            </a>
                                                @endif

                                                    @if(Auth::user()->can('Borrar Usuario'))
                                            {!! Form::open(['url' => 'proceso/'. $proceso->id, 'method' => 'delete']) !!}
                                            <button class="btn btn-danger " type="submit"><i class="fa fa-times-circle"></i> {{ trans('ui.proceso.button_delete') }}</button>
                                            {!! Form::close() !!}
                                                    @endif
                                            </p>
                                        </td>
                                        @endif
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>{{ trans('ui.proceso.nombre') }}</th>
                                    <th>{{ trans('ui.proceso.body') }}</th>
                                    <th>{{ trans('ui.proceso.creador') }}</th>
                                    <th>{{ trans('ui.proceso.estado') }}</th>
                                    <th>{{ trans('ui.proceso.doc') }}</th>
                                    <th>{{ trans('ui.proceso.version') }}</th>
                                    @if(Auth::user()->can(['Actualizar Proceso', 'Borrar Proceso']))
                                        <th>{{ trans('ui.proceso.operation_label') }}</th>
                                    @endif
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
@stop

@section('script')
            <!--dynamic table-->
    <script type="text/javascript" src="{{ asset('themes/admin/js/advanced-datatable/js/jquery.dataTables.js')}}"></script>
    <script type="text/javascript" src="{{ asset('themes/admin/js/data-tables/DT_bootstrap.js') }}"></script>
    <!--dynamic table initialization -->
    <script src="{{ asset('themes/admin/js/dynamic_table_init.js') }}"></script>
@stop