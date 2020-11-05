<div class="row">
	<div class="col">
		<h3 class="text-center">Informe</h3>
		<hr>
		<button type="button" class="btn btn-dark" onclick="verDivAddUser()"><i class="fas fa-plus-circle fa-2x"></i></button>
		<div class="row mb-3" id="divAddUser" style="display: none;">
			<div class="col-4">
			  <input type="text" class="form-control" placeholder="Rut" aria-label="Rut Usuario" id="txtAddUserRut" maxlength="12">
			</div>
			<div class="col-4">
			  <input type="text" class="form-control" placeholder="Nombre" aria-label="Nombre Usuario" id="txtAddUserNombre">
			</div>
			<div class="col-4">
			  <input type="password" class="form-control" placeholder="Clave" aria-label="Clave Usuario" id="txtAddUserClave">
			</div>
			<div class="col-4">
			  <input type="date" class="form-control" placeholder="Fecha Nacimiento" aria-label="Fecha Nacimiento" id="txtAddUserFNac">
			</div>
			<div class="col-4">
			  <select class="form-control" placeholder="Especialdad" aria-label="Especialidad" id="txtAddUserEspecialidad">
			  	<option selected disabled>Especialidad</option>
			  	<option value="Enfermeria">Enfermeria</option>
				  <option value="TENS">TENS</option>
			  </select>
			</div>
			<div class="col-4">
			  <select class="form-control" placeholder="Cargo" aria-label="Cargo" id="txtAddUserCargo">
			  	<option selected disabled>Cargo</option>
			  	<option value="Funcionario">Funcionario</option>
			  	<option value="Administrador">Administrador</option>
			  </select>
			</div>
			<div class="col-12">
			  <button class="btn btn-success" onclick="addNewUser()" style="width: 100%;"><i class="far fa-check-square"></i></button>
			</div>
		</div>
		<div style="display: none;" id="mensajeError" class="btn-danger text-center"></div>
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
