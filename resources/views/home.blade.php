@extends('layouts.master') @section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Home</div>
                <div class="panel-body">
                    @include('partials.message')
                    <!-- /.row -->
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-lg-3 col-md-6">
                                <div class="panel panel-primary">
                                    <div class="panel-heading">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <i class="fa fa-comments fa-5x"></i>
                                            </div>
                                            <div class="col-xs-9 text-right">
                                                <div class="huge">26</div>
                                                <div>Notificaciones!</div>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="#">
                                        <div class="panel-footer">
                                            <span class="pull-left">View Details</span>
                                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                            <div class="clearfix"></div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <!--
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-group panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-tasks fa-3x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">12</div>
                                    <div>Procedimientos!</div>
                                </div>
                            </div>
                        </div>



  <div class="panel panel-default"> 
    <div class="panel-footer">
        <span class="pull-left"><a data-toggle="collapse" href="#collapse1">Ver Procedimientos</a> </span>
        <span class="pull-riht"><i class="fa fa-arrow-circle-right"></i> </span>
        <div class="clearfix"></div>
    </div>

    <div id="collapse1" class="panel-collapse collapse">
      <ul class="list-group">
            <li><a href="{{ url('procedimiento1') }}"> <span>procedimiento 1</span></a></li>
            <li><a href="{{ url('auth/role') }}"> <span>{{ trans('ui.sidebar.roles') }}</span></a></li>
            <li><a href="{{ url('auth/permission') }}"><span>{{ trans('ui.sidebar.permissions') }}</span></a></li>
      </ul>
      
    </div>
  

</div> 
</div>
</div>

-->
                            <div class="col-lg-3 col-md-6">
                                <div class="panel panel-green">
                                    <div class="panel-heading">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <i class="fa fa-tasks fa-3x"></i>
                                            </div>
                                            <div class="col-xs-9 text-right">
                                                <div class="huge">12</div>
                                                <div>Certificados IQNet/IRAM</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel-footer">
                                        <span class="pull-left"><a data-toggle="collapse" href="#collapse1">Ver Documentos</a> </span>
                                        <span class="pull-riht"><i class="fa fa-arrow-circle-right"></i> </span>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div id="collapse1" class="collapse">
                                        <ul class="list-group">
                                        {{--
                                            @foreach(\Documento::getDocumentosPorDirectorio('IQnet-IRAM') as $documento)
                                                <li class="list-group-item">
                                                    <a href="{{ url('\files\IQNet-IRAM\'.$documento) }}"> <span>$documento</span></a>
                                                </li>
                                            @endforeach
                                           --}}
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="panel panel-yellow">
                                    <div class="panel-heading">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <i class="fa fa-shopping-cart fa-5x"></i>
                                            </div>
                                            <div class="col-xs-9 text-right">
                                                <div class="huge">124</div>
                                                <div>Indicadores!</div>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="#">
                                        <div class="panel-footer">
                                            <span class="pull-left">View Details</span>
                                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                            <div class="clearfix"></div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="panel panel-red">
                                    <div class="panel-heading">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <i class="fa fa-tasks fa-5x"></i>
                                            </div>
                                            <div class="col-xs-9 text-right">
                                                <div class="huge">13</div>
                                                <div>Seguimientos</div>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="#">
                                        <div class="panel-footer">
                                            <span class="pull-left">View Details</span>
                                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                            <div class="clearfix"></div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!-- /.row -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
