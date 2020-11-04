<div class="row">
	<div class="col">
		<h3 class="text-center">Informe</h3>
		
	</div>
</div>

<script type="text/javascript" src="js/rut.js"></script>
<script type="text/javascript">
	$(document).ready()
	function verDivAddUser(){
		$("#divAddUser").toggle('fast');
	}
	/**
	*registra un nuevo usuario en la base de datos.
	 */
	function addNewUser(){
		//accede directamente a las variables.
		addUser(
			$("#txtAddUserRut").val(),
			$("#txtAddUserNombre").val(),
			$("#txtAddUserClave").val(),
			$("#txtAddUserFNac").val(),
			$("#txtAddUserEspecialidad").val(),
			$("#txtAddUserCargo").val(),
			0,
			0
		);
	}
	// edita la informacion de un usuario.
	function editarUsuario(id){
		console.log("editar usuario");
		//obtenimos los datos
		var rut = $("#rutEditado"+id).val();
		var nombre = $("#nombreEditado"+id).val();
		var clave = $("#claveEditado"+id).val();

		$.post(base_url+"Principal/editarUsuario",{
			id:id,
			rut:rut,
			nombre:nombre,
			clave:clave
		},function(){
			$("#contenedor").hide("fast");
			nuevoUser();
		});
	}

	function cambiarEstadoUser(estado, id){
		$.post(base_url+"Principal/cambiarEstadoUser",{estado:estado,id:id},function(){
			$("#contenedor").hide("fast");
			nuevoUser();
		});
	}
	//**Obtienen un usuario a traves de su identificador */
	function obtenerUsuario(id){
		$.post(base_url+"Principal/obtenerUsuario",{
			id:id
		},function(res){
			console.log(res);
			console.log(res['res'][0]['nombre']);
		},'json');
	}
	/**
	 * Elimina el registro de un usuario.
	 */
	function eliminarUsuario(id ){
		$.post(base_url+"Principal/eliminarUsuario",{
			id:id
		},function(res){
			if(res.error == false){
				$("#mensajeError").html("<p>Usuario ya existente o datos no válidos</p>");
				$("#mensajeError").show('fast');
			}else{
				
				nuevoUser();
			}
		},'json');
	}

	/**
	 * Registra un nuevo usuario en la base de datos, valida a través del
	 * rut si el usuario se encuentra registrado.
	 */
	function addUser(rut, nombre, clave,fNac,especialidad, cargo, op, id){
		$.post(base_url+"Principal/addNewUser",{
			rut:rut,
			nombre:nombre,
			clave:clave,
			fNac:fNac,
			especialidad:especialidad,
			cargo:cargo,
			op:op,
			id:id
		},function(res){
			if(res.error == true){
				$("#mensajeError").html("<p>Usuario ya existente o datos no válidos</p>");
				$("#mensajeError").show('fast');
			}else{
				$("#contenedor").hide("fast");
				nuevoUser();
			}
		},'json');
	}

</script>
