<?php
  $conexion = pg_connect("host=localhost dbname=postgres port=5433 user=postgres password=esteban") or die ("Error de conexion".pg_last_error());
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

</head>
<body onload="revisar()">
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="inicio.php">Navbar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav" >
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
      <th scope="col">humedad</th>
      <th scope="col">temperatura</th>
      <th scope="col">velocidadaire</th>
    </tr>
  </thead>
  <tbody>
    <?php 
    $consulta="SELECT * FROM datos order by id desc;";
    $results=pg_query($consulta);
    for($i = 1; $i <= pg_num_rows($results); $i++){
    $linea=pg_fetch_array($results,null,PGSQL_ASSOC);
    echo('<tr>');
      echo("<th scope='row'>".$linea["id"]."</th>");
      echo('<td>'.$linea["humedad"].'</td>');
      echo('<td>'.$linea["temperatura"].'</td>');
      echo('<td>'.$linea["velocidadaire"].'</td>');
    echo('</tr>');
    }
    ?>
    
    <script>
  function revisar() {
    <?php
      $consulta="select * from datos order by id desc;";
      $results=pg_query($consulta);
      $linea=pg_fetch_array($results,null,PGSQL_ASSOC);
      if ($linea["alarma"]=="t") {
        echo "alert('Peligro de incendio por favor revisar');";
      }
      if ($linea["humedad"]>85) {
      echo "alert('Humedad del hambiente muy alta:".$linea["humedad"]."%');";
    }elseif ($linea["humedad"]<65) {
      echo "alert('Humedad del hambiente muy baja:".$linea["humedad"]."%');";
    }
    if ($linea["temperatura"]>4) {
      echo "alert('temperatura del hambiente muy alta:".$linea["temperatura"]."ºC');";
    }elseif ($linea["temperatura"<0]) {
      echo "alert('temperatura del hambiente muy baja:".$linea["temperatura"]."ºC');";
    }
    if ($linea["velocidadaire"]>2) {
      echo "alert('velocidad del aire del hambiente muy alta:".$linea["velocidadaire"]."[m/s]');";
    }elseif ($linea["velocidadaire"]<0) {
      echo "alert('velocidad del aire del hambiente muy baja:".$linea["velocidadaire"]."[m/s]');";
    }
    pg_free_result($results);
    ?>
    setTimeout('reload()',10000);
}

function reload() {
  location.reload();
}
</script>
</tbody>


</body>

</html>