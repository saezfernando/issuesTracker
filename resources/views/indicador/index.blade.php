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
                        {{ trans('ui.in.names') }}
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        @if(Auth::user()->can('Escribir Indicador'))
                        <a href="{{ url('indicador/create') }}" data-toggle="tooltip" title="Nuevo Indicador!">
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
                            <span class="col-lg-2">
                            <label class="control-label"> Procedimiento: </label>
                            </span>
                            <span class="col-lg-4">
                            
                            {!! Form::open(['url' => 'indicador/', 'method' => 'get']) !!}
                            {!! Form::select('procedimiento', $procedimientosValidados ,$idProc, ['class' => 'form-control','id'=>'procedimiento']) !!}
                            {!! Form::close() !!}
                            </span>
 
                            <table  class="display table table-bordered table-striped" id="dynamic-table">
                                <thead>
                                <tr>
                                    <th>{{ trans('ui.in.titulo') }}</th>
                                    <th>{{ trans('ui.in.procedimiento') }}</th>
                                    <th>{{ trans('ui.in.actividad') }}</th>
                                    <th>{{ trans('ui.in.objetivo') }}</th>
                                    
                                    
                                    @if(Auth::user()->can(['Escribir Indicador']))
                                    <th>{{ trans('ui.in.operation_label') }}</th>
                                    @endif
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($indicadores as $indicador)

@if (!empty($indicador))
<!-- Modal -->
<div id="{{$indicador->id}}" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"> Indicador: {{ $indicador->titulo }}</h4>
      </div>
      <div class="modal-body">
           
        @if (!empty($indicador->procedimiento))
        <p>{{ trans("ui.in.procedimiento") }}:  <span class="text-info">{{ $indicador->procedimientoDescripcion->titulo }}</span></p>
        @endif
        
        <p>{{ trans("ui.in.actividad") }}:  <span class="text-info">{{ $indicador->actividad}}</span></p>
        <p>{{ trans("ui.in.objetivo") }}:  <span class="text-info">{{ $indicador->objetivo }}</span></p>
        
        @if (!empty($indicador->responsable))
        <p>{{ trans("ui.in.responsable") }}:  <span class="text-info">{{ $indicador->responsableUser->apellido }}, {{ $indicador->responsableUser->nombre }}</span></p>
        @endif
        
        <p>{{ trans("ui.in.fecha") }}:  <span class="text-info">{{ $indicador->fecha}}</span></p>
        <p>{{ trans("ui.in.resultadosObtenidos") }}:  <span class="text-info">{{ $indicador->resultadosObtenidos}}</span></p>
        <p>{{ trans("ui.in.observaciones") }}:  <span class="text-info">{{ $indicador->observaciones}}</span></p>
        <p>{{ trans("ui.in.observacionesDireccion") }}:  <span class="text-info">{{ $indicador->observacionesDireccion}}</span></p>

        <p>{{ trans("ui.in.frecuencia") }}:  <span class="text-info">{{ $indicador->frecuencia}}</span></p>
        <p>{{ trans("ui.in.meta") }}:  <span class="text-info">{{ $indicador->meta}}</span></p>
        <p>{{ trans("ui.in.formula") }}:  <span class="text-info">{{ $indicador->formula}}</span></p>
        <p>{{ trans("ui.in.medida") }}:  <span class="text-info">{{ $indicador->medida}}</span></p>
        <p>{{ trans("ui.in.fuenteInformacion") }}:  <span class="text-info">{{ $indicador->fuenteInformacion}}</span></p>
        <p>{{ trans("ui.in.enlaceEncuesta") }}:  <span class="text-info">{{ $indicador->enlaceEncuesta}}</span></p>

        @if (!empty($indicador->validadoPor))
        <p>{{ trans("ui.in.validadoPor") }}:  <span class="text-info">{{ $indicador->validadoPorUser->apellido }}, {{ $indicador->validadoPorUser->nombre }}</span></p>
        @endif
         
        @if (!empty($indicador->nombre_archivo_original)) 
            <a href="{{url('indicador/file') . '/' . $indicador->id }}">
            <i class="fa fa-file"></i>
        {{ $indicador->nombre_archivo_original }}
        </a>
        @else {{ trans('ui.in.sinadjunto') }}
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
                                        <a data-toggle="modal" data-target="#{{$indicador->id}}">
                                        {{ $indicador->titulo }}
                                        </a>
                                        </td>
                                        <td>{{ $indicador->procedimientoDescripcion->titulo }}</td>
                                        <td>{{ $indicador->actividad }}</td>
                                        <td>{{ $indicador->objetivo}}</td>

                                        
                                        @if(Auth::user()->can(['Escribir Indicador']))
                                        <td>
                                            
                                                @if(Auth::user()->can('Escribir Indicador'))
                                            <a href="{{ url('indicador/' . $indicador->id . '/edit') }}" data-toggle="tooltip" title="Editar!">
                                                <button class="btn btn-info " type="button"><i class="fa fa-edit"></i> {{-- trans('ui.in.button_update') --}}</button>
                                            </a>
                                                @endif

                                                @if(Auth::user()->can('Leer Seguimiento'))
                                            <a href="{{ url('seguimiento/' . $indicador->id) }}" data-toggle="tooltip" title="Seguimiento!">
                                                <button class="btn btn-info " type="button"><i class="fa fa-forward"></i> {{-- trans('ui.in.seguimiento') --}}</button>
                                            </a>
                                                @endif

                                                @if(Auth::user()->can('Leer Indicador'))
                                            <a href="{{ url('grafico-indicador/' . $indicador->id) }}" data-toggle="tooltip" title="Gráfico de Seguimiento!">
                                                <button class="btn btn-info " type="button"><i class="fa fa-bar-chart"></i> {{-- trans('ui.in.grafico') --}}</button>
                                            </a>
                                                @endif

                                                @if(Auth::user()->can('Escribir Indicador'))
                                            {!! Form::open(['url' => 'indicador/'. $indicador->id, 'method' => 'delete','style'=> 'display:inline;margin:0;padding:0']) !!}
                                            <button class="btn btn-danger " type="submit" data-toggle="tooltip" title="Borrar!"><i class="fa fa-trash"></i> {{-- trans('ui.in.button_delete') --}}</button>
                                            {!! Form::close() !!}
                                                    @endif
                                            
                                        </td>
                                        @endif
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>{{ trans('ui.in.titulo') }}</th>
                                    <th>{{ trans('ui.in.procedimiento') }}</th>
                                    <th>{{ trans('ui.in.actividad') }}</th>
                                    <th>{{ trans('ui.in.objetivo') }}</th>

                                    @if(Auth::user()->can(['Escribir Indicador']))
                                        <th>{{ trans('ui.in.operation_label') }}</th>
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
                    { "sWidth": "16%" },
                    { "sWidth": "16%"},
                    { "sWidth": "25%"},
                    { "sWidth": "25%"},
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

    <script>
        jQuery(document).ready(function() {
                $('#procedimiento').change(function(){
                   location.href = '{{url('indicador/')}}' + '/' + $(this).val();
                });
            });     
    </script>
@stop