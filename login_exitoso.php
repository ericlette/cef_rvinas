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

     echo '¡Bienvenido, '.$nombre_y_apellido.'!';
   }

   catch(PDOException $e) {
     $mensaje = $e->getMessage();
   }
 }
 
 ?>
