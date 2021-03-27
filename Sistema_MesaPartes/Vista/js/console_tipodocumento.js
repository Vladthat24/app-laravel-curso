var table;
function listar_tipodocumento(){
     table = $("#tabla_tipodocumento").DataTable({
		"ordering":false,   
        "pageLength":10,
        "destroy":true,
        "async": false ,
        "responsive": true,
    	"autoWidth": false,
      "ajax":{
        "method":"POST",
		"url":"../controlador/tipodocumento/controlador_tipodocumento_listar.php",
      },
      "columns":[
		  {"defaultContent":""},
          {"data":"tipodo_descripcion"},
		  {"data":"tipodo_estado",
				render: function (data, type, row ) {
					if(data=='INACTIVO'){
						return '<span class="badge bg-danger bg-lg">'+data+'</span>';
					}else{
						return '<span class="badge bg-success bg-lg">'+data+'</span>';
					}
		
			}
		  },
	
		  {"data":null,
			render: function (data, type, row ) {
				       return "<button class='editar btn btn-primary  btn-sm'  type='button' ><b><i class='fas fa-edit'></i>&nbsp;Editar</b></button>&nbsp";
			
			    }
			}
		  
      ],
      "fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
        	$($(nRow).find("td")[5]).css('text-align', 'center' );
        },
        "language":idioma_espanol,
        select: true
	});
	table.on( 'draw.dt', function () {
        var PageInfo = $('#tabla_tipodocumento').DataTable().page.info();
        table.column(0, { page: 'current' }).nodes().each( function (cell, i) {
                cell.innerHTML = i + 1 + PageInfo.start;
            } );
        } );
  
}

$('#tabla_tipodocumento').on('click','.editar',function(){
    var data = table.row($(this).parents('tr')).data();//Detecta a que fila hago click y me captura los datos en la variable data.
    if(table.row(this).child.isShown()){//Cuando esta en tamaño responsivo
        var data = table.row(this).data();
    }
    
    $('.form-control').removeClass("is-invalid").removeClass("is-valid");
    $("#modal_editar").modal('show');
    $("#idtipodocumento").val(data.tipodocumento_id);
    $("#txt_nombre_editar").val(data.tipodo_descripcion);
    $("#cbm_estatus").val(data.tipodo_estado).trigger("change");
})

function Registrar_TipoDocumento(){
	var nombre = $("#txt_nombre").val();
	if(nombre.length==0){
		ValidacionInput("txt_nombre");
		return Swal.fire("Mensaje de advertencia","Tiene algunos campos vacios","warning");
	}

    $.ajax({
        "url":"../controlador/tipodocumento/controlador_tipodocumento_registro.php",
        type:'POST',
        data:{
            nombre:nombre
        }
    }).done(function(resp){
        if(resp>0){
                if(resp==1){
					LimpiarCampos();
					listar_tipodocumento();
                    Swal.fire("Mensaje De Confirmacion","Datos guardados correctamente","success");
                    
                }else{
                    LimpiarCampos();
                    Swal.fire("Mensaje De Advertencia","El tipo de documento ya existe en nuestra base de datos","warning");  
                }
        }else{
            Swal.fire("Mensaje De Error","Lo sentimos el registro no se pudo completar","error");
        }
    })		
	
}

function Modificar_TipoDocumento(){
    var idtipodocumento = $("#idtipodocumento").val();
    var nombre = $("#txt_nombre_editar").val();
    var estatus = $("#cbm_estatus").val();
	if(nombre.length==0){
		ValidacionInput("txt_nombre_editar");
		return Swal.fire("Mensaje de advertencia","Tiene algunos campos vacios","warning");
	}
    $.ajax({
        "url":"../controlador/tipodocumento/controlador_tipodocumento_modificar.php",
        type:'POST',
        data:{
            idtipodocumento:idtipodocumento,
            nombre:nombre,
            estatus:estatus
        }
    }).done(function(resp){
        if(resp>0){
                if(resp==1){
                    $("#modal_editar").modal('hide');
					listar_tipodocumento();
                    Swal.fire("Mensaje De Confirmacion","Datos actualizados correctamente","success");
                    
                }else{
                    LimpiarCampos();
                    Swal.fire("Mensaje De Advertencia","El tipo de documento ya existe en nuestra base de datos","warning");  
                }
        }else{
            Swal.fire("Mensaje De Error","Lo sentimos la actualizacion no se pudo completar","error");
        }
    })		
	
}

function ValidacionInput(txt_nombre){
	Boolean($("#"+txt_nombre).val().length>0) ? $("#"+txt_nombre).removeClass('is-invalid').addClass("is-valid") : $("#"+txt_nombre).removeClass('is-valid').addClass("is-invalid"); 
}

function LimpiarCampos(){
    $("#txt_nombre").val("");
    $('.form-control').removeClass("is-invalid").removeClass("is-valid");
    $("#modal_registro").modal('hide');
}

function AbrirModalRegistro(){
    $('.form-control').removeClass("is-invalid").removeClass("is-valid");
    $("#modal_registro").modal('show');

}