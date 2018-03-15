<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">



<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" >
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="image/fonts/style.css">
<link rel="stylesheet" type="text/css" href="image/style.css">


<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script> 

<!-- Estilos de la tabla los input son hechos con bootstrap -->
 

<style type="text/css">
*{color:blue;}
  body{
     background-color:white;
     background-size:100% 100%;
     background-attachment:fixed;
     background-position:center;
     background-repeat:no-repeat;

    
  }

  .icon-menu{
    color:white;
    size:100px;
  }

  .form-conatiner{
    border:1px solid #aaa;
    padding:30px 30px; margin-top:8vh;
    -webkit-box-shadow: -1px 4px 26px 9px rgba(0,0,0,0.7);
    -moz-box-shadow: -1px 4px 26px 9px rgba(0,0,0,0.7);
    box-shadow: -1px 4px 26px 9px rgba(0,0,0,0.7);

    border-radius: 10px 10px 10px 10px;
    -moz-border-radius: 10px 0px 10px 10px;
    -webkit-border-radius: 10px 10px 10px 10px;
    border: 0px solid #000000;
  }
.white {
    background-color:#FFFFFF;
    color:#000000;
}

.black {
    background-color:#000000;
    color:#FFFFFF;
}

a{
  color:white;
}
</style>

  <title>Inscripcion final</title>



</head>
<body>



<nav style="background-color:#0D0C0C" class="navbar navbar-dark  fixed-top    navbar-toggleable-md">

  <button class="navbar-toggler navbar-toggler-right " type="button"  id="btn-menu" >
      <span style="background-origin:white;" class="icon-menu"></span>
    </button>


  <a class="navbar-brand" href="login_exitoso.php">
    <span class="icon-brand35" ></span>
    rofesorado CEFN5
  </a>

 <div class="collapse  navbar-collapse" id="menu">
  <div class="navbar-nav">
      
      <a  class="nav-item nav-link " href="#">Inscripcion Materias</a>
      <a class="nav-item nav-link " href="#">Inscripcion Final</a>
      <a class="nav-item nav-link " href="#">Ver plan de estudios</a>
      <a class="nav-item nav-link " href="#">Obtener crtificados</a>
      
   
    </div>
    </div>
</nav>


<div class="container-fluid bg">




 <div class="row justify-content-center">
    <div class="col">
    <div class="alert alert-danger " style="display:none;  margin-top:8vh;" id="alert" role="alert">
  <p id="texto_alert">  </p>
</div>
</div>
</div>



  <div class="row justify-content-center ">
   <div class="col-md-4 form-conatiner align-self-center">
         

                
          <!-- esta es la primer columna de la primera fila -->

          <div class="list-group">
  <a href="#" class="list-group-item list-group-item-action active">
    Seleccionar materia
  </a>
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
      'SELECT id_catedra,nombre,ano FROM catedras'
    );

    $sql->execute();

  $cadena = "";


    while( $datos = $sql->fetch(PDO::FETCH_ASSOC)){


      $cadena.='

      <a style="color:blue;" type="text" id="a'.$datos['id_catedra'].'" onClick="trae_items('.$datos['id_catedra'].','.$id_alumno.');"  class="list-group-item list-group-item-action ">'.$datos['nombre'].'</a>';
      
     
    }
     
  } catch(PDOException $e) {
    echo 'Error: ' . $e->getMessage();
  }

  echo $cadena;

?>


        </div>    
          </div>






    
      

            <div class="col-md-4">
   <!-- esta es la segunda columna de la primera fila -->

        <form class="form-conatiner "  id="formulario" action="registrar_inscripcion_a_examen.php" method="GET" >
        <h3 style="text-align:center; color: rgba(0,0,0,0.8);">INSCRIPCION DE EXAMEN </h3>
        <div class="row">
  <div class="col" >
    <label for="">NRO MATERIA</label>

    <input type="text" class="form-control"  name="nombre_materia" readonly="" id="nombre_materia" aria-describedby="emailHelp" >

  </div>
  <div class="col">
    <label >FECHA DE EXAMEN</label>
    <input type="text" class="form-control" id="fecha_examen" readonly="" name="fecha_examen">
  </div>

</div>


<div class="row">
<div class="col">
    <label >FECHA Y HORA ACTUAL</label>
    <input type="text" class="form-control" id="fecha_y_hora_actual" readonly=""  name="fecha_y_hora_actual" >
  </div>

<div class="col">
    <label >HORA DE EXAMEN</label>
    <input type="text" class="form-control" id="hora_final" readonly=""  name="fecha_y_hora_actual" >
  </div>



  </div>



<div class="row">
  <div class="col-8">
    <label >CONDICION</label>
    <select class="form-control" name="condicion" >
    <option value="REGULAR">REGULAR</option>
    <option value="LIBRE">LIBRE</option>
    </select>
   
  </div>
  </div>
  <br>




  <button type="button"  id="btn-registrar" class="btn btn-outline-primary btn-block  " >Inscribirme </button>
   <div id="res"></div>


</form>
    </div>
    
<div class="col">
    

    <div id="reporte"></div>

    </div>
    </div>

<br>  <br>

     <div class="row justify-content-center ">
    
   

       <div class="col  align-self-center">
         

                
          <!-- esta seria la tercer  columna de la primera fila donde iria el comprobante -->

          <div class="list-group" id="muestra_inscripcion">
 
 
  

        
        </div>    
          </div>



    </div>
    
  

  
   
    </body>







  

<br>
<br>








<script type="text/javascript"> 



 




//FUNCION QUE TRAE LOS PARAMETROS DE ID ALUMNO Y MATERIA, MOSTRANDO UN ALERT 
//INDICANDO  QUE MATERIA HEMOS SELECCIONADO 

   function trae_items(id_materia,id_alumno){


      $("html, body").animate({scrollTop:"0px"});

      var nombre = $("#a"+id_materia).text();
      var id = id_materia ;
        var id_alumno = id_alumno ;

      $("#texto_alert").text("Usted selecciono la matria: "+nombre)
         $("#alert").each(function() {
              displaying = $(this).css("display");
                  if(displaying == "none") {
                       $(this).fadeOut('slow',function() 

                                           {

           $("#texto_alert").text("Usted selecciono la matria: "+nombre)
           $(this).css("display","block");
          
          });
        } 
      });



         //ENVIA ID DE MATERIA AL SERVIDOR
         //Y OBTIENE LOS DATOS DE EXAMEN DE ESE ID_MATERIA

    
        var parametros = {
          
          "id_materia":id
        };
        var url = "trae_datos_del_final.php";

        $.ajax({                        
           type: "GET",                 
           url: url,                    
           data: parametros,
           dataType: "json",
           success: function(data)            
           {   
        $('#hora_final').val(data.hora_final);
        $('#fecha_examen').val(data.fecha_final);
        $('#nombre_materia').val(id);

        

          var f = new Date();

            $('#fecha_y_hora_actual').val(f.getFullYear() + "-" + (f.getMonth() +1) + "-" + f.getDate() + " " + f.getHours() + ":" + f.getMinutes() + ":" + f.getSeconds());
            
          
           }
         });



      
}






//FUNCION PARA EL MENU


$(document).ready(function(){



   $("#btn-menu").click(function () {
      $("#menu").each(function() {
        displaying = $(this).css("display");
        if(displaying == "block") {
          $(this).fadeOut('slow',function() {
           $(this).css("display","none");
          });
        } else {
          $(this).fadeIn('slow',function() {
            $(this).css("display","block");
          });
        }
      });
    });
  });


  





</script>



</body>
</html>
