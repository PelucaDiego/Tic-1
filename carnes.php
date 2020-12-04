<?php
  $conexion = pg_connect("host=localhost dbname=postgres port=5433 user=postgres password=esteban") or die ("Error de conexion".pg_last_error());
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Navbar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="inicio.php">Inicio <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="carnes.php">Carnes</a>
      </li>
    </ul>
  </div>
</nav>
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">codigo</th>
      <th scope="col">tipo</th>
      <th scope="col">fecha</th>
      <th scope="col">estado</th>
    </tr>
  </thead>
  <tbody>
  	<?php 
  	$consulta="update carnes set estado=TRUE where (select current_date)>=(carnes.fecha+cast(carnes.dias as int));";
  	$update=pg_query($consulta);
  	$consulta="SELECT * FROM carnes;";
  	$results=pg_query($consulta);
  	for($i = 1; $i <= pg_num_rows($results); $i++){
  	$linea=pg_fetch_array($results,null,PGSQL_ASSOC);
  	if($linea["estado"]=="t"){
  	$x="lista";
  }else{
  $x="no lista";
}
  	echo('<tr>');
      echo("<th scope='row'>".$i."</th>");
      echo('<td>'.$linea["code"].'</td>');
      echo('<td>'.$linea["tipo"].'</td>');
      echo('<td>'.date('Y/m/d',strtotime($linea["fecha"].' +'.$linea["dias"].' days')).'</td>');
     echo('<td>'.$x.'</td>');
    echo('</tr>');
    }
    ?>
    <script>
    	setTimeout('reload()',10000);
    	function reload() {
  location.reload();
}
    </script>
</tbody>
</body>
</html>