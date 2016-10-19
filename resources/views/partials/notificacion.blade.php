    <!-- header section start-->

    <div class="header-notificacion">
    <!--notification menu end -->
        <div class='menu-right'>
            <!--Notificación y mensajería-->
            <div class="dropdown">
            <a class="btn btn-info dropdown-toggle" data-toggle="dropdown" href="{{ url('/notificacion') }}">
               <i class="fa fa-comment fa-lg" aria-hidden="true"></i>
                {{ trans('ui.notificacion.titulo',['numero'=>Auth::user()->notificaciones()->where("read",false)->count()]) }}
                <i class="caret"></i>
            </a>
            <ul class="dropdown-menu">
                
                @foreach (Auth::user()->notificaciones()->where("read",false)->get() as $notificacion)
                
                <li>{{ $notificacion->body }}</li>
                
                @endforeach

                <li class="divider"></li>
                <li><a href="{{ url('/notificacion') }}">Administrar Notificaciones!!</a></li>
            </ul>    
            </div>
        </div>
     </div>   


