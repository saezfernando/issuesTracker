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
                        {{ trans('ui.user.names') }}
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        @if(Auth::user()->can('Gestionar Usuario'))
                        <a href="{{ url('auth/user/create') }}" data-toggle="tooltip" title="Nuevo Usuario!">
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
                    
                            @if(Auth::user()->can('Gestionar Usuario'))
                                
                                <button class="pdf btn btn-danger" type="button" onclick="exportar('Usuarios')"><i class="fa fa-file-pdf-o"></i> {{ trans("ui.enc.pdf") }}</button>
                                
                            @endif


                            <table  class="display table table-bordered table-striped" id="dynamic-table">
                                <thead>
                                <tr>
                                    <th>{{ trans('ui.user.nombreCompleto') }}</th>
                                    
                                    <th>{{ trans('ui.user.email') }}</th>
                                    <th>{{ trans('ui.user.area') }}</th>
                                    <th>{{ trans('ui.role.names') }}</th>
                                    @if(Auth::user()->can(['Gestionar Usuario']))
                                    <th>{{ trans('ui.user.operation_label') }}</th>
                                    @endif
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)

@if (!empty($user))
<!-- Modal -->
<div id="{{$user->id}}" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Nombre: {{ $user->apellido }},{{ $user->nombre }}</h4>
      </div>
      <div class="modal-body">
        
        <p>{{ trans("ui.user.email") }}:  <span class="text-info">{{ $user->email }}</span></p>
        <p>{{ trans("ui.user.dni") }}:  <span class="text-info">{{ $user->dni }}</span></p>
        <p>{{ trans("ui.user.telefono") }}:  <span class="text-info">{{ $user->telefono }}</span></p>
        @if(!empty($user->area))
        <p>{{ trans("ui.user.area") }}:  <span class="text-info">{{ $user->areaDescripcion->descripcion }}</span></p>
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
                                        <a data-toggle="modal" data-target="#{{$user->id}}">    
                                        {{ $user->apellido }}, {{ $user->nombre }}
                                        </a>
                                        </td>

                                        
                                        <td>{{ $user->email }}</td>
                                        <td>
                                        @if(!empty($user->area))
                                            {{ $user->areaDescripcion->descripcion }}
                                        @endif    
                                        </td>
                                        <td><ul>
                                                @foreach($user->roles as $role)
                                                <li>
                                                    {{ $role->name }}
                                                </li>
                                                @endforeach
                                            </ul></td>
                                        @if(Auth::user()->can(['Gestionar Usuario']))
                                        <td>
                                            
                                                @if(Auth::user()->can('Gestionar Usuario'))
                                            <a href="{{ url('auth/user/' . $user->id . '/edit') }}" data-toggle="tooltip" title="Editar Usuario!">
                                                <button class="btn btn-info " type="button"><i class="fa fa-edit"></i> {{-- trans('ui.user.button_update') --}}</button>
                                            </a>
                                                @endif

                                                    @if(Auth::user()->can('Gestionar Usuario'))
                                            {!! Form::open(['url' => 'auth/user/'. $user->id, 'method' => 'delete','style'=> 'display:inline;margin:0;padding:0']) !!}
                                            <button class="btn btn-danger " type="submit" data-toggle="tooltip" title="Eliminar Usuario!"><i class="fa fa-trash"></i> {{-- trans('ui.user.button_delete') --}}</button>
                                            {!! Form::close() !!}
                                                    @endif
                                            
                                        </td>
                                        @endif
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>{{ trans('ui.user.nombreCompleto') }}</th>
                                    
                                    <th>{{ trans('ui.user.email') }}</th>
                                    <th>{{ trans('ui.user.area') }}</th>
                                    <th>{{ trans('ui.role.names') }}</th>
                                    @if(Auth::user()->can(['Gestionar Usuario']))
                                        <th>{{ trans('ui.user.operation_label') }}</th>
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
    <script src="{{ asset('themes/admin/js/calidad.js') }}"></script>
    <!-- plugin autoTable para exportar a PDF-->     
     <script src="{{ asset('themes/admin/js/autotable/jspdf.min.js') }}"></script>
     <script src="{{ asset('themes/admin/js/autotable/jspdf.plugin.autotable.js') }}"></script>    

    <!--dynamic table initialization 
    <script src="{{ asset('themes/admin/js/dynamic_table_init.js') }}"></script>
    -->
      <script>

         $('#dynamic-table').dataTable( {

                "aaSorting": [[ 1, "asc" ]],
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