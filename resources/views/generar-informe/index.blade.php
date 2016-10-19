@extends('layouts.master')

@section('style')
    <link href="{{ asset('themes/admin/js/advanced-datatable/css/demo_page.css') }}" rel="stylesheet" />
    <link href="{{ asset('themes/admin/js/advanced-datatable/css/demo_table.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('themes/admin/js/data-tables/DT_bootstrap.css') }}" />
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">

    <link href="{{ asset('themes/admin/css/grillafiltrada.css') }}" rel="stylesheet" />
    <link href="{{ asset('themes/admin/js/jquery-multi-select/css/multi-select.css') }}" rel="stylesheet" />
    
    <link href="{{ asset('themes/admin/js/tablefilter/filtergrid.css') }}" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdn.datatables.net/v/dt/dt-1.10.12/datatables.min.css">

        
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

                         Generador de Informes
                        
            <span class="tools pull-right">
                <a href="javascript:;" class="fa fa-chevron-down"></a>
                <a href="javascript:;" class="fa fa-times"></a>
             </span>
                    </header>
                </div>    
                    <div class="panel-body">

                            
                               
                                <label class="col-lg-3 col-sm-2 control-label" align="right"> Informe: </label>
                                <div class="col-lg-9" style="margin-bottom:10px">
                                                              
                                {!! Form::select('informe', $informes,isset($informe) ? $informe->id : null, ['class' => 'form-control','id'=>'informe','onchange' => 'preparar()']) !!}
                     
                                </div>
                                
                                                            
                                @if(!empty($campos))
                                    {!! Form::open(['url' => 'generador-informe/', 'method' => 'get','style'=>'margin:10px']) !!}
                                
                                <label class="col-lg-3 col-sm-2 control-label" align="right">Campos a agregar:  </label>
                                <div class="col-lg-6" style="margin-bottom:10px">
                               
                                 {!! Form::select('campos[]', $campos ,null, ['class' => 'multi-select','id'=>'informeSelect', 'multiple' => true]) !!}
                                 
                                </div>
                                {!! Form::close() !!}
                                

                                @if(Auth::user()->can('Leer Informe'))
                                    <button class="btn btn-info" type="button" onclick=filtrarInforme()><i class="fa fa-filter"></i> {{ trans("ui.ci.filtro") }}</button>
                                @endif 
                                
                                @if(Auth::user()->can('Leer Informe'))
                                    
                                    <button class="pdf btn btn-danger" type="button" onclick="exportarGenerador('{{$informe->descripcion}}')"><i class="fa fa-file-pdf-o"></i> {{ trans("ui.ci.pdf") }}</button>
                                    
                                @endif

                                @if(Auth::user()->can('Leer Informe'))
                                    <button class="excell btn btn-danger" type="button" onclick=exportarExcel()><i class="fa fa-file-excel-o"></i> {{ trans("ui.ci.xls") }}</button>
                                    <iframe id="txtArea1" style="display:none"></iframe>
                                @endif

                                @endif                            


                        <div class="adv-table">
                        
                            <table  class="display table table-bordered table-striped" id="dynamic-table">
                                <thead>
                                <tr>
                                @if(isset($campos))
                                @foreach($campos as $campo)
                                    <th>{{$campo}}</th>
                                @endforeach
                                @endif
                                </tr>
                                </thead>
                                <tbody>

                                    @if(isset($tablaDB))
                                    @foreach($tablaDB as $registro)    

                                    <tr class="gradeX">
                                       
                                        @foreach($campos as $campo)
                                            <td>{{ $registro->$campo}}   </td>
                                        @endforeach
                                        
                                    </tr>
                                    @endforeach
                                    @endif
                                
                                </tbody>
                                

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

<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.12/datatables.min.js"></script>

<script type="text/javascript" src="{{ asset('themes/admin/js/data-tables/DT_bootstrap.js') }}"></script>
    <!--dynamic table initialization 
    <script src="{{ asset('themes/admin/js/dynamic_table_init.js') }}"></script>
    -->
     <script>
         var table;

         $(document).ready(function() {
            table = $('#dynamic-table').DataTable( {
            "scrollY": "200px",
            "paging": false,
            "bFilter": false,
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
        });
            
            for ( var i=0 ; i<$('#dynamic-table thead th').length; i++ ) {
                table.column( i ).visible( false, false );
            }

        });

/*
     var tabledata = $('#dynamic-table').DataTable();
        {


                "aaSorting": [[ 1, "asc" ]],
                "aoColumns": [
                    { "sWidth": "33%" },
                    { "sWidth": "33%"},
                    { "sWidth": "34%", "sClass": "center", "bSortable": false },
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
        });

        */
         

        //, "sClass": "center"   centra el contenido de las celdas, no el encabezado
        //,  "bSortable": false  habilita o deshabilita el ordenado
        //"bLengthChange": false oculta la selecciion de cuantos registros por página quiero ver
        //"bFilter": false, oculta el buscador o filtro
    </script>


    <script src="{{ asset('themes/admin/js/jquery-multi-select/js/jquery.multi-select.js') }}"></script>
    <script src="{{ asset('themes/admin/js/multi-select-init.js') }}"></script>

    <!-- filtros de tablas-->
    <script src="{{ asset('themes/admin/js/tablefilter/tablefilter.js') }}"></script>
    <script src="{{ asset('themes/admin/js/calidad.js') }}"></script>

    <!-- plugin autoTable para exportar a PDF-->     
     <script src="{{ asset('themes/admin/js/autotable/jspdf.min.js') }}"></script>
     <script src="{{ asset('themes/admin/js/autotable/jspdf.plugin.autotable.js') }}"></script>    

     <script src="{{ asset('themes/admin/js/jquery.techbytarun.excelexportjs.js') }}"></script>
     
     

     <script>

        function preparar()
        {   
            location.replace('{{url('/generar-informe')}}' + '/' + document.getElementById('informe').options[document.getElementById('informe').selectedIndex].value);
            
        }
        function agregar(id){
                table.column(id).visible( true, true );

        }
        function ocultar(id){
                table.column(id).visible( false ,true );

        }
       
     </script>   

@stop