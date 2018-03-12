<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">


    <script src="//code.jquery.com/jquery-1.11.2.min.js"></script>

	<title>Inscripcion a Materias</title>


	<style type="text/css">
		
		.normal {
  width: 1024px;
  border: 1px solid #000;
}
.normal th, .normal td {
  border: 1px solid #000;
}
	</style>

</head>
<body>


 
<table class="normal" summary="Tabla genérica">
	<tr>
		<td>NRO</td>
		<td>PROFESOR</td>
		<td>NOMBRE MATERIA </td>
		<td>AÑO</td>
		<td>FOMRATO</td>
		<td>REGIMEN </td>
		<td>INSCRIBIR</td>


	</tr>


	<?php 


	$id_alumno = 1;

	$server = "localhost";
$usuario = "root";
$contra = "MyNewPass";
$basedato = "profesorado_cef";

try {
  $con = new PDO('mysql:host='.$server.';dbname='.$basedato.'', "$usuario", "$contra");
  $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $sql = $con->prepare(
    'SELECT c.id_catedra,c.id_profesor,c.nombre,c.ano,c.formato,c.regimen_c, p.nombre_y_apellido FROM catedras AS c INNER JOIN profesores AS p ON c.id_profesor = p.id_profesor'
  );

  $sql->execute();

$cadena = "";
$cadena.="<tr>";
  while( $datos = $sql->fetch(PDO::FETCH_ASSOC)){


  	$cadena.="<td>".$datos['id_catedra']."</td> 
  	 <td>".$datos['nombre_y_apellido']."</td>
  	 <td>".$datos['nombre']."</td>
  	 <td>".$datos['ano']."</td>
  	 <td>".$datos['formato']."</td>	
  	 <td>".$datos['regimen_c']."</td>
  	 <td><button onclick='inscribir(".$id_alumno.",".$datos['id_catedra'].")'>Aqui</button></td>";
  	

$cadena.="</tr>";
  }
   
} catch(PDOException $e) {
  echo 'Error: ' . $e->getMessage();
}


$cadena.="</tr>";
echo $cadena;


 ?>


</table>





</body>


<script type="text/javascript">
	

function inscribir(id_alumno,id_catedra)
{
	if(confirm("Esta seguro que desea inscribirse?")){




var parametros = {
  "id_alumno": id_alumno,
  "id_catedra": id_catedra
};

var url = "guardar_inscripcion_de_alumno_a_la_catedra.php";

 $.ajax({                        
           type: "GET",                 
           url: url,                    
           data:parametros ,

            success: function(data)            
           {
            alert(data);
             
           }




  });




		
	}

	}


</script>


<script type="text/javascript"></script>
</html>