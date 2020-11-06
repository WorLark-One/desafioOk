<!DOCTYPE html>
<html lang="es">

<head>

  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta charset="utf-8">
  <meta name="description" content="">

  <title>Desafio</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link href="<?=base_url()?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <!--link rel="stylesheet" href="/resources/demos/style.css"-->
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

  <!--script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script-->
  <!--link href="<?=base_url()?>css/agency.css" rel="stylesheet"-->
  
 <script src="<?=base_url()?>js/jquery.form.min.js"></script>

<script type="text/javascript">
      var base_url = '<?=base_url()?>';
  </script>
  <style type="text/css">
  	.btn-nuevo{
  		color:white;
  		width: 100%;
  		height: 100px;
  		background-color:#128c7e;
  	}
  	.btn-nuevo:hover{
  		color:#128c7e;
  		background-color:#dcf8c6;	
  	}
  	.btn-nuevo:active{
  		color:#128c7e;
  		background-color:#34b7f1;
  	}
  	#logoMV{
		width: 50%;
	}
  	@media(min-width: 768px){
		#logoMV{
			width: 20%;
		}
  	}
  </style>
</head>
<body>
	<div class="container" style="margin-top:10px;">
		<div class="row" style="border-radius:10px;background: rgba(124, 138, 195,0);padding:5px">
			<div class="col-6">
				
			</div>
			<div class="col-6 text-right">
				<text style="color:#128c7e">Bienvenid@ <button type="button" class="btn" style="border:1px solid black;" onclick="openModal()"><?=$this->session->userdata("nombre")?></button></text>
				<a href="Salida" class="btn btn-info"><i class="fas fa-sign-out-alt"></i></a><br><text style="font-size: 9px;color:#34b7f1">Último acceso: <?=$this->session->userdata("acceso")?></text>
			</div>
		</div>
		<div class="row text-center" id="botonesAreas">
			<div class="col-12">
			<select id="selectCentros" onchange="entrarArea()" style="width: 100%;">
				<option selected disabled></option>
				<?php for($i=0;$i<sizeof($this->session->userdata("areas"));$i++):?>
					<option value="<?=$this->session->userdata("idAreas")[$i];?>"><?=$this->session->userdata("areas")[$i];?></option>
				<?php endfor;?>	
			</select>
			</div>
			<hr>
			<?php if($this->session->userdata("super")=="Administrador"):?>  
				<div class="col-12">
					<button class="btn btn-nuevo " style="width: 100%; height: 100px;" onclick="nuevoProcedimiento()">
						<i class="fas fa-file-medical fa-3x"></i>
					</button>
					<hr>
				</div>
				<div class="col-6">
					<button class="btn btn-nuevo" style="width: 100%; height: 100px;" onclick="nuevaArea()">
						<i class="fas fa-folder-plus fa-3x"></i>
					</button>
					<hr>
				</div>
				<div class="col-6">
					<button class="btn btn-nuevo" style="width: 100%; height: 100px;" onclick="nuevoUser()">
						<i class="fas fa-user-plus fa-3x"></i>
					</button>
					<hr>
				</div>
				<div class="col-6">
					<button class="btn btn-nuevo" style="width: 100%; height: 100px;" onclick="nuevoLink()">
						<i class="fas fa-paperclip fa-3x"></i>
					</button>
					<hr>
				</div>
				<div class="col-6">
					<button class="btn btn-nuevo" style="width: 100%; height: 100px;" onclick="nuevoDocumento()">
						<i class="far fa-chart-bar fa-3x"></i>
					</button>
					<hr>
				</div>
			<?php elseif($this->session->userdata("super")=="Funcionario"):?>
				<div class="col-12">
					<button class="btn btn-nuevo " style="width: 100%; height: 100px;" onclick="nuevoProcedimiento()">
						<i class="fas fa-file-medical fa-3x"></i>
					</button>
					<hr>
				</div>
			<?php endif;?>

		</div>
	</div>
	<div class="container" id="contenedor" style="display: none;">

	</div>
</body>
<!-- Modal -->
<!--eliminado <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">-->
  
<!-- Modal -->
<!--eliminado <div class="modal fade btn-danger" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">-->
    
<!-- Modal -->
<!--eliminado <div class="modal fade btn-success" id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel3" aria-hidden="true">-->
    
<script charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-scrollTo/2.1.2/jquery.scrollTo.min.js"></script>
<script type="text/javascript">
	var pacientes;
	$(document).ready(function(){
		});
	function nuevoProcedimiento(){
		$.post(base_url+"Principal/nuevoProcedimiento",{},function(html,data){$("#contenedor").html(html,data); $("#contenedor").show("fast"); 
			$("#rutPacienteBusqueda").focus();
			//$('html, body').animate({ scrollTop: $("#rutPacienteBusqueda").offset().top }, 500);
		});
	}
	function nuevaArea(){
		$.post(base_url+"Principal/newArea",{},function(html,data){$("#contenedor").html(html,data); $("#contenedor").show("fast");});
	}
	function nuevoUser(){
		$.post(base_url+"Principal/newUser",{},function(html,data){$("#contenedor").html(html,data); $("#contenedor").show("fast");});
	}
	function nuevoLink(){
		$.post(base_url+"Principal/newLink",{},function(html,data){$("#contenedor").html(html,data); $("#contenedor").show("fast");});
	}
	function nuevoDocumento(){
		$.post(base_url+"Principal/Documento",{},function(html,data){$("#contenedor").html(html,data); $("#contenedor").show("fast");});
	}

	function entrarArea(){
		var centro = $("#selectCentros").val();
		$(".btnDisabled").attr("disabled",false);
	}
	//eliminada function buscar(){
		
	//eliminada function buscarPacienteRutModal(){
		
	//eliminada function buscarPacienteRut(rut){
		
	//eliminada function openModal(){
		
	//eliminada function validaClave0(){
		
	// eliminada function validaClave1(){
		
	// eliminada function validaClave2(){
		
	// eliminada function cambiarClave(){
		
</script>
