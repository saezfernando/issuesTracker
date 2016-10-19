//multiselect start


$('#permissionSelect').multiSelect({
	selectableHeader: "<div class='custom-header btn-info' align='center'>Items a Seleccionar</div>",
	selectionHeader: "<div class='custom-header  btn-info' align='center'>Items Seleccionados</div>"
});

$('#roleSelect').multiSelect({
	selectableHeader: "<div class='custom-header btn-info' align='center'>Items a Seleccionar</div>",
	selectionHeader: "<div class='custom-header  btn-info' align='center'>Items Seleccionados</div>"
});

$('#areaSelect').multiSelect(
{
	selectableHeader: "<div class='custom-header btn-info' align='center'>Items a Seleccionar</div>",
	selectionHeader: "<div class='custom-header  btn-info' align='center'>Items Seleccionados</div>"
});

$('#auditorEquipoSelect').multiSelect(
{
	selectableHeader: "<div class='custom-header btn-info' align='center'>Items a Seleccionar</div>",
	selectionHeader: "<div class='custom-header  btn-info' align='center'>Items Seleccionados</div>"
});

$('#procedimientoSelect').multiSelect(
{
	selectableHeader: "<div class='custom-header btn-info' align='center'>Items a Seleccionar</div>",
	selectionHeader: "<div class='custom-header  btn-info' align='center'>Items Seleccionados</div>"
});

$('#informeSelect').multiSelect(
{
	selectableHeader: "<div class='custom-header btn-info' align='center'>Items a Seleccionar</div>",
	selectionHeader: "<div class='custom-header  btn-info' align='center'>Items Seleccionados</div>",
	afterSelect: function(values){
			agregar(values);
            //alert("Select value: "+values);
    },
    afterDeselect: function(values){
            ocultar(values);
			//alert("Deselect value: "+values);
    }
	
});

/*Agrega encabezados a los selec multiple (multi select)
	$('#roleSelect').multiSelect({
	  selectableHeader: "<div class='custom-header'>Items a Seleccionar</div>",
	  selectionHeader: "<div class='custom-header'>Items Seleccionados</div>"
	  //selectableFooter: "<div class='custom-header'>Selectable footer</div>",
	  //selectionFooter: "<div class='custom-header'>Selection footer</div>"
	});	
*/

//multiselect end