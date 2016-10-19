function imprimir()
{
   var divToPrint=document.getElementById("dynamic-table");
   newWin= window.open("");
   newWin.document.write(divToPrint.outerHTML);
   newWin.print();
   newWin.close();
}

function exportarExcel2(){
            $("#dynamic-table").excelexportjs({
            containerid: "dynamic-table", 
			datatype: 'table',
			columns:[ { headertext: "Nombre", datatype: "string", datafield: "id", ishidden: false, width: "50px" }
                    , { headertext: "Estado", datatype: "string", datafield: "fname", ishidden: false, width: "50px" }]
                    
            });
}

function exportarExcel()
{
    var tab_text="<table border='2px'><tr bgcolor='#87AFC6'>";
    var textRange; var j=0;
    tab = document.getElementById('dynamic-table'); // id of table

    for(j = 0 ; j < tab.rows.length ; j++) 
    {     
        tab_text=tab_text+tab.rows[j].innerHTML+"</tr>";
        //tab_text=tab_text+"</tr>";
    }

    tab_text=tab_text+"</table>";
    tab_text= tab_text.replace(/<A[^>]*>|<\/A>/g, "");//remove if u want links in your table
    tab_text= tab_text.replace(/<img[^>]*>/gi,""); // remove if u want images in your table
    tab_text= tab_text.replace(/<input[^>]*>|<\/input>/gi, ""); // reomves input params

    var ua = window.navigator.userAgent;
    var msie = ua.indexOf("MSIE "); 

    if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./))      // If Internet Explorer
    {
        txtArea1.document.open("txt/html","replace");
        txtArea1.document.write(tab_text);
        txtArea1.document.close();
        txtArea1.focus(); 
        sa=txtArea1.document.execCommand("SaveAs",true,"Say Thanks to Sumit.xls");
    }  
    else                 //other browser not tested on IE 11
        sa = window.open('data:application/vnd.ms-excel,' + encodeURIComponent(tab_text));  

    return (sa);
}

function exportar(titulo){
	//por defecto es portrait 'p', A4
	//modificamos 1er parametro a landscape 'l'
	var doc = new jsPDF('l', 'pt');
	doc.text(titulo, 40, 50);
	var res = doc.autoTableHtmlToJson(document.getElementById("dynamic-table"));


	//modificar para sacar la columna Operaciones del json
	res.columns.splice(res.columns.length-1, 1);
	
	for(obj in res.data)
	{
		delete res.data[obj].splice(res.data[obj].length-1,1);;
	}
	//fin sacar operaciones
	
	//sacar la última fila ya que son titulos de la tabla
	delete res.data[res.data.length-1];

	
	doc.autoTable(res.columns, res.data, {startY: 60});
	doc.save(titulo+".pdf");
}

//utilizada por la página generaora de Informes
function exportarGenerador(titulo){
	//por defecto es portrait 'p', A4
	//modificamos 1er parametro a landscape 'l'
	var doc = new jsPDF('l', 'pt');
	doc.text(titulo, 40, 50);
	var res = doc.autoTableHtmlToJson(document.getElementById("dynamic-table"));
	
	doc.autoTable(res.columns, res.data, {startY: 60});
	doc.save(titulo+".pdf");
}

$( document ).ready(function() {

    $('#notifiable_id').show();
    $('#notif_area').hide();
    $('#notif_rol').hide();

//Muestra y oculta campos dependiendo del tipo de notificacion
    $('#notifiable_type').change(function(){
        
        if($('#notifiable_type').val() == 'User') {
            $('#notifiable_id').show();
            $('#notif_area').hide();
            $('#notif_rol').hide();
        }
        if($('#notifiable_type').val() == 'Rol') {
            $('#notifiable_id').hide();
            $('#notif_area').hide();
            $('#notif_rol').show();
        }
        if($('#notifiable_type').val() == 'Area') {
            $('#notifiable_id').hide();
            $('#notif_area').show();
            $('#notif_rol').hide();
        }
        if($('#notifiable_type').val() == 'All') {
            $('#notifiable_id').hide();
            $('#notif_area').hide();
            $('#notif_rol').hide();
        }
    });

})

//Permite agregar la grilla de filtros en las tablas
var tf;
function filtrar(){

var tfConfig = {
        // grid layout customisation
        grid_layout: true,
        grid_width: '890px',
        grid_height: '400px',
        grid_enable_default_filters: false,
        grid_cont_css_class: 'grd-main-cont',
        grid_tblHead_cont_css_class: 'grd-head-cont',
        grid_tbl_cont_css_class: 'grd-cont'
    };



	if ($('tr.fltrow').length == 0){
		tf = new TableFilter('dynamic-table');
		tf.init();
	}
	else{
		tf.destroy();
	}
}

var tf2;
function filtrarInforme(){

var tfConfig = {
        // grid layout customisation
        grid_layout: true,
        
        grid_height: '400px',
        grid_enable_default_filters: false,
        grid_cont_css_class: 'grd-main-cont',
        grid_tblHead_cont_css_class: 'grd-head-cont',
        grid_tbl_cont_css_class: 'grd-cont',
		rows_count:true
		
    };

	if ($('tr.fltrow').length == 0){
		tf2 = new TableFilter('dynamic-table');
		tf2.init();
	}
	else{
		tf2.destroy();
	}
}


/*
dt = table.buttons.exportData();
// Do something with the 'data' variable

// Some time later, recreate with just filtering (no scrolling)
$('#example').dataTable( {
  "filter": false,
  "destroy": true
} );

function initTable () {
  return $('#example').dataTable( {
    "scrollY": "200px",
    "paginate": false,
    "retrieve": true
  } );
}
*/
