<!-- header section start-->
<div class="header-section">

    <!--toggle button start-->
    <a class="toggle-btn" data-toggle="tooltip" title="Expandir!"><i class="fa fa-arrows-h"></i></a>
    <!--toggle button end-->
    <a href="{{url('/agenda')}}" class="toggle-btn" data-toggle="tooltip" title="Agenda!"><i class="fa fa-calendar"></i></a>

    <a href="{{url('/procedimiento-operativo')}}" class="toggle-btn" data-toggle="tooltip" title="Procedimientos!"><i class="fa fa-institution"></i></a>

    <a href="{{url('/tablero')}}" class="toggle-btn" data-toggle="tooltip" title="Tablero!"><i class="fa fa-dashboard"></i></a>

    <!--notification menu start -->
    <div class="menu-right">
        <ul class="notification-menu">
            <li>
                <a class="btn btn-default dropdown-toggle" data-toggle="dropdown" href="{{ url('/notificacion') }}">
                   <i class="fa fa-bell fa-lg" aria-hidden="true"></i>
                    {{ trans('ui.notificacion.titulo',['numero'=>Auth::user()->notificaciones()->where("read",false)->count()]) }}
                    <i class="caret"></i>
                </a>
                 <ul class="dropdown-menu dropdown-menu-usermenu">
                
                @foreach (Auth::user()->notificaciones()->where("read",false)->get() as $notificacion)
                
                <li><a href="{{ url('/notificacion') }}/{{$notificacion->id}}">{{ $notificacion->body }}</a></li>
                
                @endforeach

                <li class="divider"></li>
                <li><a href="{{ url('/notificacion') }}">Administrar Notificaciones!!</a></li>
                </ul> 

            </li>

            <li>
                <a href="#" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                    <img src="{{url('/themes/admin/icon/user32.png')}}">
                    {{ Auth::user()->nombre.' ' .Auth::user()->apellido }}
                    <span class="caret"></span>
                </a>
                <ul class="dropdown-menu dropdown-menu-usermenu pull-right">
                    <li><a href="{{ url('auth/user/change-password') }}"><i class="fa fa-key"></i> <span>{{ trans('ui.header_top.change_password') }}</span></a></li>
                    <li><a href="{{ url('logout') }}"><i class="fa fa-sign-out"></i> {{ trans('ui.header_top.logout') }}</a></li>
                </ul>
            </li>
        </ul>
      </div>
</div>
<!-- header section end-->
