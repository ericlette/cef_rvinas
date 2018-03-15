<?php 


 $server = "localhost";
  $usuario = "root";
  $contra = "";
  $basedato = "profesorado_cef";

$id_materia = $_GET['id_materia'];


  try {
    $con = new PDO('mysql:host='.$server.';dbname='.$basedato.'', "$usuario", "$contra");
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = $con->prepare(
      'SELECT c.nombre,ce.fecha,ce.hora FROM calendario_examenes AS ce INNER JOIN catedras AS c   ON  ce.id_materia = c.id_catedra WHERE id_materia = :id_materia'
    );

    $sql->execute(
    	array(
          'id_materia' => $id_materia
        )

    	);



 

    while( $datos = $sql->fetch(PDO::FETCH_ASSOC)){
 

		$fecha =  $datos['fecha'];
		$hora =	$datos['hora'];
		$nombre = $datos['nombre'];


	header('Content-Type: application/json');
//Guardamos los datos en un array
$datoss = array(
		'nombre_final' => $nombre,
		'fecha_final' => $fecha,
		'hora_final' => $hora
		
);
//

		
}

 } catch(PDOException $e) {
    //echo 'Error: ' . $e->getMessage();
  }


echo json_encode($datoss, JSON_FORCE_OBJECT);

?>
