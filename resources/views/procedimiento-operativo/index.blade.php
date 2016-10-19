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
                         
                        {{ trans('ui.proc.names') }}
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        @if(Auth::user()->can('Escribir Procedimientos Operativos'))
                        <a href="{{ url('procedimiento-operativo/create') }}" data-toggle="tooltip" title="Agregar Procedimiento!">
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
                                    <th>{{ trans('ui.proc.codigo') }}</th>
                                    <th>{{ trans('ui.proc.titulo') }}</th>
                                
                                    <th>{{ trans('ui.proc.fechaEmision') }}</th>
                                    <th>{{ trans('ui.proc.documento') }}</th>
                                    <th>{{ trans('ui.proc.estado') }}</th>
                                    <th>{{ trans('ui.proc.version') }}</th>
                                    
                                    
                                    
                                    @if(Auth::user()->can(['Escribir Procedimientos Operativos', 'Borrar Procedimientos Operativos']))
                                    <th>{{ trans('ui.proc.operation_label') }}</th>
                                    @endif
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($procedimientos as $procedimiento)

                                    <tr class="gradeX">
                                        <td>{{ $procedimiento->codigo }}</td>
                                        <td>{{ $procedimiento->titulo }}</td>
                                
                                        <td>{{ $procedimiento->fechaEmision }}</td>
                                        
                                        
                                        <td><a href="{{url('procedimiento-operativo/file') . '/' . $procedimiento->id }}">
                                            {{ $procedimiento->nombre_archivo_original }} 
                                            </a>
                                        </td>

                                        <td>
                                        @if ( $procedimiento->estado == 1)
                                            <img src="{{url('/themes/admin/icon/verde16.png')}}"> Validado
                                        @endif
                                        @if ( $procedimiento->estado == 4)
                                            <img src="{{url('/themes/admin/icon/rojo16.png')}}"> Obsoleto
                                        @endif
                                        @if ( $procedimiento->estado == 3)
                                            <img src="{{url('/themes/admin/icon/amarillo16.png')}}"> Borrador
                                        @endif
                                        @if ( $procedimiento->estado == 2 )
                                            <img src="{{url('/themes/admin/icon/azul16.png')}}"> Revisión
                                        @endif
                                        </td>

                                        <td>  {{ $procedimiento->version }}. {{ $procedimiento->revision }} </td>
                                         
                                        @if(Auth::user()->can(['Escribir Procedimientos Operativos', 'Borrar Procedimientos Operativos']))
                                        <td>
                                            
                                                @if(Auth::user()->can('Escribir Procedimientos Operativos'))
                                            <a href="{{ url('procedimiento-operativo/' . $procedimiento->id . '/edit') }}" data-toggle="tooltip" title="Editar Procedimiento!">
                                                <button class="btn btn-info " type="button"><i class="fa fa-edit"></i> {{-- trans('ui.proc.button_update')--}}</button>
                                            </a>
                                                @endif

                                                @if(Auth::user()->can('Leer Procedimientos Operativos'))
                                            <a href="{{ url('procedimiento-operativo-version/' . $procedimiento->id) }}" data-toggle="tooltip" title="Historial de Versiones!">
                                                <button class="btn btn-info " type="button"><i class="fa fa-copy"></i> {{-- trans('ui.proc.versiones') --}}</button>
                                            </a>
                                                @endif
                                                
                                                @if(Auth::user()->can('Leer Procedimientos Operativos'))
                                            <a href="{{ url('indicador/' . $procedimiento->id) }}" data-toggle="tooltip" title="Indicadores!">
                                                <button class="btn btn-info " type="button"><i class="fa fa-line-chart"></i> {{-- trans('ui.proc.indicadores') --}}</button>
                                            </a>
                                                @endif

                                                @if(Auth::user()->can('Borrar Procedimientos Operativos'))
                                            {!! Form::open(['url' => 'procedimiento-operativo/'. $procedimiento->id, 'method' => 'delete','style'=> 'display:inline;margin:0;padding:0']) !!}
                                            <button class="btn btn-danger " style="display:inline" type="submit" data-toggle="tooltip" title="Borrar Procedimiento!"><i class="fa fa-trash"></i> {{-- trans('ui.proc.button_delete') --}}</button>
                                            {!! Form::close() !!}
                                                    @endif
                                            
                                        </td>
                                        @endif
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>{{ trans('ui.proc.codigo') }}</th>
                                    <th>{{ trans('ui.proc.titulo') }}</th>
     
                                    <th>{{ trans('ui.proc.fechaEmision') }}</th>
                                    <th>{{ trans('ui.proc.documento') }}</th>
                                    <th>{{ trans('ui.proc.estado') }}</th>
                                    <th>{{ trans('ui.proc.version') }}</th>
                                    

                                    @if(Auth::user()->can(['Escribir Procedimientos Operativos', 'Borrar Procedimientos Operativos']))
                                        <th>{{ trans('ui.proc.operation_label') }}</th>
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

                "aaSorting": [[ 2, "desc" ]],
                "aoColumns": [
                    { "sWidth": "7%" },
                    { "sWidth": "24%"},
                    { "sWidth": "10%", "sClass": "center"},
                    { "sWidth": "24%"},
                    { "sWidth": "10%"},
                    { "sWidth": "7%", "sClass": "center"},
                    { "sWidth": "18%", "sClass": "center", "bSortable": false },
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