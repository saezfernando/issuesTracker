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
                        {{ trans('ui.qr.names') }}
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        @if(Auth::user()->can('Escribir Quejas y Reclamos'))
                        <a href="{{ url('queja-reclamo/create') }}" data-toggle="tooltip" title="Agregar Quejas y Reclamos!">
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

                            @if(Auth::user()->can('Leer Quejas y Reclamos'))
                                <button class="btn btn-info" type="button" onclick=filtrar()><i class="fa fa-filter"></i> {{ trans("ui.qr.filtro") }}</button>
                            @endif 
                            
                            @if(Auth::user()->can('Leer Quejas y Reclamos'))
                                
                                <button class="pdf btn btn-danger" type="button" onclick="exportar('Quejas y Reclamos')"><i class="fa fa-file-pdf-o"></i> {{ trans("ui.qr.pdf") }}</button>
                                
                            @endif

                            @if(Auth::user()->can('Leer Quejas y Reclamos'))
                                <button class="excell btn btn-danger" type="button" onclick=exportarExcel()><i class="fa fa-file-excel-o"></i> {{ trans("ui.qr.xls") }}</button>
                                <iframe id="txtArea1" style="display:none"></iframe>
                            @endif


                            <table  class="display table table-bordered table-striped" id="dynamic-table">
                                <thead>
                                <tr>
                                    <th>{{ trans('ui.qr.titulo') }}</th>
                                    <th>{{ trans('ui.qr.estado') }}</th>
                                    <th>{{ trans('ui.qr.fechaCreacion') }}</th>
                                    <th>{{ trans('ui.qr.descripcion') }}</th>
                                    
                                    @if(Auth::user()->can(['Escribir Quejas y Reclamos']))
                                    <th>{{ trans('ui.qr.operation_label') }}</th>
                                    @endif
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($qrs as $qr)

@if (!empty($qr))
<!-- Modal -->
<div id="{{$qr->id}}" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"> {{ $qr->titulo }}</h4>
      </div>
      <div class="modal-body">
        <p>{{ trans("ui.qr.titulo") }}: <span class="text-info"> {{ $qr->titulo }}</span></p>
        <p>{{ trans("ui.qr.estado") }}:  <span class="text-info">{{ $qr->estadoQRDescripcion->descripcion }}</span></p>
        <p>{{ trans("ui.qr.fechaCreacion") }}:  <span class="text-info">{{ $qr->fechaCreacion }}</span></p>
        <p>{{ trans("ui.qr.descripcion") }}:  <span class="text-info">{{ $qr->descripcion }}</span></p>
        <p>{{ trans("ui.qr.responsable") }}:  <span class="text-info">{{ $qr->responsableDescripcion->descripcion }}</span></p>
        <p>{{ trans("ui.qr.derivadoA") }}:  <span class="text-info">{{ $qr->derivadoA }}</span></p>
        <p>{{ trans("ui.qr.solicitante") }}:  <span class="text-info">{{ $qr->solicitante }}</span></p>
        <p>{{ trans("ui.qr.datosContacto") }}:  <span class="text-info">{{ $qr->datosContacto }}</span></p>
        <p>{{ trans("ui.qr.solucion") }}:  <span class="text-info">{{ $qr->solucion }}</span></p>
        <p>{{ trans("ui.qr.fechaImplementacion") }}:  <span class="text-info">{{ $qr->fechaImplementacion }}</span></p>
        <p>{{ trans("ui.qr.fechaCreacion") }}:  <span class="text-info">{{ $qr->fechaCreacion }}</span></p>
        <p>{{ trans("ui.qr.pnc") }}:  <span class="text-info">{{ $qr->pnc }}</span></p>
        <p>{{ trans("ui.qr.añoCreacion") }}:  <span class="text-info">{{ $qr->añoCreacion }}</span></p>
        <p>{{ trans("ui.qr.comentarios") }}:  <span class="text-info">{{ $qr->comentarios }}</span></p>

        @if (!empty($qr->nombre_archivo_original)) 
            <a href="{{url('queja-reclamo/file') . '/' . $qr->id }}">
            <i class="fa fa-file"></i>
        {{ $qr->nombre_archivo_original }} @else {{ trans('ui.qr.sinadjunto') }} 
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
                                    <!--    <a href="{{ url('queja-reclamo/' . $qr->id . '/show') }}">
                                        {{ $qr->titulo }}
                                        </a>
                                    -->
                                        <a data-toggle="modal" data-target="#{{$qr->id}}">    
                                        {{ $qr->titulo }}
                                        </a>
                                        </td>
                                        <td>{{ $qr->estadoQRDescripcion->descripcion}}</td>
                                        <td>{{ $qr->fechaCreacion}}</td>
                                        
                                        <td>{{ $qr->descripcion }}</td>
                                        
                                        
                                        @if(Auth::user()->can(['Escribir Quejas y Reclamos']))
                                        <td>
                                            
                                                @if(Auth::user()->can('Escribir Quejas y Reclamos'))
                                            <a href="{{ url('queja-reclamo/' . $qr->id . '/edit') }}">
                                                <button class="btn btn-info " type="button"><i class="fa fa-edit"></i> {{-- trans('ui.qr.button_update') --}}</button>
                                            </a>
                                                @endif

                                                    @if(Auth::user()->can('Escribir Quejas y Reclamos'))
                                            {!! Form::open(['url' => 'queja-reclamo/'. $qr->id, 'method' => 'delete','style'=> 'display:inline;margin:0;padding:0']) !!}
                                            <button class="btn btn-danger " type="submit"><i class="fa fa-trash"></i> {{-- trans('ui.qr.button_delete') --}}</button>
                                            {!! Form::close() !!}
                                                    @endif
                                            
                                        </td>
                                        @endif
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>{{ trans('ui.qr.titulo') }}</th>
                                    <th>{{ trans('ui.qr.estado') }}</th>
                                    <th>{{ trans('ui.qr.fechaCreacion') }}</th>
                                    <th>{{ trans('ui.qr.descripcion') }}</th>
                                    @if(Auth::user()->can(['Escribir Quejas y Reclamos']))
                                        <th>{{ trans('ui.qr.operation_label') }}</th>
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
                    { "sWidth": "15%"},
                    { "sWidth": "15%"},
                    { "sWidth": "10%"},
                    { "sWidth": "50%"},
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