@extends('layouts.master')

@section('style')
    <link href="{{ asset('themes/admin/js/advanced-datatable/css/demo_page.css') }}" rel="stylesheet" />
    <link href="{{ asset('themes/admin/js/advanced-datatable/css/demo_table.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('themes/admin/js/data-tables/DT_bootstrap.css') }}" />
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
    <link href="{{ asset('themes/admin/js/tablefilter/filtergrid.css') }}" rel="stylesheet" />
    <link href="{{ asset('themes/admin/css/grillafiltrada.css') }}" rel="stylesheet" />

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
                        {{ trans('ui.pm.names') }}
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        @if(Auth::user()->can('Escribir Propuesta Mejora'))
                        <a href="{{ url('propuesta-mejora/create') }}" data-toggle="tooltip" title="Agregar Propuesta de Mejora!">
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
                            
                            @if(Auth::user()->can('Leer Propuesta Mejora'))
                                <button class="btn btn-info" type="button" onclick=filtrar()><i class="fa fa-filter"></i> {{ trans("ui.pm.filtro") }}</button>
                            @endif 
                            
                            @if(Auth::user()->can('Leer Propuesta Mejora'))
                                
                                <button class="pdf btn btn-danger" type="button" onclick="exportar('Propuesta de Mejora')"><i class="fa fa-file-pdf-o"></i> {{ trans("ui.pm.pdf") }}</button>
                                
                            @endif

                            @if(Auth::user()->can('Leer Propuesta Mejora'))
                                <button class="excell btn btn-danger" type="button" onclick=exportarExcel()><i class="fa fa-file-excel-o"></i> {{ trans("ui.pm.xls") }}</button>
                                <iframe id="txtArea1" style="display:none"></iframe>
                            @endif

                            @if(Auth::user()->can('Leer Propuesta Mejora'))
                                 <a href="{{ url('generar-informe') }}" data-toggle="tooltip" title="Generador de Informes">
                                 <button class="excell btn btn-danger" type="button">Generador Informes</button>
                                </a>
                                
                            @endif


                            <table  class="display table table-bordered table-striped" id="dynamic-table">
                                <thead>
                                <tr>
                                    <th>{{ trans('ui.pm.propuestaImplementar') }}</th>
                                    <th>{{ trans('ui.pm.fecha') }}</th>
                                    <th>{{ trans('ui.pm.estado') }}</th>
                                    <th>{{ trans('ui.pm.procedimientos') }}</th>
                                    
                                    @if(Auth::user()->can(['Escribir Propuesta Mejora']))
                                    <th>{{ trans('ui.pm.operation_label') }}</th>
                                    @endif
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($pms as $pm)

@if (!empty($pm))
<!-- Modal -->
<div id="{{$pm->id}}" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"> Propuesta de Mejora: {{ $pm->fecha }}</h4>
      </div>
      <div class="modal-body">
         
        <p>{{ trans("ui.ia.propuestaImplementar") }}: <span class="text-info"> {{ $pm->propuestaImplementar}}</span></p>
        
        
        <p>{{ trans("ui.pm.fecha") }}:  <span class="text-info">{{ $pm->fecha }}</span></p>
        
        <p>{{ trans("ui.pm.accionRealizada") }}:  <span class="text-info">{{ $pm->accionRealizada}}</span></p>
        
        <p>{{ trans("ui.pm.fechaImplementacionEstimada") }}:  <span class="text-info">{{ $pm->fechaImplementacionEstimada }}</span></p>
                

        @if ($pm->procedimientos->count() > 0)
        <p>Procedimientos: <ul>
        @foreach($pm->procedimientos as $procedimiento)
           <li>
           <span class="text-info"> {{ $procedimiento->procedimientoDescripcion->titulo }}</span>
           </li>
        @endforeach
        </ul></p>
        @endif


        @if (!empty($pm->nombre_archivo_original)) 
            <a href="{{url('informe-auditoria/file') . '/' . $pm->id }}">
            <i class="fa fa-file"></i>
        {{ $pm->nombre_archivo_original }} @else {{ trans('ui.ia.sinadjunto') }} 
        @endif
        </a>
       

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
 @endif


                                    <tr class="gradeX">
                                        <td>
                                    <!--    <a href="{{ url('capacitacion-interna/' . $pm->id . '/show') }}">
                                        {{ $pm->titulo }}
                                        </a>
                                    -->
                                        <a data-toggle="modal" data-target="#{{$pm->id}}">    
                                        {{ $pm->propuestaImplementar }}
                                        </a>
                                        </td>
                                        <td>{{ $pm->fecha}}</td>
                                        
                                        <td>
                                        @if(!empty($pm->estado))
                                        {{ $pm->estadoDescripcion->descripcion }}
                                        @endif 

                                        </td>
                                        <td><ul>
                                                @foreach($pm->procedimientos as $proc)
                                                <li>
                                                    {{ $proc->procedimientoDescripcion->titulo }}
                                                </li>
                                                @endforeach
                                            </ul>
                                        </td>


                                        @if(Auth::user()->can(['Escribir Propuesta Mejora']))
                                        <td>
                                            
                                                @if(Auth::user()->can('Escribir Propuesta Mejora'))
                                            <a href="{{ url('propuesta-mejora/' . $pm->id . '/edit') }}" data-toggle="tooltip" title="Editar">
                                                <button class="btn btn-info " type="button"><i class="fa fa-edit"></i> {{-- trans('ui.pm.button_update') --}}</button>
                                            </a>
                                                @endif

                                            @if(Auth::user()->can('Escribir Propuesta Mejora'))
                                            {!! Form::open(['url' => 'propuesta-mejora/'. $pm->id, 'method' => 'delete','style'=> 'display:inline;margin:0;padding:0']) !!}
                                            <button class="btn btn-danger " type="submit" data-toggle="tooltip" title="Eliminar"><i class="fa fa-trash"></i> {{-- trans('ui.pm.button_delete') --}}</button>
                                            {!! Form::close() !!}
                                                    @endif


                                        </td>
                                        @endif
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>{{ trans('ui.pm.propuestaImplementar') }}</th>
                                    <th>{{ trans('ui.pm.fecha') }}</th>
                                    <th>{{ trans('ui.pm.estado') }}</th>
                                    <th>{{ trans('ui.pm.procedimientos') }}</th>
                                    
                                    @if(Auth::user()->can(['Escribir Propuesta Mejora']))
                                    <th>{{ trans('ui.pm.operation_label') }}</th>
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

                "aaSorting": [[ 1, "asc" ]],
                "aoColumns": [
                    { "sWidth": "35%" },
                    { "sWidth": "10%", "sClass": "center"},
                    { "sWidth": "10%", "sClass": "center"},
                    { "sWidth": "35%"},
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


    <!-- filtros de tablas-->
    <script src="{{ asset('themes/admin/js/tablefilter/tablefilter.js') }}"></script>
    <script src="{{ asset('themes/admin/js/calidad.js') }}"></script>

    <!-- plugin autoTable para exportar a PDF-->     
     <script src="{{ asset('themes/admin/js/autotable/jspdf.min.js') }}"></script>
     <script src="{{ asset('themes/admin/js/autotable/jspdf.plugin.autotable.js') }}"></script>    

     <script src="{{ asset('themes/admin/js/jquery.techbytarun.excelexportjs.js') }}"></script>

@stop
