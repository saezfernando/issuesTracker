
<table border=1>

@foreach($certificados as $certificado)

<tr>
	<td rowspan="{{$proc[$certificado->descripcion-1]}}">
		Certificado {{$certificado->descripcion}}
	</td>

	@foreach($certificado->procedimientos as $procedimiento)
		
		<td rowspan="{{$procedimiento->indicadores->count()}}">
				{{$procedimiento->titulo}}
		</td>
			
			@foreach($procedimiento->indicadores as $indicador)
				
				<td>
					{{$indicador->titulo}}
				</td>
				<td>
					color actual
				</td>
				<td>
					{{--$seguimiento->acciones--}}jj
				</td>
				<td>
					color historico
				</td>	
				</tr>

				<tr>
			@endforeach	
	@endforeach
@endforeach
