<div class="row">
	<div class="col-sm">
		<table class="table table-striped">
			<th>Ingresos</th>
			<th>Egreso</th>
			<!-- <th></th>
			<th></th>
			<th></th> -->
	
			<tr>
			<td><text>$10.000</text></td>
			<td><text>$20.000</text></td>
			<tr>

		</table>
	</div>
</div>
<div class="row">
	<div class="col">
		<table class="table table-striped">
			<th>Rut</th>
			<th>Nombre</th>
			<th>Rol</th>
			<th>Especialidad</th>
			<th>Ultimo acceso</th>
			<th>Ingreso final</th>
			<th>EgresoFinal</th>
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
