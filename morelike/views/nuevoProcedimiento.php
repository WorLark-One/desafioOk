
<div class="row">
	<div class="col-12">
		<h3 class="text-center">Registros Contables</h3>
	</div>
	<div class="col-12 col-lg-12">
		<div class="row">
			<div class="col-4 text-center">
				<h4>Descripción</h4>
			</div>
			<div class="col-4 text-center">
				<h4>Ingreso</h4>
			</div>   
			<div class="col-4 text-center">
				<h4>Egreso</h4>	
			</div>
		</div>
		<div class="row">
			<div class="col-4">
				<input class="form-control" type="text" id="descripcion"  >
			</div>
			<div class="col-4">
				<input class="form-control" type="text" id="ingreso" onkeyup="separador(this)" onchange="formato('ingreso')">
			</div>
			<div class="col-4">
				<input class="form-control" type="text" id="egreso" onkeyup="separador(this)" onchange="formato('egreso')">
			</div>
		</div>
		<div class="row">
			<div class="col-6">
				<button class="btn btn-success" style="width: 100%; margin-top: 10px;" onclick="guardarNuevoProcedimiento()">Guardar <i class="far fa-save"></i></button>
			</div>
			<div class="col-6">
				<button class="btn btn-warning" style="width: 100%; margin-top: 10px;" onclick="verBusquedas()" id="verBusquedas">Busqueda <i class="fas fa-search-plus"></i></button>
				<button class="btn btn-warning" id="ocultarBusquedas" style="display:none; width: 100%; margin-top: 10px;" onclick="ocultarBusquedas()">Busqueda <i class="fas fa-search-plus"></i></button>
			</div>
		</div>
	</div>
	<div class="col-12 col-lg-12" style="display: none" id="divBusqueda">
		<fieldset>
			<legend>Búsquedas</legend>
			<label for="from">Desde</label>
			<input type="text" id="from" name="from">
			<label for="to">Hasta</label>
			<input type="text" id="to" name="to">
			<span title="Buscar">
			<button class="btn btn-info ml-2 mb-2"  onclick="buscadorRangoFecha()" id="buscarFecha">
				<i class="fas fa-search-plus "></i>
			</button>
			</span>
			<span title="Cancelar busqueda">
			<button class="btn btn-danger ml-2 mb-2" onclick="cancelarBuscadorRangoFecha()">
				<i class="fas fas fa-times"></i>
			</button>
			</span>
		</fieldset>
	</div>
	<?php if($cant > 0):?>
		<div class="col-12 col-lg-12" id="ultimosRegistros">
			<table class="table table-striped" id="tablaRegistros">
				<thead>
				<th>Fecha</th>
				<th>Descripción</th>
				<th>Ingreso</th>
				<th>Egreso</th>
				<th>Saldo</th>
				<?php if($this->session->userdata("super")=="Administrador"):?>
				<th>Opciones</th>
				<?php endif;?>	
				</thead>
				<tbody>
				<?php foreach($data as $row):?>
				<tr>
					<td idate>
					<?=substr($row->fecha,0,10)?>
					</td>
					<?php if($this->session->userdata("super")=="Administrador"):?>  
					<td>
						<input type="text" class="form-control" id="descripcion<?=$row->id?>" value="<?=$row->descripcion?>"/>
					</td>
					<td>
						<input type="text" class="form-control" onkeyup="separador(this)" id="ingreso<?=$row->id?>" value="<?=number_format($row->ingreso,0,",",".")?>"/>
					</td>
					<td>
						<input type="text" class="form-control" onkeyup="separador(this)" id="egreso<?=$row->id?>" value="<?=number_format($row->egreso,0,",",".")?>"/>
					</td>
					<?php elseif($this->session->userdata("super")=="Funcionario"):?>
					<td>
						<?=$row->descripcion?>
					</td>
					<td>
						<?=number_format($row->ingreso,0,",",".")?>
					</td>
					<td>
						<?=number_format($row->egreso,0,",",".")?>
					</td>
					<?php endif;?>	
					<?php if($row->saldo>0):?>
					<td class="btn-success"><?=number_format($row->saldo,0,",",".")?></td>
					<?php else:?>
					<td class="btn-danger"><?=number_format($row->saldo,0,",",".")?></td>
					<?php endif;?>
					<?php if($this->session->userdata("super")=="Administrador"):?>  
					<td>
						<span title="Guardar edición">
							<button class="btn btn-info"   onclick="editarRegistro(<?=$row->id?>)">
								<i class="far fa-edit"></i>
							</button>
						</span>
						<span title="Eliminar registro">
						<button class="btn btn-danger ml-2" onclick="eliminarRegistro(<?=$row->id?>)">
							<i class="fas fa-trash-alt"></i>
						</button>
						</span>
					</td>
					<?php endif;?>	
				</tr>
				<?php endforeach;?>
				</tbody>
			</table>
			<input type="hidden" id="idOculto" value="<?=$ultimo?>">
			<button class="btn btn-info" onclick="addRegistros()" style="width: 100%; margin-top:5px;"><i class="fas fa-cloud-download-alt fa-2x"></i></button>
		</div>
	<?php endif;?>

	
</div>
<style type="text/css">
	.textArea{
		border:1px solid #ccc;
		border-radius: 10px;
	}
	.wrapper {
		position: relative;
		width: 402px;
		height: 202px;
		-moz-user-select: none;
		-webkit-user-select: none;
		-ms-user-select: none;
		user-select: none;
	}

	.signature-pad {
		position: absolute;
		left: 0;
		top: 0;
		width:400px;
		height:200px;
		background-color: white;
	}
</style>
<script type="text/javascript" src="js/rut.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$.datepicker.regional['es'] = {
			closeText: 'Cerrar',
			prevText: '< Ant',
			nextText: 'Sig >',
			currentText: 'Hoy',
			monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
			monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
			dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
			dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
			dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
			weekHeader: 'Sm',
			dateFormat: 'yy-mm-dd',
			firstDay: 1,
			isRTL: false,
			showMonthAfterYear: false,
			yearSuffix: ''
		};
		$.datepicker.setDefaults($.datepicker.regional['es']);
			from = $( "#from" )
			.datepicker({
			//defaultDate: "+1w",
			changeMonth: true,
			numberOfMonths: 1
			})
			.on( "change", function() {
			to.datepicker( "option", "minDate", getDate( this ) );
			}),
			to = $( "#to" ).datepicker({
				defaultDate: "+1w",
				changeMonth: true,
				numberOfMonths: 1
			})
			.on( "change", function() {
				from.datepicker( "option", "maxDate", getDate( this ) );
			});
	
		function getDate( element ) {
			var date;
			try {
				date = $.datepicker.parseDate( dateFormat, element.value );
			} catch( error ) {
				date = null;
			}
			return date;
		}
	});
	function separador(input){
        var num = input.value.replace(/\./g,"");
        if(!isNaN(num)) {
			num = num.toString().split("").reverse().join("").replace(/(?=\d*\.?)(\d{3})/g,'$1.');
			num = num.split("").reverse().join("").replace(/^[\.]/, "");
			input.value = num;
        }
        else{ 
			alert("Solo se permiten numeros");
			input.value = input.value.replace(/[^\d\.]*/g,"");
        }
	}	
	function buscadorRangoFecha() {
		const tableReg = document.getElementById('tablaRegistros');
		var dateMinAux = Date.parse($('#from').val());
		var dateMaxAux = Date.parse($('#to').val());
		var dateMin = 0;
		var dateMax = 0;
		var flag = true;
		console.log(dateMin);
		console.log(dateMax);
		if (dateMinAux <= dateMaxAux) {
			dateMax=dateMaxAux;
			dateMin=dateMinAux;
		}
		else{
			alert("La fecha de inicio debe ser menor o igual a la fecha final");
			flag =false;
		}
		if (flag) {
			let total = 0;
			for (let i = 1; i < tableReg.rows.length; i++) {
				let found = false;
				const cellsOfRow = tableReg.rows[i].getElementsByTagName('td');
				var a = Date.parse(cellsOfRow[0].innerText);
				console.log(a);
				
				if (dateMin <= a  && dateMax >= a) {
					found = true;
					total++;
				}
				
				if (found) {
					tableReg.rows[i].style.display = '';
				} else {
					// esconder la fila
					tableReg.rows[i].style.display = 'none';
				}
			}
			//coincidencias
			const lastTR=tableReg.rows[tableReg.rows.length-1];
			const td=lastTR.querySelector("td");
		}
		
	}
	function cancelarBuscadorRangoFecha() {
		const tableReg = document.getElementById('tablaRegistros');
		for (let i = 1; i < tableReg.rows.length; i++) {
				tableReg.rows[i].style.display = '';
		}
		const lastTR=tableReg.rows[tableReg.rows.length-1];
		const td=lastTR.querySelector("td");
		document.getElementById("from").value = "";
		document.getElementById("to").value = "";
	}
	//eliminada function showResponse(responseText, statusText, xhr, $form)
	//eliminada function buscarPacienteRut()
	//eliminada function calcularEdad()

	function guardarNuevoProcedimiento(){
		var descripcion = $("#descripcion").val();
		var ingreso = ($("#ingreso").val().split(".")).join("");
		var egreso = ($("#egreso").val().split(".")).join("");
		var validation = {
		    isEmailAddress:function(str) {
		        var pattern =/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
		        return pattern.test(str);  // returns a boolean
		    },
		    isNotEmpty:function (str) {
		        var pattern =/\S+/;
		        return pattern.test(str);  // returns a boolean
		    },
		    isNumber:function(str) {
		        var pattern = /^\d+$/;
		        return pattern.test(str);  // returns a boolean
		    },
		    isText:function(str){
		    	var pattern=/^[a-zA-Z ]*$/;
		    	return pattern.test(str); // returns a boolean
 		    },
 		    isTelefono:function(str){
 		    	var pattern=/^[0-9+]+$/;
 		    	return pattern.test(str);
 		    },
		    isSame:function(str1,str2){
		        return str1 === str2;
		    }
		};
		var fail = 0;
		if(descripcion.length==0 && (ingreso.length == 0 || egreso.length == 0)){
			alert("Debes registrar Descripción e Ingreso o Egreso");
			fail=1;
		}
		if(descripcion.length>0 && ingreso.length == 0 && egreso.length == 0){
			alert("Falta registrar Ingreso o Egreso");
			fail=1;
		}
		if(ingreso.length> 0 && egreso.length > 0){
			alert("Solo puede ser Ingreso o Egreso!");
			fail=1;
		}

		if(fail == 0){
			$.post(base_url+"Principal/saveProcedimiento",{
				descripcion:descripcion, ingreso:ingreso, egreso:egreso
			},function(){
				$("#contenedor").hide('fast');
				nuevoProcedimiento();
			});
		}
	}
	function verBusquedas(){
		$("#divBusqueda").show("fast");
		$("#verBusquedas").hide();
		$("#ocultarBusquedas").show();
	}
	function ocultarBusquedas(){
		$("#divBusqueda").hide("fast");
		$("#verBusquedas").show();
		$("#ocultarBusquedas").hide();
		document.getElementById("from").value = "";
		document.getElementById("to").value = "";
	}
	function formato(campo){
		var cadena = $("#"+campo).val();
		
		$("#"+campo).val(cadena);
	}
	function addRegistros(){
		$.post(
			base_url+"Principal/traeMasRegistros",
			{desde:$("#idOculto").val()},
			function(data){
				if(data.cant > 0){
					var cadena ="";
					for(var i =0;i<data.cant;i++){
						if(data.data[i].saldo>0){
							cadena+="<tr><td>"+(data.data[i].fecha).substring(0,10)+"</td><td>"+data.data[i].descripcion+"</td><td>"+data.data[i].ingreso+"</td><td>"+data.data[i].egreso+"</td><td class='btn-success'>"+data.data[i].saldo+"</td></tr>";
						}else{
							cadena+="<tr><td>"+(data.data[i].fecha).substring(0,10)+"</td><td>"+data.data[i].descripcion+"</td><td>"+data.data[i].ingreso+"</td><td>"+data.data[i].egreso+"</td><td class='btn-danger'>"+data.data[i].saldo+"</td></tr>";
						}
					}
					$("#idOculto").val(data.ultimo);
					$("#tablaRegistros").append(cadena);
					//$("#contenedor").hide('fast');
				}
				
			},'json'
		);
	}
	//eliminada function saveImagen(id,archivo,nombre)

	function editarRegistro(id){
		//alert("Falta registrar Ingreso o Egreso");
		var descripcion = $("#descripcion"+id).val();
		var ingreso = $("#ingreso"+id).val();
		var valorIngreso = ingreso.split(".");
		var egreso = $("#egreso"+id).val();
		var valorEgreso = egreso.split(".");
		ingreso = "";
		egreso = "";
		for (let index = 0; index < valorIngreso.length; index++) {
			const element = valorIngreso[index];
			if (index == 0) {
				ingreso = element;
			}
			else{
				ingreso = ingreso.concat(element);
			}
		}
		for (let index = 0; index < valorEgreso.length; index++) {
			const element = valorEgreso[index];
			if (index == 0) {
				egreso = element;
			}
			else{
				egreso = egreso.concat(element);
			}
		}
		console.log("descripcion "+descripcion);
		console.log("ingreso "+ingreso);
		console.log("egreso "+egreso);
		$.post(base_url+"Principal/editarProcedimiento",{
				id:id,descripcion:descripcion,ingreso:ingreso,egreso:egreso
			},function(){
				$("#contenedor").hide('fast');
				nuevoProcedimiento();
			});
		console.log("editar "+id);
	}

	function eliminarRegistro(id){
		$.post(base_url+"Principal/eliminarProcedimiento",{
				id:id
			},function(){
				$("#contenedor").hide('fast');
				nuevoProcedimiento();
			});
		console.log("eliminar"+id);
	}

</script>
