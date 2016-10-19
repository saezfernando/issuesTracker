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
                        {{ trans('ui.proc.names') }}
            <span class="tools pull-right">
                <a href="javascript:;" class="fa fa-chevron-down"></a>
                <a href="javascript:;" class="fa fa-times"></a>
             </span>
                    </header>
                </div>    
                    @include('errors.form_error')
                    <div class="panel-body">
                        <div class="adv-table">
                            @if(Auth::user()->can('Crear Procedimientos Operativos'))
                            <a data-toggle="modal" data-target="#modal-nueva-version" onclick="setNuevaVersion();"><button class="btn btn-primary" type="button"><i class="fa fa-plus-circle"></i> {{ trans("ui.proc.actualizarVersion") }}</button></a>

                            <a data-toggle="modal" data-target="#modal-nueva-version" onclick="setNuevaRevision();"><button class="btn btn-primary" type="button"><i class="fa fa-plus-circle"></i> {{ trans("ui.proc.actualizarRevision") }}</button></a>
                            @endif
                            <span>
                                <img src="{{url('/themes/admin/icon/verde16.png')}}"> Validado
                                <img src="{{url('/themes/admin/icon/rojo16.png')}}">  Obsoleto
                                <img src="{{url('/themes/admin/icon/amarillo16.png')}}"> Borrador
                                <img src="{{url('/themes/admin/icon/azul16.png')}}"> En Revisión
                                  
                            </span>

                            <table  class="display table table-bordered table-striped" id="dynamic-table">
                                <thead>
                                <tr><th colspan="6"> Encabezado con todos los datos del procedimieto <th/></tr>
                                <tr>
                                    <th>{{ trans('ui.proc.version') }}</th>
                                    
                                    <th>{{ trans('ui.proc.documento') }}</th>
                                    <th>{{ trans('ui.proc.revisadoPor') }}</th>
                                    <th>{{ trans('ui.proc.modificaciones') }}</th>
                                    <th>{{ trans('ui.proc.estado') }}</th>
                                    <th>{{ trans('ui.proc.operaciones') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($procedimiento->versiones as $version)

@if (!empty($version))
<!-- Modal -->
<div id="{{$version->id}}" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"> Versión: {{ $version->version }}.{{ $version->revision }}</h4>
      </div>
      <div class="modal-body">
        <p>{{ trans("ui.proc.estado") }}: <span class="text-info"> {{ $version->estadoDescripcion->descripcion }}</span></p>
        <p>{{ trans("ui.proc.fechaRevision") }}:  <span class="text-info">{{ $version->fechaRevision}}</span></p>
        
        @if (!empty($version->revisadoPor))
        <p>{{ trans("ui.nc.revisadoPor") }}:  <span class="text-info">{{ $version->revisadoPorUser->apellido }}, {{ $version->revisadoPorUser->nombre }}</span></p>
        @endif
        
        <p>{{ trans("ui.proc.modificaciones") }}:  <span class="text-info">{{ $version->modificaciones }}</span></p>
        
        @if (!empty($version->validadoPor))
        <p>{{ trans("ui.proc.validadoPor") }}:  <span class="text-info">{{ $version->validadoPorUser->apellido }}, {{ $version->validadoPorUser->nombre }}</span></p>
        @endif
         
        @if (!empty($version->nombre_archivo_original)) 
            <a href="{{url('procedimiento-operativo/file') . '/' . $version->id }}">
            <i class="fa fa-file"></i>
        {{ $version->nombre_archivo_original }} @else {{ trans('ui.proc.sinadjunto') }} @endif
        </a>
       

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
 @endif

                                    <tr class="gradeX">

                                        <td>
                                        <a data-toggle="modal" data-target="#{{$version->id}}">
                                        {{ $version->version }}.{{ $version->revision }}
                                        </a>
                                        </td>
                                    
                                        <td>
                                           <a href="{{url('procedimiento-operativo/file') . '/' . $version->id }}">
                                            <img src="themes/admin/icon/word16.png">
                                            {{ $version->nombre_archivo_original }} 
                                            </a>
                                        </td>
                  
                                        <td>
                                        @if (!empty($version->revisadoPor))
                                        {{ $version->revisadoPorUser->apellido }}, {{ $version->revisadoPorUser->nombre }} 
                                        @endif

                                        </td>
                                        <td>{{ $version->modificaciones }}</td>
                                        
                                        <td>
                                        @if ( $version->estadoDescripcion->descripcion == 'Validado')
                                            <img src="{{url('/themes/admin/icon/verde32.png')}}">
                                        @endif
                                        @if ( $version->estadoDescripcion->descripcion == 'Obsoleto')
                                            <img src="{{url('/themes/admin/icon/rojo32.png')}}">
                                        @endif
                                        @if ( $version->estadoDescripcion->descripcion == 'Borrador')
                                            <img src="{{url('/themes/admin/icon/amarillo32.png')}}">
                                        @endif
                                        @if ( $version->estadoDescripcion->descripcion == 'Revisión')
                                            <img src="{{url('/themes/admin/icon/azul32.png')}}">
                                        @endif
                                        </td>

                                        <td>
                                            @if ( $version->estadoDescripcion->descripcion == 'Borrador')
                                            <a data-toggle="modal" data-target="#modal-actualizar" onclick="actualizar({{$version->id}});"><button class="btn btn-primary" type="button"><i class="fa fa-plus-circle"></i> {{ trans("ui.proc.button_update") }}</button></a>
        
                                            @endif
                                            @if ( $version->estadoDescripcion->descripcion == 'Revisión')
                                                @if(Auth::user()->can('Validar Procedimientos Operativos'))
                                                    <a data-toggle="modal" data-target="#modal-validar" onclick="validar({{$version->id}});">
                                                <button class="btn btn-info " type="button"><i class="fa fa-refresh"></i> {{ trans('ui.proc.button_validate') }}</button>
                                                @endif
                                            @endif
                                        </td>        
                                            
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>{{ trans('ui.proc.version') }}</th>
                                    <th>{{ trans('ui.proc.documento') }}</th>
                                    <th>{{ trans('ui.proc.revisadoPor') }}</th>
                                    <th>{{ trans('ui.proc.modificaciones') }}</th>
                                    <th>{{ trans('ui.proc.estado') }}</th>
                                    <th>{{ trans('ui.proc.operaciones') }}</th>

                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>


{{-- Nueva Versión o Revisión --}}
<div class="modal fade" id="modal-nueva-version">
  <div class="modal-dialog">
    <div class="modal-content">
        <form method="POST" action="{{url('/procedimiento-operativo-version')}}"
            class="form-horizontal" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="procedimiento" value="{{ $procedimiento->id }}">
        <input type="hidden" name="versionOld" value="{{ $procedimiento->ultimaVersion[0]->version}}">
        <input type="hidden" name="revisionOld" value="{{ $procedimiento->ultimaVersion[0]->revision}}">
        <input type="hidden" name="version">
        <input type="hidden" name="revision">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">
            ×
          </button>
          <h4 class="modal-title">Nueva Versión</h4>
        </div>
        <div class="modal-body">
          
          <div class="form-group">
            <label for="version" class="col-sm-3 control-label">
              Versión:
            </label>
            <div class="col-sm-8">
              <input type="text" id="versionfull" name="versionfull" disabled="disabled" value="{{ $procedimiento->version + 1 }}.1"
                     class="form-control"> 
             </div>
          </div>
          <div class="form-group">
            <label for="estado" class="col-sm-3 control-label">
              Estado:
            </label>
            <div class="col-sm-8">
              <input type="radio" id="estado" name="estado" value="3"
                     class="form-control"> Borrador 
              <input type="radio" id="estado" name="estado" value="2"
                     class="form-control"> Para Revisión 

            </div>
          </div>
          <div class="form-group">
            <label for="comentarios" class="col-sm-3 control-label">
              Modificaciones:
            </label>
            <div class="col-sm-8">
              <textarea id="modificaciones" name="modificaciones"
                     class="form-control">
              </textarea>       
            </div>
          </div>
          <div class="form-group">
            <label for="doc" class="col-sm-3 control-label">
              Adjunto:
            </label>
            <div class="col-sm-8">
              <input type="file" id="doc" name="doc"
                     class="form-control">
            </div>
          </div>

        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">
            Nueva Versión
          </button>
          <button type="button" class="btn btn-default btn-warning" data-dismiss="modal">
            Cancelar
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

{{-- Actualizar (Para Borradores) --}}
<div class="modal fade" id="modal-actualizar">
  <div class="modal-dialog">
    <div class="modal-content">
        <form method="POST" action="{{url('/procedimiento-operativo-version')}}"
            class="form-horizontal" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input name="_method" type="hidden" value="PUT">
        
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">
            ×
          </button>
          <h4 class="modal-title">Actualizar</h4>
        </div>
        <div class="modal-body">
          
          <div class="form-group">
            <label for="estado" class="col-sm-3 control-label">
              Estado:
            </label>
            <div class="col-sm-8">
              <input type="radio" id="estado" checked="true" name="estado" value="3"
                     class="form-control"> Borrador 
              <input type="radio" id="estado" name="estado" value="2"
                     class="form-control"> Para Revisión 

            </div>
          </div>
          <div class="form-group">
            <label for="comentarios" class="col-sm-3 control-label">
              Modificaciones:
            </label>
            <div class="col-sm-8">
              <textarea id="modificaciones" name="modificaciones"
                     class="form-control">
              </textarea>       
            </div>
          </div>
          <div class="form-group">
            <label for="doc" class="col-sm-3 control-label">
              Adjunto:
            </label>
            <div class="col-sm-8">
              <input type="file" id="doc" name="doc"
                     class="form-control">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">
            Actualizar
          </button>
          <button type="button" class="btn btn-default btn-warning" data-dismiss="modal">
            Cancelar
          </button>
        </div>
      </form>
    </div>
  </div>
</div>


{{-- Validar (Para Revisados) --}}
<div class="modal fade" id="modal-validar">
  <div class="modal-dialog">
    <div class="modal-content">
        <form method="POST" action="{{url('/procedimiento-operativo-version')}}"
            class="form-horizontal">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input name="_method" type="hidden" value="PUT">
        <input type="hidden" id="estado"  name="estado" value="Validado"> 
        
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">
            ×
          </button>
          <h4 class="modal-title">Validar</h4>
        </div>
        <div class="modal-body">
          
          <div class="form-group">
            <label for="estado" class="col-sm-3 control-label">
              Confirmar Validación
            </label>
          </div>
        
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">
            Validar
          </button>
          <button type="button" class="btn btn-default btn-warning" data-dismiss="modal">
            Cancelar
          </button>
        </div>
      </form>
    </div>
  </div>
</div>


@stop

@section('script')
            <!--dynamic table-->
    <script type="text/javascript" src="{{ asset('themes/admin/js/advanced-datatable/js/jquery.dataTables.js')}}"></script>
    <script type="text/javascript" src="{{ asset('themes/admin/js/data-tables/DT_bootstrap.js') }}"></script>
    <!--dynamic table initialization -->
    <script src="{{ asset('themes/admin/js/dynamic_table_init.js') }}"></script>

<script>
function setNuevaVersion()
{
    
    document.forms[0].version.value = parseInt(document.forms[0].versionOld.value) + 1;
    document.forms[0].revision.value = 1;
    document.forms[0].versionfull.value = document.forms[0].version.value + '.' + document.forms[0].revision.value ;
}

function setNuevaRevision()
{

     document.forms[0].version.value = document.forms[0].versionOld.value;
     document.forms[0].revision.value = parseInt(document.forms[0].revisionOld.value) + 1;
     document.forms[0].versionfull.value = document.forms[0].version.value + '.' + document.forms[0].revision.value ;
}

function actualizar(id)
{
 // alert(id);
     
     document.forms[1].action ='{{url('/procedimiento-operativo-version')}}' + '/' +id;
     
}

function validar(id)
{
 // alert(id);
     
     document.forms[2].action ='{{url('/procedimiento-operativo-version')}}' + '/' +id;
     
}

</script>
@stop

