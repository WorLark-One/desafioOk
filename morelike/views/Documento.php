<div class="row">
	<div class="col-6">
		<table class="table table-striped">
			<th>Ingreso</th>
			<th>egreso</th>
			
			<tr>
			</td> 
		</table>
	</div>
<div class="row">
	<div class="col">
		<table class="table table-striped">
			<th>Rut</th>
			<th>Nombre</th>
			<th>Rol</th>
			<th>Especialidad</th>
			<th>Ultimo acceso</th>
			<th></th>
			<th></th>
			<th></th>
			<?php foreach($users as $row):?>
				<?php if($row->rol !="Administrador"):?>  
				
					<tr>
					<td><text><?=$row->rut?></text></td>
					<td><text><?=$row->nombre?></text></td>
					<td><text><?=$row->rol?></text></td>
					<td><text><?=$row->especialidad?></text></td>
					<td><text><?=$row->acceso?></text></td>
					</td> 
				<?php endif;?>
			<?php endforeach;?>
				<button class="btn btn-success" onclick="obtenerIngresoEgresoDia()"><i class="far fa-save"></i></button>
		</table>
	</div>
</div>
<script type="text/javascript" src="js/rut.js"></script>
<script type="text/javascript">
	var ingreso= 0;
	var egreso = 0;
	$(document).ready()
	function verDivAddUser(){
		$("#divAddUser").toggle('fast');
	}

	function obtenerIngresoEgresoDia(){
		$.post(base_url+"Principal/calcularIngresoEgresoDiario",{
		},function(res){
			console.log(res);
			if(res.error == false){
				$("#mensajeError").html("<p>Usuario ya existente o datos no válidos</p>");
				$("#mensajeError").show('fast');
			}else{
				
				nuevoUser();
			}
		},'json');
	}

	
</script>
