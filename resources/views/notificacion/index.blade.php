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
                        {{ trans('ui.notificacion.names') }}
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        @if(Auth::user()->can('Escribir Notificacion'))
                        <a href="{{ url('notificacion/create') }}" data-toggle="tooltip" title="Nueva Notificación!">
                        <i class="fa fa-plus-square fa-2x"></i></a>
                        @endif
            <span class="tools pull-right">
                <a href="javascript:;" class="fa fa-chevron-down"></a>
                <a href="javascript:;" class="fa fa-times"></a>
             </span>
                    </header>
                </div>    
                    <div class="panel-body">
                        <div class="adv-table">
                            
                            <table  class="display table table-bordered table-striped" id="dynamic-table">
                                <thead>
                                <tr>
                                    <th>{{ trans('ui.notificacion.emisor') }}</th>
                                    <th>{{ trans('ui.notificacion.fecha') }}</th>
                                    <th>{{ trans('ui.notificacion.body') }}</th>
                                    <th>{{ trans('ui.notificacion.read') }}</th>
                                    
                                    
                                    @if(Auth::user()->can(['Leer Notificación']))
                                    <th>{{ trans('ui.notificacion.operation_label') }}</th>
                                    @endif
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($notificaciones as $notificacion)

                                    <tr class="gradeX">
                                        <td>{{ $notificacion->emisor}}</td>
                                        <td>{{ $notificacion->created_at->format('d-m-Y') }}</td>
                                        <td>{{ $notificacion->body }}</td>
                                        <td>

                                        @if ($notificacion->read)
                                            si
                                        @else
                                            no
                                        @endif    
                                        </td>
                                        
                                        @if(Auth::user()->can(['Leer Notificación']))
                                        <td>
                                            {!! 
                                            Form::model($notificacion,['method' => 'put', 'route' => ['notificacion.update', $notificacion->id],'style' =>'display:inline']) 
                                            !!}    
                                            @if ($notificacion->read)
                                            
                                            <button class="btn btn-info " type="submit"><i class="fa fa-trash-o"></i>       <span>No Leido</span></button>
                                            {!! Form::hidden('read','0') !!}
                                            
                                            @else
                                            <button class="btn btn-danger " type="submit"><i class="fa fa-trash-o"></i>     <span>Leido</span></button>
                                            {!! Form::hidden('read','1') !!}
                                            
                                            @endif 
                                            {!! Form::close() !!}
                                            
                                        </td>
                                        @endif
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>{{ trans('ui.notificacion.emisor') }}</th>
                                    <th>{{ trans('ui.notificacion.fecha') }}</th>
                                    <th>{{ trans('ui.notificacion.body') }}</th>
                                    <th>{{ trans('ui.notificacion.read') }}</th>
                                    
                                    @if(Auth::user()->can(['Leer Notificación']))
                                        <th>{{ trans('ui.user.operation_label') }}</th>
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
    <!--dynamic table initialization 
    <script src="{{ asset('themes/admin/js/dynamic_table_init.js') }}"></script>
    -->
    <script>

         $('#dynamic-table').dataTable( {

                "aaSorting": [[ 4, "desc" ]],
                "aoColumns": [
                    { "sWidth": "20%" },
                    { "sWidth": "15%" , "sClass": "center"},
                    { "sWidth": "50%" },
                    { "sWidth": "5%" , "sClass": "center"},
                    { "sWidth": "10%", "sClass": "center", "bSortable": false },
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