<?php
	session_start();
	$info = array();
	if ($_POST){
		$file = "conf.dat";
		$cod = $_POST['codigo'];
		if ($cod < 1){
		if(is_file($file)){
			$conf = unserialize(file_get_contents($file));
			$conf->cod++;
		}else{
			$conf = new stdClass();
			$conf->cod = 1;
		}


		file_put_contents('conf.dat',serialize($conf));
		$cod = $conf->cod;
		}
		
		$_POST['codigo'] = $cod;
		$datos = json_encode($_POST);
		file_put_contents("datos/row{$cod}.json", $datos);
	}
else if (isset($_GET['edit'])){
	$file = "datos/{$_GET['edit']}";
	$info = json_decode(file_get_contents($file),true);
	
}else if (isset($_GET['del'])){
	$file = "datos/{$_GET['del']}";
	if (is_file($file)){
	unlink($file);
	}
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Tarea 1</title>
	<meta charset="utf-8">
<!--
Created using JS Bin
-->
<meta name="robots" content="noindex">
<meta name="viewport" content="width=device-width">
<title>Veterinaria</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.4/css/bootstrap.min.css" integrity="sha384-2hfp1SzUoho7/TsGGGDaFdsuuDL0LX2hnUp6VkX3CUQ2K4K+xjboZdsXyp4oUHZj" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.0.0/jquery.min.js" integrity="sha384-THPy051/pYDQGanwU6poAc/hOdQxjnOEXzbT+OuUAFqNqFjL+4IGLBgCJC3ZOShY" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.2.0/js/tether.min.js" integrity="sha384-Plbmg8JY28KFelvJVai01l8WyZzrYWG825m+cZ0eDDS1f7d/js6ikvy1+X+guPIB" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.4/js/bootstrap.min.js" integrity="sha384-VjEeINv9OSwtWFLAtmc4JCtEJXXBub00gtSnszmspDLCtC0I4z4nqz7rEFbIZLLU" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">

<style id="jsbin-css">
	header{
		background:#f7f7f7;
		color:#101010;
		padding:1rem;
	}
	.table td, .table th{
		text-align:center;
		vertical-align:middle;
	}
	.footer{
		position:absolute;
		bottom:0;
		width:100%;
		background:#f7f7f7;
		padding-top: 0.5rem;
		display:flex;
		align-items:center;
		justify-content:center;
	}
	.footer p{
		text-align:center;
		vertical-align:middle;
		margin-top: 7px;
	}
</style>
</head>
<body>
<header>
		<div class="container">
			<h3>Mascotas agregadas</h3>
		</div>
	</header>
	<br>
	<div class="container">
		<div class="row">
			<div class="col-xs-3">
			</div>
			<div class="col-xs-6"></div>
			<div class="col-xs-3">
				<div class="input-group">
					<input type="text" class="form-control" placeholder="Search...">
					<span class="input-group-btn">
						<button class="btn btn-secondary"><i class="fa fa-search"></i></button>
					</span>
				</div>
			</div>
		</div>
		<br>
	<div class="container">
	<h2>Registrar Datos de la mascota</h2>
	<br>
		<form method="post">
			<div class="row">
				<div class="col col-sm-4">
					
					<div class="form-group input-group">
						<span class="input-group-addon">ID</span>
						<input type="text" name="codigo" value="<?php echo (isset($info ['codigo']))?$info ['codigo']:''; ?>" readonly class="form-control"/>
					</div>
					
					<div class="form-group input-group">
						<span class="input-group-addon">Nombre</span>
						<input type="text" name="nombre" value="<?php echo (isset($info ['nombre']))?$info ['nombre']:''; ?>" class="form-control"/>
					</div>

					<div class="form-group input-group">
						<span class="input-group-addon">Fecha de nacimiento</span>
						<input type="text" name="fecha" value="<?php echo (isset($info ['fecha']))?$info ['fecha']:''; ?>" class="form-control"/>
					</div>
					
					<div class="form-group input-group">
						<span class="input-group-addon">Tipo</span>
						<input type="text" name="tipo" value="<?php echo (isset($info ['tipo']))?$info ['tipo']:''; ?>" class="form-control"/>
					</div>
					
					<div class="form-group input-group">
						<span class="input-group-addon">Raza</span>
						<input type="text" name="raza" value="<?php echo (isset($info ['raza']))?$info ['raza']:''; ?>" class="form-control"/>
					</div>
					
					<div class="form-group input-group">
						<span class="input-group-addon">Peso</span>
						<input type="text" name="peso" value="<?php echo (isset($info ['peso']))?$info ['peso']:''; ?>" class="form-control"/>
					</div>

					<div class="form-group input-group">
						<span class="input-group-addon">Color</span>
						<input type="text" name="color" value="<?php echo (isset($info ['color']))?$info ['color']:''; ?>" class="form-control"/>
					</div>

					<div class="form-group input-group">
						<span class="input-group-addon">Comentario</span>
						<input type="text" name="comentario" value="<?php echo (isset($info ['comentario']))?$info ['comentario']:''; ?>" class="form-control"/>
					</div>
					
				</div>

				<div class="col col-sm4">
					<a href="index2.php" class="btn btn-success">Nuevo</a>
					<button type="submit" class="btn btn-primary">Guardar</button>
					
				</div>
				
			</div>
		</form>
			<table class="table">
				<thead>
					<tr>
						<th>ID</th>
						<th>Nombre</th>
						<th>Fecha de nacimiento</th>
						<th>Tipo</th>
						<th>Raza</th>
						<th>Peso</th>
						<th>Color</th>
						<th>Comentario</th>
						<th>Accion</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$files = scandir("datos");
						foreach ($files as $file) {
							$path = "datos/{$file}"; 
							if (is_file($path)){
								$info = file_get_contents($path);
								$datos = json_decode($info);
								echo "<tr>";
								foreach ($datos as $campo) {
									echo "<td>{$campo}</td>";
								}
								echo "
								<td>
									<a href='index2.php?edit={$file}' class='btn btn-warning'>Modificar</a>
									<a href='index2.php?del={$file}' onclick='return confirm(\"¿Seguro que quieres eliminar este campo?\");' class='btn btn-danger'>Eliminar</a>

								</td>



								</tr>";
							}
						}

					?>
				</tbody>
			</table>
		
	</div>

</body>
</html>