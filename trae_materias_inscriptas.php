<?php 


 $server = "localhost";
  $usuario = "root";
  $contra = "";
  $basedato = "profesorado_cef";
  $id_alumno = $_GET['id_alumno'];

 try {
    $con = new PDO('mysql:host='.$server.';dbname='.$basedato.'', "$usuario", "$contra");
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = $con->prepare("SELECT c.id_materia,c.nombre, c_e.fecha FROM catedras AS c INNER JOIN alumnos_examenes AS a_e ON c.id_materia = a_e.id_materia INNER JOIN calendario_examenes AS c_e ON c_e.id_materia = c.id_materia WHERE id_alumno = :id_alumno "
    );

    $sql->execute(
    	array(
          
          'id_alumno' => $id_alumno
        )

    	);

  $cadena = "";

 

    while( $datos = $sql->fetch(PDO::FETCH_ASSOC)){
 
     $cadena.='
     <table><tr><td>
     <a  class="list-group-item list-group-item-action "><p style="cursor:pointer;color:blue;"> <button onClick="dar_baja('.$datos['id_materia'].','.$id_alumno.');">Baja</button > '.$datos['nombre'].'</p></a></tr>';

		
}

 } catch(PDOException $e) {
    echo 'Error: ' . $e->getMessage();
  }


echo $cadena;











 ?>
