var Script = function () {

    $(document).ready(function() {

	$.validator.addMethod("hayRolesoAreas", function(value, element) {
		if ($('#notifiable_type').val()=='Rol'){
				return $('#roleSelect option:selected').length;
			 }
		if ($('#notifiable_type').val()=='Area'){
				return $('#areaSelect option:selected').length;
			 }	 
		return true;

}, 'Seleccione al menos un valor!!!');
	
	
        $("#userForm").validate({
            rules: {
                nombre: {required:true,minlength:2},
				apellido: {required:true,minlength:2},
				email: {required:true,
						email:true},
				dni:  {required:true,
					minlength: 8,
					maxlength: 8,
					number:true
					},
				password: {required:true},
				password_confirmation: {equalTo:'#password'},
				area: {required:true}
            },
            messages: {
                nombre: "Entrada requerida",
				apellido: "Entrada requerida",
				dni: "Entrada requerida con 8 números",
				email: "El mail no tiene el formato adecuado",
				area: "Entrada requerida",
				password: "Entrada requerida, mínimo 6 caracteres",
				password_confirmation: "Debe coincidir con contraseña",
            }
        });

        $("#roleForm").validate({
            rules: {
                name: {required:true,minlength:2},
           },
            messages: {
                name: "Entrada requerida",
           }
        });

        $("#permissionForm").validate({
            rules: {
                name: {required:true,minlength:2},
           },
            messages: {
                name: "Entrada requerida",
           }
        });
		
		$("#notificationForm").validate({
            rules: {
                motivo: {required:true,minlength:2},
				body: {required:true,minlength:10},
				//notifiable_type: {required:true},
				notifiable_id: {required:true},
				notifiable_type: {hayRolesoAreas:true}
				
           },
            messages: {
                motivo: "Entrada Requerida",
				body: "Entrada Requerida",
				notifiable_id: "Entrada Requerida",
				//notifiable_type: "Elija un Rol"
					
           }
        });
		
		$("#areaForm").validate({
            rules: {
                descripcion: {required:true,minlength:2},
           },
            messages: {
                descripcion: "Entrada requerida",
           }
        });

		$("#auditorForm").validate({
            rules: {
                descripcion: {required:true,minlength:2},
           },
            messages: {
                descripcion: "Entrada requerida",
           }
        });
		
		$("#informeAuditoriaForm").validate({
            rules: {
                numero: {required:true,number:true},
				tipo: {required:true},
				fecha: {required:true,date:true},
				auditorLider: {required:true},
				nivelAuditado: {required:true},
				'auditorEquipo[]':{required:true,minlength: 1},
				'procedimientos[]':{required:true,minlength: 1},
				
           },
            messages: {
                numero: "Entrada requerida",
				tipo: "Entrada requerida",
				fecha: "Entrada requerida",
				auditorLider: "Entrada requerida",
				nivelAuditado: "Entrada requerida",
				'auditorEquipo[]': "Seleccione al menos 1 auditor",
				'procedimientos[]': "Seleccione al menos 1 procedimiento"
           }
        });
		
		$("#noConformidadForm").validate({
            rules: {
                procedimiento: {required:true},
				categoria: {required:true},
				requisitoIncumple: {required:true},
				descripcion: {required:true},
				origen: {required:true},
				informeAuditoria: { required: function(element) {return $("#origen").val() == '1';}
								  },
				estado: {required:true},
           },
            messages: {
                procedimiento: "Entrada requerida",
				categoria: "Entrada requerida",
				requisitoIncumple: "Entrada requerida",
				descripcion: "Entrada requerida",
				origen: "Entrada requerida",
				informeAuditoria: "Entrada requerida",
				estado: "Entrada requerida"
           }
        });
		
		$("#propuestaMejoraForm").validate({
            rules: {
                propuestaImplementar: {required:true},
				recursosNecesarios: {required:true},
				fecha: {required:true,date:true},
				accionRealizada: {required:true},
				estado: {required:true},
				'procedimientos[]':{required:true,minlength: 1}
           },
            messages: {
                propuestaImplementar: "Entrada requerida",
				recursosNecesarios: "Entrada requerida",
				fecha: "Entrada requerida",
				accionRealizada: "Entrada requerida",
				estado: "Entrada requerida",
				'procedimientos[]': "Seleccione al menos 1 procedimiento"
           }
        });
		
		$("#procedimientoOPForm").validate({
            rules: {
                titulo: {required:true},
				dueño: {required:true},
				codigo: {required:true},
				certificdo: {required:true},
				fechaEmision: {required:true,date:true},
				
           },
            messages: {
                titulo: "Entrada requerida",
				dueño: "Entrada requerida",
				codigo: "Entrada requerida",
				certificado: "Entrada requerida",
				fechaEmision: "Entrada requerida",

           }
        });
		
		
		$("#encuestaForm").validate({
            rules: {
                nombre: {required:true},
				procedimiento: {required:true},
				periodo: {required:true,date:true},
				tratamientoDesfavorable: {required:true},
				porcentajeSatisfaccion: {number:true,range: [0, 100]},
				porcentaje: {number:true,range: [0, 100]},
				
           },
            messages: {
                nombre: "Entrada requerida",
				procedimiento: "Entrada requerida",
				periodo: "Entrada requerida",
				tratamientoDesfavorable: "Entrada requerida",
				porcentajeSatisfaccion: "Valor máximo 100%",
				porcentaje: "Valor máximo 100%",
           }
        });
		
		
		
		
		
		
		
    });
}();