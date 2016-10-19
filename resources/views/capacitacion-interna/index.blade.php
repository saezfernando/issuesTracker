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

                         {{ trans('ui.ci.names') }}
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        @if(Auth::user()->can('Escribir Capacitación Interna'))
                        <a href="{{ url('capacitacion-interna/create') }}" data-toggle="tooltip" title="Agregar Capacitación Interna!">
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
                            
                            @if(Auth::user()->can('Leer Capacitación Interna'))
                                <button class="btn btn-info" type="button" onclick=filtrar()><i class="fa fa-filter"></i> {{ trans("ui.ci.filtro") }}</button>
                            @endif 
                            
                            @if(Auth::user()->can('Leer Capacitación Interna'))
                                
                                <button class="pdf btn btn-danger" type="button" onclick="exportar('Capacitaciones Internas')"><i class="fa fa-file-pdf-o"></i> {{ trans("ui.ci.pdf") }}</button>
                                
                            @endif

                            @if(Auth::user()->can('Leer Capacitación Interna'))
                                <button class="excell btn btn-danger" type="button" onclick=exportarExcel()><i class="fa fa-file-excel-o"></i> {{ trans("ui.ci.xls") }}</button>
                                <iframe id="txtArea1" style="display:none"></iframe>
                            @endif

                            @if(Auth::user()->can('Leer Capacitación Interna'))
                                 <a href="{{ url('generar-informe') }}" data-toggle="tooltip" title="Generador de Informes">
                                 <button class="excell btn btn-danger" type="button">Generador Informes</button>
                                </a>
                                
                            @endif


                            <table  class="display table table-bordered table-striped" id="dynamic-table">
                                <thead>
                                <tr>
                                    <th>{{ trans('ui.ci.titulo') }}</th>
                                    <th>{{ trans('ui.ci.tipo') }}</th>
                                    <th>{{ trans('ui.ci.objetivo') }}</th>
                                    <th>{{ trans('ui.ci.procedimiento') }}</th>
                                    <th>{{ trans('ui.ci.area') }}</th>
                                    <th>{{ trans('ui.ci.estado') }}</th>
                                    @if(Auth::user()->can(['Escribir Capacitación Interna']))
                                    <th>{{ trans('ui.ci.operation_label') }}</th>
                                    @endif
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($cis as $ci)

@if (!empty($ci))
<!-- Modal -->
<div id="{{$ci->id}}" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Capacitación Interna: {{ $ci->titulo }}</h4>
      </div>
      <div class="modal-body">
        @if(!empty($ci->tipo))
        <p>{{ trans("ui.ci.tipo") }}: <span class="text-info"> {{ $ci->tipoDescripcion->descripcion }}</span></p>
        @endif
        <p>{{ trans("ui.ci.objetivo") }}:  <span class="text-info">{{ $ci->objetivo }}</span></p>
        
        @if (!empty($ci->disertantes))
        <p>{{ trans("ui.ci.disertantes") }}:  <span class="text-info">{{ $ci->disertantes }}</span></p>
        @endif
        
        @if(!empty($ci->procedimiento))
        <p>{{ trans("ui.ci.procedimiento") }}:  <span class="text-info">{{ $ci->procedimientoDescripcion->titulo }}</span></p>
        @endif

        @if(!empty($ci->area))
        <p>{{ trans("ui.ci.area") }}:  <span class="text-info">{{ $ci->areaDescripcion->descripcion }}</span></p>
        @endif
        <p>{{ trans("ui.ci.fechaInicio") }}:  <span class="text-info">{{ $ci->fechaInicio }}</span></p>
        <p>{{ trans("ui.ci.fechaFin") }}:  <span class="text-info">{{ $ci->fechaFin }}</span></p>
        @if(!empty($ci->estado))
        <p>{{ trans("ui.ci.estado") }}:  <span class="text-info">{{ $ci->estadoDescripcion->descripcion }}</span></p>
        @endif

        @if (!empty($ci->observaciones))
        <p>{{ trans("ui.ci.observaciones") }}:  <span class="text-info">{{ $ci->observaciones }}</span></p>
        @endif

        @if(!empty($ci->metodoEvaluacion))
        <p>{{ trans("ui.ci.metodoEvaluacion") }}:  <span class="text-info">{{ $ci->metodoEvaluacionDescripcion->descripcion }}</span></p>
        @endif

        @if(!empty($ci->evaluacionCapacitacion))
        <p>{{ trans("ui.ci.evaluacionCapacitacion") }}:  <span class="text-info">
        {{ $ci->evaluacionCapacitacionDescripcion->descripcion }}
        </span></p>
        @endif

         
        @if (!empty($ci->nombre_archivo_original)) 
            <a href="{{url('capacitacion-interna/file') . '/' . $ci->id }}">
            <i class="fa fa-file"></i>
        {{ $ci->nombre_archivo_original }} @else {{ trans('ui.ci.sinadjunto') }} 
        </a>
        @endif
       

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
                                    <!--    <a href="{{ url('capacitacion-interna/' . $ci->id . '/show') }}">
                                        {{ $ci->titulo }}
                                        </a>
                                    -->
                                        <a data-toggle="modal" data-target="#{{$ci->id}}">    
                                        {{ $ci->titulo }}
                                        </a>


                                        </td>
                                        @if(!empty($ci->tipo))
                                        <td>{{ $ci->tipoDescripcion->descripcion}}</td>
                                        @endif

                                        <td>{{ $ci->objetivo }}</td>
                                        
                                        @if(!empty($ci->procedimiento))
                                        <td>{{ $ci->procedimientoDescripcion->titulo }}</td>
                                        @endif

                                        @if(!empty($ci->area))
                                        <td>{{ $ci->areaDescripcion->descripcion }}</td>
                                        @endif

                                        @if(!empty($ci->estado))
                                        <td>{{ $ci->estadoDescripcion->descripcion }}</td>
                                        @endif
                                        
                                        @if(Auth::user()->can(['Escribir Capacitación Interna']))
                                        <td>
                                            
                                                @if(Auth::user()->can('Escribir Capacitación Interna'))
                                            <a href="{{ url('capacitacion-interna/' . $ci->id . '/edit') }}">
                                                <button class="btn btn-info " type="button"><i class="fa fa-edit"></i> {{-- trans('ui.ci.button_update') --}}</button>
                                            </a>
                                                @endif

                                                @if(Auth::user()->can('Escribir Capacitación Interna'))
                                            {!! Form::open(['url' => 'capacitacion-interna/'. $ci->id, 'method' => 'delete','style'=> 'display:inline;margin:0;padding:0']) !!}
                                            <button class="btn btn-danger " type="submit"><i class="fa fa-trash"></i> {{-- trans('ui.ci.button_delete') --}}</button>
                                            {!! Form::close() !!}
                                                @endif
                                            
                                        </td>
                                        @endif
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>{{ trans('ui.ci.titulo') }}</th>
                                    <th>{{ trans('ui.ci.tipo') }}</th>
                                    <th>{{ trans('ui.ci.objetivo') }}</th>
                                    <th>{{ trans('ui.ci.procedimiento') }}</th>
                                    <th>{{ trans('ui.ci.area') }}</th>
                                    <th>{{ trans('ui.ci.estado') }}</th>
                                    @if(Auth::user()->can(['Escribir Capacitación Interna']))
                                        <th>{{ trans('ui.ci.operation_label') }}</th>
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
                    { "sWidth": "18%" },
                    { "sWidth": "18%"},
                    { "sWidth": "20%"},
                    { "sWidth": "20%"},
                    { "sWidth": "8%"},
                    { "sWidth": "8%"},
                    { "sWidth": "8%", "sClass": "center", "bSortable": false },
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