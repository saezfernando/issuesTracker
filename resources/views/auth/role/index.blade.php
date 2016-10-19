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
                        {{ trans('ui.role.names') }}
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        @if(Auth::user()->can('Gestionar Rol'))
                        <a href="{{ url('auth/role/create') }}" data-toggle="tooltip" title="Nuevo Rol!">
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
                            
                            <table  class="display table table-bordered table-striped" id="dynamic-table">
                                <thead>
                                <tr>
                                    <th>{{ trans('ui.role.name_label') }}</th>
                                    <th>{{ trans('ui.role.description') }}</th>
                                    <th>{{ trans('ui.permission.names') }}</th>
                                    @if(Auth::user()->can(['Gestionar Rol']))
                                    <th>{{ trans('ui.role.operation_label') }}</th>
                                    @endif
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($roles as $role)

@if (!empty($role))
<!-- Modal -->
<div id="{{$role->id}}" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Rol: {{ $role->name }}</h4>
      </div>
      <div class="modal-body">
        
        <ul>
           @foreach($role->permissions as $permission)
          <li>
           {{ $permission->name }}
          </li>
              @endforeach
        </ul>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
 @endif


                                    <tr class="gradeX">
                                        <td>{{ $role->name }}</td>
                                        <td>{{ $role->description }}</td>
                                        <td>
                                            @if($role->permissions->count() > 5)
                                            <a data-toggle="modal" data-target="#{{$role->id}}"> Ver todos los Permisos </a>
                                            @else
                                            <ul>
                                                @foreach($role->permissions as $permission)
                                                <li>
                                                    {{ $permission->name }}
                                                </li>
                                                @endforeach
                                            </ul>
                                            @endif
                                        </td>
                                        @if(Auth::user()->can(['Gestionar Rol']))
                                        <td>
                                         
                                                @if(Auth::user()->can('Gestionar Rol'))
                                            <a href="{{ url('auth/role/' . $role->id . '/edit') }}" data-toggle="tooltip" title="Editar">
                                                <button class="btn btn-info " type="button"><i class="fa fa-edit"></i> {{-- trans('ui.role.button_update') --}}</button>
                                            </a>
                                                @endif

                                                    @if(Auth::user()->can('Gestionar Rol'))
                                            {!! Form::open(['url' => 'auth/role/'. $role->id, 'method' => 'delete','style'=> 'display:inline;margin:0;padding:0']) !!}
                                            <button class="btn btn-danger " type="submit" data-toggle="tooltip" title="Eliminar"><i class="fa fa-trash"></i> {{-- trans('ui.role.button_delete') --}}</button>
                                            {!! Form::close() !!}
                                                    @endif
                                            
                                            <a href="{{ url('auth/userxrol/' . $role->id) }}" data-toggle="tooltip" title="Ver Usuarios!">
                                                <button class="btn btn-info " type="button"><i class="fa fa-user"></i> {{-- trans('ui.user.verUsuarios') --}}</button>
                                            </a>

                                        </td>
                                        @endif
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>{{ trans('ui.role.name_label') }}</th>
                                    <th>{{ trans('ui.role.description') }}</th>
                                    <th>{{ trans('ui.permission.names') }}</th>
                                    @if(Auth::user()->can(['Gestionar Rol']))
                                        <th>{{ trans('ui.role.operation_label') }}</th>
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