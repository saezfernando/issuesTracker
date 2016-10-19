<!-- left side start-->
<div class="left-side sticky-left-side">

    <!--logo and iconic logo start
    <div class="logo">
        <a><img src="{{ asset('themes/admin/images/logo.png')  }}" alt=""></a>
    </div>
    -->

    <div class="left-side-inner">

        <!--sidebar nav start-->
        <ul class="nav nav-pills nav-stacked custom-nav">
            @if(Auth::check())
            <li class="active"><a href="{{ url('/home') }}"><i class="fa fa-home"></i> <span>{{ trans('ui.sidebar.dashboard') }}</span></a></li>
            @endif

            @if(Auth::user()->can('Gestionar Usuario'))
            <li class="menu-list"><a href=""><i class="fa fa-user"></i> <span>{{ trans('ui.sidebar.admin_users') }}</span></a>
                    <ul class="sub-menu-list">
                        <li><a href="{{ url('auth/user') }}"> <i class="fa fa-male"></i><span>{{ trans('ui.sidebar.users') }}</span></a></li>
                        <li><a href="{{ url('auth/role') }}"> <i class="fa fa-legal"></i><span>{{ trans('ui.sidebar.roles') }}</span></a></li>
                        <li><a href="{{ url('auth/permission') }}"><i class="fa fa-key"></i> <span>{{ trans('ui.sidebar.permissions') }}</span></a></li>
                    </ul>
            </li>    
            <li class="menu-list"><a href="{{ url('/laravel-filemanager') }}"><i class="fa fa-file"></i> <span>{{ trans('ui.sidebar.filemanager') }}</span></a>
            </li>    
            @endif

            @if(Auth::user()->can(['Leer Procedimientos Operativos']) or Auth::user()->can(['Escribir Procedimientos Operativos']) or Auth::user()->can(['Revisar Procedimientos Operativos']) or Auth::user()->can(['Validar Procedimientos Operativos']))
            <li class="menu-list"><a href=""><i class="fa fa-institution"></i> <span>{{ trans('ui.sidebar.procedimientos') }}</span></a>
                    <ul class="sub-menu-list">
                        <li><a href="{{ url('/procedimiento-operativo') }}"> <i class="fa fa-male"></i><span>{{ trans('ui.sidebar.procedimientosOP') }}</span></a></li>
                        <li><a href="{{ url('indicador') }}"> <i class="fa fa-line-chart"></i><span>{{ trans('ui.sidebar.indicadores') }}</span></a></li>
                        <li><a href="{{ url('seguimiento') }}"> <i class="fa fa-forward"></i><span>{{ trans('ui.sidebar.seguimientos') }}</span></a></li>
                    </ul>

            </li>
            @endif

            @if(Auth::user()->can(['Leer Capacitación Interna']) or Auth::user()->can(['Escribir Capacitación Interna']))
            <li><a href="{{ url('/capacitacion-interna') }}"><i class="fa fa-wpforms"></i> <span>{{ trans('ui.sidebar.capacitacionInterna') }}</span></a>
            </li>
            @endif

            @if(Auth::user()->can(['Leer Comunicación Interna']) or Auth::user()->can(['Escribir Comunicación Interna']))
           <li><a href="{{ url('/comunicacion-interna') }}"><i class="fa fa-wpforms"></i> <span>{{ trans('ui.sidebar.comunicacionInterna') }}</span></a>
            </li>
            @endif

            @if(Auth::user()->can(['Leer No Conformidad']) or Auth::user()->can(['Escribir No Conformidad']))
           <li><a href="{{ url('/no-conformidad') }}"><i class="fa fa-wpforms"></i> <span>{{ trans('ui.sidebar.noConformidad') }}</span></a>
            </li>
            @endif

            @if(Auth::user()->can(['Leer Informe Auditoría']) or Auth::user()->can(['Escribir Informe Auditoría']))
            <li><a href="{{ url('/informe-auditoria') }}"><i class="fa fa-wpforms"></i> <span>{{ trans('ui.sidebar.informeAuditoria') }}</span></a>
            </li>
            @endif

            @if(Auth::user()->can(['Leer Queja y Reclamo']) or Auth::user()->can(['Escribir Queja y Reclamo']))
            <li><a href="{{ url('/queja-reclamo') }}"><i class="fa fa-wpforms"></i> <span>{{ trans('ui.sidebar.quejaReclamo') }}</span></a>
            </li>
            @endif

            @if(Auth::user()->can(['Leer Propuesta Mejora']) or Auth::user()->can(['Escribir Propuesta Mejora']))
            <li><a href="{{ url('/propuesta-mejora') }}"><i class="fa fa-wpforms"></i> <span>{{ trans('ui.sidebar.propuestaMejora') }}</span></a>
            </li>
            @endif

            @if(Auth::user()->can(['Leer Encuesta']) or Auth::user()->can(['Escribir Encuesta']))
            <li><a href="{{ url('/encuesta') }}"><i class="fa fa-wpforms"></i> <span>{{ trans('ui.sidebar.encuesta') }}</span></a>
            </li>
            @endif

            @if(Auth::user()->can(['Gestionar Agenda']))
            <li><a href="{{ url('/agenda') }}"><i class="fa fa-calendar"></i> <span>{{ trans('ui.sidebar.agenda') }}</span></a>
            </li>
            @endif

            @if(Auth::user()->can(['Gestionar Area']) or Auth::user()->can(['Gestionar Auditor']))    
            <li class="menu-list"><a href=""><i class="fa fa-gear"></i> <span>{{ trans('ui.sidebar.configuracion') }}</span></a>
                    <ul class="sub-menu-list">
                        <li><a href="{{ url('/area') }}"> <i class="fa fa-sitemap"></i><span>{{ trans('ui.sidebar.area') }}</span></a></li>
                        <li><a href="{{ url('auditor') }}"> <i class="fa fa-male"></i><span>{{ trans('ui.sidebar.auditor') }}</span></a></li>
                        
                    </ul>

            </li>
            @endif


        </ul>
        <!--sidebar nav end-->

    </div>
</div>