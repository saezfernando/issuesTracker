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
                    {{ trans('ui.comi.names') }}
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        @if(Auth::user()->can('Escribir Comunicación Interna'))
                        <a href="{{ url('comunicacion-interna/create') }}" data-toggle="tooltip" title="Agregar Comunicación Interna!">
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
                            
                            @if(Auth::user()->can('Leer Comunicación Interna'))
                                <button class="btn btn-info" type="button" onclick=filtrar()><i class="fa fa-filter"></i> {{ trans("ui.comi.filtro") }}</button>
                            @endif 
                            
                            @if(Auth::user()->can('Leer Comunicación Interna'))
                                
                                <button class="pdf btn btn-danger" type="button" onclick="exportar('Comunicaciones Internas')"><i class="fa fa-file-pdf-o"></i> {{ trans("ui.comi.pdf") }}</button>
                                
                            @endif

                            @if(Auth::user()->can('Leer Comunicación Interna'))
                                <button class="excell btn btn-danger" type="button" onclick=exportarExcel()><i class="fa fa-file-excel-o"></i> {{ trans("ui.comi.xls") }}</button>
                                <iframe id="txtArea1" style="display:none"></iframe>
                            @endif


                            <table  class="display table table-bordered table-striped" id="dynamic-table">
                                <thead>
                                <tr>
                                    <th>{{ trans('ui.comi.comunicacion') }}</th>
                                    <th>{{ trans('ui.comi.tipo') }}</th>
                                    <th>{{ trans('ui.comi.fecha') }}</th>
                                    <th>{{ trans('ui.comi.dueño') }}</th>
                                    <th>{{ trans('ui.comi.contenido') }}</th>
                                    
                                    @if(Auth::user()->can(['Escribir Comunicación Interna']))
                                    <th>{{ trans('ui.comi.operation_label') }}</th>
                                    @endif
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($comis as $comi)

@if (!empty($comi))
<!-- Modal -->
<div id="{{$comi->id}}" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"> {{ $comi->comunicacion }}</h4>
      </div>
      <div class="modal-body">
        <p>{{ trans("ui.ci.tipo") }}: <span class="text-info"> {{ $comi->tipoDescripcion->descripcion }}</span></p>
        <p>{{ trans("ui.comi.fecha") }}:  <span class="text-info">{{ $comi->fecha }}</span></p>
        <p>{{ trans("ui.comi.dueño") }}:  <span class="text-info">{{ $comi->dueño }}</span></p>
        <p>{{ trans("ui.comi.contenido") }}:  <span class="text-info">{{ $comi->contenido}}</span></p>
                 
        @if (!empty($comi->nombre_archivo_original)) 
            <a href="{{url('comunicacion-interna/file') . '/' . $comi->id }}">
            <i class="fa fa-file"></i>
        {{ $comi->nombre_archivo_original }} @else {{ trans('ui.comi.sinadjunto') }} @endif
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
                                    <!--    <a href="{{ url('capacitacion-interna/' . $comi->id . '/show') }}">
                                        {{ $comi->titulo }}
                                        </a>
                                    -->
                                        <a data-toggle="modal" data-target="#{{$comi->id}}">    
                                        {{ $comi->comunicacion }}
                                        </a>


                                        </td>
                                        <td>{{ $comi->tipoDescripcion->descripcion}}</td>
                                        <td>{{ $comi->fecha }}</td>
                                        <td>{{ $comi->dueño }}</td>
                                        <td>{{ $comi->contenido }}</td>
                                        
                                        @if(Auth::user()->can(['Escribir Comunicación Interna']))
                                        <td>
                                            
                                                @if(Auth::user()->can('Escribir Comunicación Interna'))
                                            <a href="{{ url('comunicacion-interna/' . $comi->id . '/edit') }}">
                                                <button class="btn btn-info " type="button"><i class="fa fa-edit"></i> {{-- trans('ui.comi.button_update') --}}</button>
                                            </a>
                                                @endif

                                                    @if(Auth::user()->can('Escribir Comunicación Interna'))
                                            {!! Form::open(['url' => 'comunicacion-interna/'. $comi->id, 'method' => 'delete','style'=> 'display:inline;margin:0;padding:0']) !!}
                                            <button class="btn btn-danger " type="submit"><i class="fa fa-trash"></i> {{-- trans('ui.comi.button_delete') --}}</button>
                                            {!! Form::close() !!}
                                                    @endif
                                            
                                        </td>
                                        @endif
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>{{ trans('ui.comi.comunicacion') }}</th>
                                    <th>{{ trans('ui.comi.tipo') }}</th>
                                    <th>{{ trans('ui.comi.fecha') }}</th>
                                    <th>{{ trans('ui.comi.dueño') }}</th>
                                    <th>{{ trans('ui.comi.contenido') }}</th>
                                    
                                    @if(Auth::user()->can(['Escribir Comunicación Interna']))
                                        <th>{{ trans('ui.comi.operation_label') }}</th>
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
                    { "sWidth": "10%"},
                    { "sWidth": "10%"},
                    { "sWidth": "10%"},
                    { "sWidth": "42%"},
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