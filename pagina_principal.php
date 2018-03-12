<?php

session_start();
$server = "localhost";
$usuario = "root";
$contra = "MyNewPass";
$basedato = "profesorado_cef";

if(isset($_SESSION['dni'])) {
  try {
    $con = new PDO('mysql:host='.$server.';dbname='.$basedato.'', "$usuario", "$contra");
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = $con->prepare('SELECT nombre_y_apellido FROM alumnos WHERE dni = '.$_SESSION['dni'].'');
    $sql->execute();

    while($datos = $sql->fetch(PDO::FETCH_ASSOC)){
      $nombre_y_apellido = $datos['nombre_y_apellido'];
    }

    // echo '¡Bienvenido, '.$nombre_y_apellido.'!';
    $sesion = 'Bienvenido, '.$nombre_y_apellido.'!';
  }
  catch(PDOException $e) {
    $mensaje = $e->getMessage();
  }
}

?>

<!DOCTYPE html>
<html>
  <head>
    <title>Página principal</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    </head>
  <body>
    <br />
    <div class="container">
      <?php
      if(isset($sesion)) {
        echo '<label>'.$sesion.'</label>';
      }
      ?>
      <h3 align="">Sistema informático</h3><br />
      <div class="row justify-content-md-center">
        <div class="col-md-4 text-center" style="border:1px solid black; border-radius:30px; padding:10px;">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title"><b>Inscripción a materias</b></h4>
              <p class="card-text">Inscríbete a las materias que quieras <b>cursar</b> en el próximo cuatrimestre haciendo clic acá.</p>
              <a href="./inscripcion_materias.php" class="btn btn-primary">Inscribirse</a>
            </div>
          </div>
        </div>
        <div class="col-md-4 text-center" style="border:1px solid black; border-radius:30px; padding:10px;">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title"><b>Inscripción a exámenes finales</b></h4>
              <p class="card-text">Inscríbete a las materias que quieras <b>rendir</b> en la próxima mesa de finales haciendo clic acá.</p>
              <a href="#" class="btn btn-primary">Inscribirse</a>
            </div>
          </div>
        </div>
        <div class="col-md-4 text-center" style="border:1px solid black; border-radius:30px;  padding:10px;">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title"><b>Solicitud de certificados</b></h4>
              <p class="card-text">Descargá tu <b>certificado de alumno regular</b> o tu <b>historial académico</b> haciendo clic acá.</p>
              <a href="#" class="btn btn-primary">Descargar</a>
            </div>
          </div>
        </div>
        <div class="col-md-4 text-center" style="border:1px solid black; border-radius:30px;  padding:10px;">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title"><b>Ver plan de estudios</b></h4>
              <p class="card-text">Podés ver tu plan de estudios haciendo clic acá.</p>
              <a href="#" class="btn btn-primary">Ver plan de estudios</a>
            </div>
          </div>
        </div>
        <div class="col-md-4 text-center" style="border:1px solid black; border-radius:30px;  padding:10px;">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title"><b>Cambiar contraseña</b></h4>
              <p class="card-text">Si necesitás cambiar tu contraseña, podés hacerlo haciendo clic acá.</p>
              <a href="#" class="btn btn-primary">Cambiar contraseña</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
