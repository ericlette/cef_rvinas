<?php


$server = "localhost";
$usuario = "root";
$contra = "MyNewPass";
$basedato = "profesorado_cef";

$id_materia = $_GET['id_catedra'];
$id_alumno = $_GET['id_alumno'];


try {
  $con = new PDO('mysql:host='.$server.';dbname='.$basedato.'', "$usuario", "$contra");
  $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


  $sql = $con->prepare('SELECT c_regularizado,c_aprobado FROM correlatividades WHERE id_materia = '.$id_materia.'');
  $sql->execute();

  while($datos = $sql->fetch(PDO::FETCH_ASSOC)){
	$correlativa = $datos['c_regularizado'];
	$materia_aprobada = $datos['c_aprobado'];

}

	$corre = @explode('-', $correlativa);
	$mat_aprob = @explode('-', $materia_aprobada);
	$contador=0;
	$contador1=0;


foreach($corre as $llave => $valores)
{
    //echo $valores."<br>";
    $contador++;
}


foreach($mat_aprob as $llave => $valores1)
{
    //echo $valores1."<br>";
    $contador1++;
}




	$apto = "true";
  $sql = $con->prepare('SELECT condicion,id_materia FROM historial_alumnos_catedras WHERE id_materia = :id_materia AND id_alumno = :id_alumno');

for ($i=0; $i < $contador; $i++) {
	$sql->execute(array(':id_materia' => $corre[$i], ':id_alumno' => $id_alumno ));


  	while( $datos = $sql->fetch(PDO::FETCH_ASSOC))
    	if($datos['condicion'] == "APROBADO"){

    		//echo "la materia: ".$corre[$i].'Esta:'.$datos['condicion'].'<br>';

    	}
    	else{

    		//echo "la materia: ".$corre[$i].'Esta:'.$datos['condicion'].'<br>';
    		$apto = "false";

    		$aviso = "DEBE PRIMEO REGULARIZAR LA MATERIA :".$corre[$i]."PARA PODER INSCRIBIRSE A ESTA MATERIA";

    	}
 	}



	$sql = $con->prepare('SELECT nota,id_materia FROM historial_alumnos_catedras WHERE id_materia = :id_materia AND id_alumno = :id_alumno');


for ($i=0; $i < $contador1; $i++) {
	$sql->execute(array(':id_materia' => $mat_aprob[$i], ':id_alumno' => $id_alumno ));


  	while( $datos = $sql->fetch(PDO::FETCH_ASSOC)) {
      if($datos['nota'] >= 4){

        //echo "la materia: ".$mat_aprob[$i].'Esta ACREDITADA <br>';

      }
      else{

        //echo "la materia: ".$mat_aprob[$i].'Esta DESACREDITADA <br>';
        $apto = "false";

        $aviso = ". DEBE PRIMERO APROBAR LA MATERIA : ".$mat_aprob[$i]." PARA PODER INSCRIBIRSE A ESTA MATERIA";

      }
    }
 	}


if($apto == "true" ){


  $sql = $con->prepare(
    'INSERT INTO alumnos_catedras (id_alumno,id_materia) VALUES (:alumno,:materia)'
  );

  // if($sql->execute(array(':alumno'=>$id_alumno , ':materia'=> $id_materia))){
  // 	echo "USTED SE INSCRIBIO A LA MATERIA: ".$id_materia;
  // }}
  $sql->execute(
    array(
      ':alumno'=>$id_alumno,
      ':materia'=> $id_materia
    )
  );
  // {
  	// echo "USTED SE INSCRIBIO A LA MATERIA: ".$id_materia;
  // }
}

else{
	echo "USTED NO SE PUEDEN INSCRIBIR A ESTA MATERIA".$aviso;
}

} catch(PDOException $e) {

  echo 'ERROR...
  "USTED YA SE ENCUENTRA INSCRIPTO A ESTA MATERIA. "
  " O NO SE HA PODIDO ESTABLECER UNA CONEXION CON EL SERVIDOR"
  "INTENTELO MAS TARDE."';
}






 ?>
