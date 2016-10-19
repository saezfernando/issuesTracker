<!doctype html>
<html lang="es">
<head>
    @include('partials.header')

    @include('partials.style')
    <link href="{{ asset('themes/admin/css/grillafiltrada.css') }}" rel="stylesheet" />
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.0.0/fullcalendar.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.0.0/locale/es.js"></script>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css"/>
    
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

</head>

    <body class="sticky-header">
        <section>

            @include('partials.sidebar')

            @include('partials.header_top')

          {{-- No va @include('partials.notificacion') --}}
            

                <div class="main-content" >

 <div id="eventContent" class="modal fade" title="Event Details">
        <div id="eventInfo"></div>
        <p><strong><a id="eventLink" target="_blank">Read More</a></strong></p>
    </div>


                {!! $agenda->calendar() !!}
                {!! $agenda->script() !!}
            
                 @include('partials.footer')
                
                </div>

    </section>  
  
  <!-- Mostrar detalle de un evento--> 
   <div id="fullCalModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span> <span class="sr-only">close</span></button>
                <h4  style="color:red;" id="modalTitle" class="modal-title"></h4>
            </div>
            <div id="modalBody" class="modal-body"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>               


<!-- Usada para cargar un nuevo evento -->
  <div class="modal fade" id="modalForm" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 style="color:red;"> Agregar Evento</h4>
        </div>
        <div class="modal-body">
          <form action="{{url('\calendario')}}" class="cmxform form-horizontal" method="post">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            
            <div class="form-group">
              <label for="titulo" class="col-lg-2 control-label"> Título</label>
              <div class="col-lg-10">
              <input type="text" class="form-control" name="titulo" id="titulo" width="100%">
              </div>
            </div>
        
            <div class="form-group">
              
                  <label for="fechaInicio" class="col-lg-2 control-label"> Fecha Desde</label>
                    <div class="col-lg-4">
                  <input type="date" class="form-control" name="fechaInicio" id="fechaInicio">
                    </div>
              
                  <label for="fechaInicio" class="col-lg-2 control-label"> Hasta</label>
                    <div class="col-lg-4">
                  <input type="date" class="form-control" name="fechaFin" id="fechaFin">
                  </div>    
            </div>


            <div class="form-group">
              <label for="descripcion" class="col-lg-2 control-label">Descripción</label>
              <div class="col-lg-10">
              <textarea  class="form-control" name="descripcion" id="descripcion"></textarea>
              </div>
            </div>

            <div class="form-group">
              <label for="horaInicio" class="col-lg-2 control-label">Hora Inicio</label>
              <div class="col-lg-10">
              <input type="time"  class="form-control" name="hora" id="hora" placeholder="hrs:mins">
              </div>
            </div>

            <div class="form-group">
              <label for="url" class="col-lg-2 control-label">URL</label>
              <div class="col-lg-10">
              <input type="text" class="form-control" name="url" id="url" placeholder="url completa Ej http:\\www.google.com">
              </div>
            </div>

        </div>
       <div class="modal-footer">
          <button type="submit" class="btn btn-primary">
            Guardar
          </button>
          <button type="button" class="btn btn-default btn-warning" data-dismiss="modal">
            Cancelar
          </button>
          </form>
        </div>


      </div>
    </div>
  </div>


   
    </body>
</html>
