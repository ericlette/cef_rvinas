<?php

$server = "localhost";
$usuario = "root";
$contra = "MyNewPass";
$basedato = "profesorado_cef";

$id_materia = $_GET['id_catedra'];
$id_alumno = $_GET['id_alumno'];

$c_regularizado[0] = '';
$c_aprobado[0] = '';

echo "id_materiaORIGINAL===".$_GET['id_catedra'];

try {
  $con = new PDO('mysql:host='.$server.';dbname='.$basedato.'', "$usuario", "$contra");
  $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $sql = $con->prepare('SELECT c_regularizado,c_aprobado FROM correlatividades WHERE id_materia = '.$id_materia.'');
  $sql->execute();


    while($datos = $sql->fetch(PDO::FETCH_ASSOC)){


     $c_regularizado = @explode('-', $datos[c_regularizado]);
     $c_aprobado = @explode('-', $datos[c_aprobado]);

    foreach ($c_regularizado as $key => $value) {

    }

      // lO COMENTE YO
      // if($c_regularizado[0] == '') {
      //   echo "c_regularizado era null";
      // }
      // else {
      //   echo "esto es lo que trae c_regularizado: ".$c_regularizado[0];
      // }
      // if($c_aprobado[0] == '') {
      //   echo "c_aprobado era null";
      //   // $c_aprobado[0] = 0;
      // }
      // else {
      //   echo "esto es lo que trae c_aprobado: ".$c_aprobado[0];
      // }
    }
  // }
  // else {
  //   $c_regularizado[0] = '';
  //   $c_aprobado[0] = '';
  // }

	// $corre = @explode('-', $correlativa);
  // echo "corre=".$corre[0]."   -    ";
	// $mat_aprob = @explode('-', $materia_aprobada);
  // echo "mat_aprob=".$mat_aprob[0];
	$contador=0;
	$contador1=0;

  // echo "ECHOECHO=".$c_regularizado[1];
  // echo "existe el c_reg ".$c_regularizado;

  foreach($c_regularizado as $llave => $valores) {
      //echo $valores."<br>";
      $contador++;
  }

  foreach($c_aprobado as $llave => $valores1) {
      //echo $valores1."<br>";
      $contador1++;
  }
  //
  // echo "contador=".$contador;
  // echo ",,,contador1=".$contador1;

	$apto = "true";
  $sql = $con->prepare('SELECT condicion,id_materia FROM historial_alumnos_catedras WHERE id_materia = :id_materia AND id_alumno = :id_alumno');

  // echo "aaaaaaa".$c_regularizado[0];

if($c_regularizado[0] != '') {

  // echo "ESTO A LA QUE ESTAMOS BUSCANDO";
  for ($i=0; $i < $contador; $i++) {
    // echo "entró a este for el primero";
    $sql->execute(array(':id_materia' => $c_regularizado[$i], ':id_alumno' => $id_alumno ));

    // echo "### c_regularizado = ".$c_regularizado[$i];

    while( $datos = $sql->fetch(PDO::FETCH_ASSOC)){
    // echo "entró al while el primero";
    // echo $datos['condicion'];
    if($datos['condicion'] == "APROBADO") {
      // echo "la materia: ".$corre[$i].'Esta:'.$datos['condicion'].'<br>';
      // echo ".....verdadero1.....";
    }
    else {
      // echo "la materia: ".$corre[$i].'Esta:'.$datos['condicion'].'<br>';
      // echo "falso1";
      $apto = "false";
      $aviso = "DEBE PRIMEO REGULARIZAR LA MATERIA :".$c_regularizado[$i]."PARA PODER INSCRIBIRSE A ESTA MATERIA";
    }
  }
}}


    $sql = $con->prepare('SELECT nota,id_materia FROM historial_alumnos_catedras WHERE id_materia = :id_materia AND id_alumno = :id_alumno');

    for ($i=0; $i < $contador1; $i++) {
      // echo "entró al for ----";
      // echo "el i es igual a ".$i;
      // echo "id_materia =".$c_aprobado[$i];
      // echo "<br>";
      // echo "id_alumno =".$id_alumno;
      $sql->execute(array(':id_materia' => $c_aprobado[$i], ':id_alumno' => $id_alumno ));
      // $sql->execute(array(':id_materia' => $materia_aprobada, ':id_alumno' => $id_alumno ));

      while( $datos = $sql->fetch(PDO::FETCH_ASSOC)) {
        // echo "entró al while ";

        // echo "ESTAS SON LAS NOTAS ".$datos['nota'];
        if($datos['nota'] >= 4) {
          // echo "la materia: ".$mat_aprob[$i].'Esta ACREDITADA <br>';
          // echo "verdadero2";
        }
        else {
          // echo "la materia: ".$mat_aprob[$i].'Esta DESACREDITADA <br>';
          echo "falso2";
          $apto = "false";
          $aviso = ". DEBE PRIMERO APROBAR LA MATERIA : ".$c_aprobado[$i]." PARA PODER INSCRIBIRSE A ESTA MATERIA";
        }
      }
    }


  if($apto == "true" ){
    // echo "recontra apto";
    $sql = $con->prepare(
      'INSERT INTO alumnos_catedras (id_alumno,id_materia) VALUES (:alumno,:materia)'
    );
    // echo "id_alumno====".$id_alumno;
    // echo ' - ';
    // echo "id_materia====".$id_materia;
    if($sql->execute(array(':alumno'=>$id_alumno, ':materia'=> $id_materia))){
    	echo "USTED SE INSCRIBIO A LA MATERIA: ".$id_materia;
    }
    // $sql->execute(
    //   array(
    //     ':alumno'=>$id_alumno,
    //     ':materia'=> $id_materia
    //   )
    // );
  }
  // {
  // 	echo "USTED SE INSCRIBIO A LA MATERIA: ".$id_materia;
  // }

  //
  else {
    echo "USTED NO SE PUEDEN INSCRIBIR A ESTA MATERIA".$aviso;
  }
}
catch(PDOException $e) {
  echo 'ERROR...
  "USTED YA SE ENCUENTRA INSCRIPTO A ESTA MATERIA. "
  " O NO SE HA PODIDO ESTABLECER UNA CONEXION CON EL SERVIDOR"
  "INTENTELO MAS TARDE."';
}

?>
