<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">


    <script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" >



	<title>Inscripcion a Materias</title>



</head>
<body>

<div class="container">

 
<table class="table">
  <thead class="thead-dark">
	<tr>
	

		 <th scope="col">#NRO</th>
      
      <th scope="col">NOMBRE MATERIA</th>
      <th scope="col">AÑO</th>
       <th scope="col">FORMATO</th>
      <th scope="col">REGIMEN</th>
      <th scope="col">INSCRIBIR</th>
      


	</tr>
   </thead>
   <tbody>
	<?php 


	$id_alumno = 1;

	$server = "localhost";
$usuario = "root";
$contra = "";
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


  	$cadena.="<th scope='row'>".$datos['id_catedra']."</th> 
  	 
  	 <td>".$datos['nombre']."</td>
  	 <td>".$datos['ano']."</td>
  	 <td>".$datos['formato']."</td>	
  	 <td>".$datos['regimen_c']."</td>
  	 <td><button class='btn btn-outline-primary' onclick='inscribir(".$id_alumno.",".$datos['id_catedra'].")'>Aqui</button></td>";
  	

$cadena.="</tr>";
  }
   
} catch(PDOException $e) {
  echo 'Error: ' . $e->getMessage();
}


$cadena.="</tr>";
echo $cadena;


 ?>

</tbody>
</table>



</div>

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
