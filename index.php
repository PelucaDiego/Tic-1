<?php
	session_start();
	$conexion = pg_connect("host=localhost dbname=postgres port=5433 user=postgres password=esteban") or die ("Error de conexion".pg_last_error());
	if (!empty($_POST['name']) && !empty($_POST['password'])) {
		$consulta="SELECT id,nombre,contra FROM users WHERE nombre='".$_POST['name']."'";
		#$consulta->bindParam(':name',$_POST['name']);
		$results=pg_query($consulta);
		$linea=pg_fetch_array($results,null,PGSQL_ASSOC);
		print_r($linea);
		if (!empty($linea) && password_verify($_POST['password'], $linea['contra'])) {
			$_SESSION['user_id']=$linea['id'];
			header('location: /tic/inicio.php');
		}else {
			$message="Error al iniciar sesion";
		}
	}else{
		$message="complete los datos solicitados";
	}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<h1>Login</h1>
	<?php 
		if (!empty($message)) { ?>
			<p><?php echo($message) ?> </p>
		<?php } ?>
	<form action="index.php" method="post">
		<input type="text" name="name">
		<input type="password" name="password">
		<input type="submit" value="Send">
	</form>
</body>
</html>