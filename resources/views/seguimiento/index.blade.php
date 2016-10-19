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
                        {{ trans('ui.seg.names') }}
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        @if(Auth::user()->can('Escribir Seguimiento'))
                        <a href="{{ url('seguimiento/create') }}" data-toggle="tooltip" title="Nuevo Seguimiento">
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
                            <label class="control-label"> Indicador: </label>
                            </span>
                            <span class="col-lg-4">
                            {!! Form::open(['url' => 'seguimiento/', 'method' => 'get']) !!}
                            {!! Form::select('indicador', $indicadores ,$idIndicador, ['class' => 'form-control','id'=>'indicador']) !!}
                            {!! Form::close() !!}
                            </span>
                                                                        

                            <table  class="display table table-bordered table-striped" id="dynamic-table">
                                <thead>
                                <tr>
                                    <th>{{ trans('ui.seg.indicador') }}</th>
                                    <th>{{ trans('ui.seg.fecha') }}</th>
                                    <th>{{ trans('ui.seg.valorIndicador') }}</th>
                                    <th>{{ trans('ui.seg.analisis') }}</th>
                                    <th>{{ trans('ui.seg.acciones') }}</th>
                                    <th>{{ trans('ui.seg.adjunto') }}</th>
                                    
                                    
                                    @if(Auth::user()->can(['Escribir Seguimiento']))
                                    <th>{{ trans('ui.in.operation_label') }}</th>
                                    @endif
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($seguimientos as $seguimiento)

                                    <tr class="gradeX">
                                        <td>{{ $seguimiento->indicadorDescripcion->titulo }}</td>
                                        <td>{{ $seguimiento->fecha }}</td>
                                        <td>{{ $seguimiento->valorIndicador }} </td>
                                        <td>{{ $seguimiento->analisis }}</td>
                                        <td>{{ $seguimiento->acciones}}</td>
                                        
                                        <td>
                                        @if (!empty($seguimiento->nombre_archivo_original)) 
                                        <a href="{{url('indicador/file') . '/' . $seguimiento->id }}">
                                        <i class="fa fa-file"></i>
                                        {{ $seguimiento->nombre_archivo_original }} 
                                        </a>
                                        @else {{ trans('ui.seg.sinadjunto') }} 
                                        @endif
                                        </td>    
                                        
                                        @if(Auth::user()->can(['Escribir Seguimiento']))
                                        <td>
                                            
                                                @if(Auth::user()->can('Escribir Seguimiento'))
                                            <a href="{{ url('seguimiento/' . $seguimiento->id . '/edit') }}" data-toggle="tooltip" title="Editar">
                                                <button class="btn btn-info " type="button"><i class="fa fa-edit"></i> {{-- trans('ui.seg.button_update') --}}</button>
                                            </a>
                                                @endif

                                                @if(Auth::user()->can('Escribir Seguimiento'))
                                            {!! Form::open(['url' => 'seguimiento/'. $seguimiento->id, 'method' => 'delete','style'=> 'display:inline;margin:0;padding:0']) !!}
                                            <button class="btn btn-danger " type="submit" data-toggle="tooltip" title="Eliminar"><i class="fa fa-trash"></i> {{-- trans('ui.seg.button_delete') --}}</button>
                                            {!! Form::close() !!}
                                                    @endif
                                            
                                        </td>
                                        @endif
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>{{ trans('ui.seg.indicador') }}</th>
                                    <th>{{ trans('ui.seg.fecha') }}</th>
                                    <th>{{ trans('ui.seg.valorIndicador') }}</th>
                                    <th>{{ trans('ui.seg.analisis') }}</th>
                                    <th>{{ trans('ui.seg.acciones') }}</th>
                                    <th>{{ trans('ui.seg.adjunto') }}</th>

                                    @if(Auth::user()->can(['Escribir Seguimiento']))
                                        <th>{{ trans('ui.seg.operation_label') }}</th>
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
                        { "sWidth": "18%"},
                        { "sWidth": "10%", "sClass": "center"},
                        { "sWidth": "6%", "sClass": "center"},
                        { "sWidth": "23%"},
                        { "sWidth": "23%"},
                        { "sWidth": "12%"},
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


    <script>
        jQuery(document).ready(function() {
                $('#indicador').change(function(){
                   location.href = '{{url('seguimiento/')}}' + '/' + $(this).val();
                });
            });     
    </script>
@stop