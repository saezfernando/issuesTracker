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
                        {{ trans('ui.permission.names') }}
            <span class="tools pull-right">
                <a href="javascript:;" class="fa fa-chevron-down"></a>
                <a href="javascript:;" class="fa fa-times"></a>
             </span>
                    </header>
                </div>
                    <div class="panel-body">
                        <div class="adv-table">
                            @if(Auth::user()->can('Gestionar Permiso'))
                            <a href="{{ url('auth/permission/create') }}"><button class="btn btn-primary" type="button"><i class="fa fa-plus-circle"></i> {{ trans("ui.permission.button_add") }}</button></a>
                            @endif
                            <table  class="display table table-bordered table-striped" id="dynamic-table">
                                <thead>
                                <tr>
                                    <th>{{ trans('ui.permission.name') }}</th>
                                    <th>{{ trans('ui.permission.description') }}</th>
                                    @if(Auth::user()->can(['Gestionar Permiso']))
                                    <th>{{ trans('ui.permission.operation_label') }}</th>
                                    @endif
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($permissions as $permission)
                                    <tr class="gradeX">
                                        <td>{{ $permission->name }}</td>
                                        <td>{{ $permission->description }}</td>
                                        @if(Auth::user()->can(['Gestionar Permiso']))
                                        <td>
                                            @if(Auth::user()->can('Gestionar Permiso'))
                                            <a href="{{ url('auth/permission/' . $permission->id . '/edit') }}" data-toggle="tooltip" title="Editar Permiso!">
                                                <button class="btn btn-info " type="button"><i class="fa fa-edit"></i> {{-- trans('ui.user.button_update') --}}</button>
                                            </a>
                                                @endif

                                                    @if(Auth::user()->can('Gestionar Permiso'))
                                            {!! Form::open(['url' => 'auth/permission/'. $permission->id, 'method' => 'delete','style'=> 'display:inline;margin:0;padding:0']) !!}
                                            <button class="btn btn-danger " type="submit" data-toggle="tooltip" title="Eliminar Permiso!"><i class="fa fa-trash"></i> {{-- trans('ui.user.button_delete') --}}</button>
                                            {!! Form::close() !!}
                                                    @endif
                              
                                        </td>
                                        @endif
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>{{ trans('ui.permission.name_label') }}</th>
                                    <th>{{ trans('ui.permission.description') }}</th>
                                    @if(Auth::user()->can(['Gestionar Permiso']))
                                        <th>{{ trans('ui.permission.operation_label') }}</th>
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
    <script type="text/javascript" language="javascript" src="{{ asset('themes/admin/js/advanced-datatable/js/jquery.dataTables.js')}}"></script>
    <script type="text/javascript" src="{{ asset('themes/admin/js/data-tables/DT_bootstrap.js') }}"></script>
   <!--dynamic table initialization 
    <script src="{{ asset('themes/admin/js/dynamic_table_init.js') }}"></script>
    -->
<script>

         $('#dynamic-table').dataTable( {

                "aaSorting": [[ 1, "asc" ]],
                "aoColumns": [
                    { "sWidth": "25%" },
                    { "sWidth": "67%"},
                    { "sWidth": "8%", "sClass": "center", "bSortable": false }
                ],
                 "oLanguage": {
                     "oPaginate": {
                        "sNext": "Siguiente",
                        "sPrevious": "Anterior"
                    },
                      "sEmptyTable": "No existen datos disponibles",
                      "sSearch": "Filtrar:",
                      "sInfo": "Muestra _START_ de _END_ de un total de _TOTAL_ entradas",
                      "sLengthMenu": "Muestra _MENU_ registros por página",
                }
        } );

        //, "sClass": "center"   centra el contenido de las celdas, no el encabezado
        //,  "bSortable": false  habilita o deshabilita el ordenado
        //"bLengthChange": false oculta la selecciion de cuantos registros por página quiero ver
        //"bFilter": false, oculta el buscador o filtro
    </script>

@stop