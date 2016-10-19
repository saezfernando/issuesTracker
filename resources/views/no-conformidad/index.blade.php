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
                        {{ trans('ui.nc.names') }}
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        @if(Auth::user()->can('Escribir No Conformidad'))
                        <a href="{{ url('no-conformidad/create') }}" data-toggle="tooltip" title="Agregar No conformidad!">
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
                            
                            @if(Auth::user()->can('Leer No Conformidad'))
                                <button class="btn btn-info" type="button" onclick=filtrar()><i class="fa fa-filter"></i> {{ trans("ui.nc.filtro") }}</button>
                            @endif 
                            
                            @if(Auth::user()->can('Leer No Conformidad'))
                                
                                <button class="pdf btn btn-danger" type="button" onclick="exportar('Informe de Hallasgos - No Conformidades')"><i class="fa fa-file-pdf-o"></i> {{ trans("ui.nc.pdf") }}</button>
                                
                            @endif

                            @if(Auth::user()->can('Leer No Conformidad'))
                                <button class="excell btn btn-danger" type="button" onclick="exportarExcel()"><i class="fa fa-file-excel-o"></i> {{ trans("ui.nc.xls") }}</button>
                                <iframe id="txtArea1" style="display:none"></iframe>
                            @endif

                            @if(Auth::user()->can('Leer No Conformidad'))
                                 <a href="{{ url('generar-informe') }}" data-toggle="tooltip" title="Generador de Informes">
                                 <button class="excell btn btn-danger" type="button">Generador Informes</button>
                                </a>
                                
                            @endif

                            <table  class="display table table-bordered table-striped" id="dynamic-table">
                                <thead>
                                <tr>
                                    <th>{{ trans('ui.nc.procedimiento') }}</th>
                                    <th>{{ trans('ui.nc.requisitoIncumple') }}</th>
                                    <th>{{ trans('ui.nc.fechaIntervencion') }}</th>
                                    <th>{{ trans('ui.nc.estado') }}</th>
                                    <th>{{ trans('ui.nc.descripcion') }}</th>                                                                        
                                                    
                                    @if(Auth::user()->can(['Escribir No Conformidad']))
                                    <th>{{ trans('ui.nc.operation_label') }}</th>
                                    @endif
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($ncs as $nc)

@if (!empty($nc))
<!-- Modal -->
<div id="{{$nc->id}}" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Hallasgo - No conformidad: {{ $nc->procedimientoDescripcion->titulo }}</h4>
      </div>
      <div class="modal-body">
        @if(!empty($nc->requisitoIncumple))
        <p>{{ trans("ui.nc.requisitoIncumple") }}:  <span class="text-info">{{ $nc->requisitoIncumpleDescripcion->descripcion }}</span></p>
        @endif
        
        <p>{{ trans("ui.nc.categoria") }}:  <span class="text-info">{{ $nc->categoriaDescripcion->descripcion }}</span></p>
        <p>{{ trans("ui.nc.descripcion") }}:  <span class="text-info">{{ $nc->descripcion }}</span></p>

        <p>{{ trans("ui.nc.origen") }}:  <span class="text-info">{{ $nc->origenDescripcion->descripcion }}</span>
        @if($nc->origen==1)
        <span class="text-info">{{ $nc->informeAuditoriaDescripcion->tipoDescripcion->descripcion }} Nº {{ $nc->informeAuditoriaDescripcion->numero }}</span>
        @endif
        </p>

        <p>{{ trans("ui.nc.estado") }}:  <span class="text-info">{{ $nc->estadoDescripcion->descripcion }}</span></p>
        <p>{{ trans("ui.nc.fechaIntervencion") }}:  <span class="text-info">{{ $nc->fechaIntervencion }}</span></p>
        <p>{{ trans("ui.nc.correccion") }}:  <span class="text-info">{{ $nc->correccion }}</span></p>
        <p>{{ trans("ui.nc.fechaImplementacion") }}:  <span class="text-info">{{ $nc->fechaImplementacion }}</span></p>
        <p>{{ trans("ui.nc.accionCorrectiva") }}:  <span class="text-info">{{ $nc->accionCorrectiva }}</span></p>
        <p>{{ trans("ui.nc.fechaImplementacionAC") }}:  <span class="text-info">{{ $nc->fechaImplementacionAC }}</span></p>
        <p>{{ trans("ui.nc.fechaVerificacionAC") }}:  <span class="text-info">{{ $nc->fechaVerificacionAC }}</span></p>

        @if (!empty($nc->nombre_archivo_original)) 
            <a href="{{url('no-conformidad/file') . '/' . $nc->id }}">
            <i class="fa fa-file"></i>
        {{ $nc->nombre_archivo_original }} @else {{ trans('ui.nc.sinadjunto') }} @endif
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
                                    <!--    <a href="{{ url('capacitacion-interna/' . $nc->id . '/show') }}">
                                        {{ $nc->titulo }}
                                        </a>
                                    -->
                                        <a data-toggle="modal" data-target="#{{$nc->id}}">    
                                        {{ $nc->procedimientoDescripcion->titulo }}
                                        </a>
                                        </td>
                                      
                                        <td>{{ $nc->requisitoIncumpleDescripcion->descripcion}}</td>
                                        <td>{{ $nc->fechaIntervencion}}</td>
                                        <td>{{ $nc->estadoDescripcion->descripcion}}</td>
                                        <td>{{ $nc->descripcion}}</td>
                                                                          
                                        
                                        @if(Auth::user()->can(['Escribir No Conformidad']))
                                        <td>
                                            
                                                @if(Auth::user()->can('Escribir No Conformidad'))
                                            <a href="{{ url('no-conformidad/' . $nc->id . '/edit') }}">
                                                <button class="btn btn-info " type="button"><i class="fa fa-edit"></i> {{-- trans('ui.nc.button_update') --}}</button>
                                            </a>
                                                @endif

                                                    @if(Auth::user()->can('Escribir No Conformidad'))
                                            {!! Form::open(['url' => 'no-conformidad/'. $nc->id, 'method' => 'delete','style'=> 'display:inline;margin:0;padding:0']) !!}
                                            <button class="btn btn-danger " type="submit"><i class="fa fa-trash"></i> {{-- trans('ui.nc.button_delete') --}}</button>
                                            {!! Form::close() !!}
                                                    @endif
                                            
                                        </td>
                                        @endif
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>{{ trans('ui.nc.procedimiento') }}</th>
                                    <th>{{ trans('ui.nc.requisitoIncumple') }}</th>
                                    <th>{{ trans('ui.nc.fechaIntervencion') }}</th>
                                    <th>{{ trans('ui.nc.estado') }}</th>
                                    <th>{{ trans('ui.nc.descripcion') }}</th>                                    
                                    
                                    @if(Auth::user()->can(['Escribir No Conformidad']))
                                        <th>{{ trans('ui.nc.operation_label') }}</th>
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
                    { "sWidth": "13%" },
                    { "sWidth": "18%" },
                    { "sWidth": "13%" },
                    { "sWidth": "10%" },
                    { "sWidth": "38%"},
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