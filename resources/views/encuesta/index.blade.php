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
                        {{ trans('ui.enc.names') }}
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        @if(Auth::user()->can('Escribir Encuesta'))
                        <a href="{{ url('encuesta/create') }}" data-toggle="tooltip" title="Agregar Encuesta!">
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
                            
                            @if(Auth::user()->can('Leer Encuesta'))
                                <button class="btn btn-info" type="button" onclick=filtrar()><i class="fa fa-filter"></i> {{ trans("ui.enc.filtro") }}</button>
                            @endif 
                            
                            @if(Auth::user()->can('Leer Encuesta'))
                                
                                <button class="pdf btn btn-danger" type="button" onclick="exportar('Propuesta de Mejora')"><i class="fa fa-file-pdf-o"></i> {{ trans("ui.enc.pdf") }}</button>
                                
                            @endif

                            @if(Auth::user()->can('Leer Encuesta'))
                                <button class="excell btn btn-danger" type="button" onclick=exportarExcel()><i class="fa fa-file-excel-o"></i> {{ trans("ui.enc.xls") }}</button>
                                <iframe id="txtArea1" style="display:none"></iframe>
                            @endif

                            @if(Auth::user()->can('Leer Encuesta'))
                                 <a href="{{ url('generar-informe') }}" data-toggle="tooltip" title="Generador de Informes">
                                 <button class="excell btn btn-danger" type="button">Generador Informes</button>
                                </a>
                                
                            @endif


                            <table  class="display table table-bordered table-striped" id="dynamic-table">
                                <thead>
                                <tr>
                                    <th>{{ trans('ui.enc.nombre') }}</th>
                                    <th>{{ trans('ui.enc.periodo') }}</th>
                                    <th>{{ trans('ui.enc.procedimiento') }}</th>
                                    <th>% Satisf.</th>
                                    <th>Trat. Desfavorable</th>
                                    <th>Encuesta</th>
                                    <th>Reporte</th>
                                    
                                    @if(Auth::user()->can(['Escribir Encuesta']))
                                    <th>{{ trans('ui.enc.operation_label') }}</th>
                                    @endif
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($encs as $enc)

@if (!empty($enc))
<!-- Modal -->
<div id="{{$enc->id}}" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"> Encuesta de Satisfacción: {{ $enc->nombre }}</h4>
      </div>
      <div class="modal-body">
         
        <p>{{ trans("ui.enc.periodo") }}: <span class="text-info"> {{ $enc->periodoFormateado()}}</span></p>
        
        @if(!empty($enc->procedimiento))
        <p>{{ trans("ui.enc.procedimiento") }}:  <span class="text-info">{{ $enc->procedimientoDescripcion->titulo }}</span></p>
        @endif
        
        <p>{{ trans("ui.enc.porcentajeSatisfaccion") }}:  <span class="text-info">{{ $enc->porcentajeSatisfaccion}}%</span></p>
        
        @if (!empty($enc->enlaceEncuesta)) 
        <p> Enlace a Encuesta: <a href="{{$enc->enlaceEncuesta}}">
            <i class="fa fa-file"></i>
        {{ $enc->enlaceEncuesta }} </a></p>
        @else <p>Encuesta sin enlace!!</p>
        @endif
            

        @if (!empty($enc->enlaceReporte)) 
        <p> Enlace a Reporte: <a href="{{$enc->enlaceReporte}}">
            <i class="fa fa-file"></i>
        {{ $enc->enlaceReporte }} </a></p>
        @else <p>Reporte sin enlace!!</p>
        @endif
        

        @if(!empty($enc->porcentaje))
        <p>{{ trans("ui.enc.porcentaje") }}:  <span class="text-info">{{ $enc->porcentaje}}%</span></p>
        @endif

        @if(!empty($enc->causa))
        <p>{{ trans("ui.enc.causa") }}:  <span class="text-info">{{ $enc->causa}}</span></p>
        @endif

        @if(!empty($enc->accionCorrectiva))
        <p>{{ trans("ui.enc.accionCorrectiva") }}:  <span class="text-info">{{ $enc->accionCorrectiva}}</span></p>
        @endif


        <p>{{ trans("ui.enc.tratamientoDesfavorable") }}:  <span class="text-info">
        @if($enc->tratamientoDesfavorable) Si
        @else No
        @endif</span></p>

                


        @if (!empty($enc->nombre_archivo_original)) 
            <a href="{{url('encuesta/file') . '/' . $enc->id }}">
            <i class="fa fa-file"></i>
        {{ $enc->nombre_archivo_original }} @else {{ trans('ui.enc.sinadjunto') }} 
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
                                    <!--    <a href="{{ url('capacitacion-interna/' . $enc->id . '/show') }}">
                                        {{ $enc->titulo }}
                                        </a>
                                    -->
                                        <a data-toggle="modal" data-target="#{{$enc->id}}">    
                                        {{ $enc->nombre }}
                                        </a>
                                        </td>
                                        <td>{{$enc->periodoFormateado()}}</td>
                                        
                                        <td>
                                        @if(!empty($enc->procedimiento))
                                        {{ $enc->procedimientoDescripcion->titulo }}
                                        @endif 
                                        </td>
                                        <td>{{ $enc->porcentajeSatisfaccion}}</td>
                                        <td>@if($enc->tratamientoDesfavorable) Si @else No @endif</td>
                                        <td> 
                                            @if (!empty($enc->enlaceEncuesta)) 
                                            <a href="{{$enc->enlaceEncuesta}}" target="_Blanck" data-toggle="tooltip" title="Encuesta">
                                                <button class="btn btn-info " type="button"><i class="fa fa-wpforms"></i></button>
                                            </a>
                                            @endif
                                        </td>
                                        <td> 
                                            @if (!empty($enc->enlaceReporte)) 
                                            <a href="{{$enc->enlaceReporte}}" target="_Blanck" data-toggle="tooltip" title="Reporte">
                                                <button class="btn btn-info " type="button"><i class="fa fa-pie-chart"></i></button>
                                            </a>
                                            @endif
                                        </td>          

                                        @if(Auth::user()->can(['Escribir Encuesta']))
                                        <td>
                                            
                                                @if(Auth::user()->can('Escribir Encuesta'))
                                            <a href="{{ url('encuesta/' . $enc->id . '/edit') }}" data-toggle="tooltip" title="Editar">
                                                <button class="btn btn-info " type="button"><i class="fa fa-edit"></i> {{-- trans('ui.enc.button_update') --}}</button>
                                            </a>
                                                @endif

                                            @if(Auth::user()->can('Escribir Encuesta'))
                                            {!! Form::open(['url' => 'encuesta/'. $enc->id, 'method' => 'delete','style'=> 'display:inline;margin:0;padding:0']) !!}
                                            <button class="btn btn-danger " type="submit" data-toggle="tooltip" title="Eliminar"><i class="fa fa-trash"></i> {{-- trans('ui.enc.button_delete') --}}</button>
                                            {!! Form::close() !!}
                                                    @endif


                                        </td>
                                        @endif
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>{{ trans('ui.enc.nombre') }}</th>
                                    <th>{{ trans('ui.enc.periodo') }}</th>
                                    <th>{{ trans('ui.enc.procedimiento') }}</th>
                                    <th>% Satisf.</th>
                                    <th>Trat. Desfavorable</th>
                                    <th>Encuesta</th>
                                    <th>Reporte</th>
                                    
                                    @if(Auth::user()->can(['Escribir Encuesta']))
                                    <th>{{ trans('ui.enc.operation_label') }}</th>
                                    @endif                                </tr>
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
                    { "sWidth": "31%" },
                    { "sWidth": "10%", "sClass": "center"},
                    { "sWidth": "29%"},
                    { "sWidth": "5%", "sClass": "center"},
                    { "sWidth": "8%", "sClass": "center"},
                    { "sWidth": "5%", "sClass": "center"},
                    { "sWidth": "5%", "sClass": "center"},
                    { "sWidth": "7%", "sClass": "center", "bSortable": false },
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
