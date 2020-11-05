
<div class="row">
	<div class="col-12">
		<div class="col-12 mt-4">
			<h3 class="text-center">Ultimo acceso usuarios</h3>
		</div>
		<table class="table table-striped mt-4">
			<th>Rut</th>
			<th>Nombre</th>
			<th>Rol</th>
			<th>Ultimo acceso</th>
			<?php foreach($users as $row):?>
				<tr>
				<td><text><?=$row->rut?></text></td>
				<td><text><?=$row->nombre?></text></td>
				<td><text><?=$row->rol?></text></td>
				<td><text><?=$row->acceso?></text></td>
				</tr> 
			<?php endforeach;?>
		</table>
	</div>
	<div class="col-12">
		<div class="col-12 mt-4">
			<h3 class="text-center">Montos final de ingresos/egresos por día</h3>
		</div>
		<table class="table table-striped mt-4">
			<th>Fecha</th>
			<th>Ingresos totales</th>
			<th>Egreso totales</th>
			<?php foreach($fechas as $elemento):?>
				<?php foreach($elemento as $row):?>
					<tr>
					<td><text><?=$row->fecha?></text></td>
					<td><text> $ <?=$row->ingreso?></text></td>
					<td><text>$ <?=$row->egreso?></text></td>
					</tr> 
				<?php endforeach;?>
			<?php endforeach;?>

		
		</table>
	</div>
</div>
<script type="text/javascript" src="js/rut.js"></script>
<script type="text/javascript">
	$(document).ready()
	function verDivAddUser(){
		$("#divAddUser").toggle('fast');
	}
</script>
