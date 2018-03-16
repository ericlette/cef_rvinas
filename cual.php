<?php





$server = "localhost";
$usuario = "root";
$contra = "MyNewPass";
$basedato = "profesorado_cef";

$id_materia = 1;
$id_alumno = 1;
//echo "id_materiaORIGINAL===".$_GET['id_catedra'];

try {
  $con = new PDO('mysql:host='.$server.';dbname='.$basedato.'', "$usuario", "$contra");
  $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $sql = $con->prepare('SELECT c_regularizado,c_aprobado FROM correlatividades WHERE id_materia = '.$id_materia.'');
  $sql->execute();

   if($sql->fetch(PDO::FETCH_ASSOC) == true) {

    while($datos = $sql->fetch(PDO::FETCH_ASSOC)){
      echo "ENTRÓ AL WHILE";
    //  $c_regularizado = @explode('-', $datos[c_regularizado]);
    //  $c_aprobado = @explode('-', $datos[c_aprobado]);

    echo "LOS DATOS====".$datos[c_aprobado];
  //  echo "EL FETCH====".$sql->fetch(PDO::FETCH_ASSOC);
      echo $datos[c_regularizado];
    }}else{
      echo "No trajo nada";
    }}
    catch(PDOException $e) {
      echo 'ERROR...
      "USTED YA SE ENCUENTRA INSCRIPTO A ESTA MATERIA. "
      " O NO SE HA PODIDO ESTABLECER UNA CONEXION CON EL SERVIDOR"
      "INTENTELO MAS TARDE."';
    }
?>
