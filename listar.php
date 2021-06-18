<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
}
?>
<html> 

<head>

   <title>IACC</title>

	<meta name="viewport" content="width=device-width, initial-scale=1">

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />   

   <link rel="preconnect" href="https://fonts.gstatic.com">

   <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;1,700&display=swap" rel="stylesheet">

   <link rel="stylesheet" href="css/style.css">

   <link rel="stylesheet" href="css/normalize.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet"/>

<style>

body {


  background-repeat: no-repeat;

  background-attachment: fixed;

  background-size: 100% 100%;

}

</style>

<style>

body {

    overflow-x: hidden;

}

</style>

</head> 

<body>

 

<?php



include "db_connect.php";



if($_POST)

{

  $rut = mysqli_real_escape_string($conn, $_POST['rut']);

  $querySelect = "SELECT id FROM personas WHERE rut = '".$rut."'";

  $resultSelect = mysqli_query($conn, $querySelect);

  $rowcount=mysqli_num_rows($resultSelect);



  if ($rowcount <= 0){



    $nombres  = mysqli_real_escape_string($conn, $_POST['nombres']);  

    $apellidopat  = mysqli_real_escape_string($conn, $_POST['apellidopat']);

    $apellidomat  = mysqli_real_escape_string($conn, $_POST['apellidomat']);  

    $email  = mysqli_real_escape_string($conn, $_POST['email']);  

    $queryInsert = "INSERT INTO personas (rut, nombres, apellido_paterno, apellido_materno, email) VALUES ('".$rut."','".$nombres."','".$apellidopat."','".$apellidomat."','".$email."')";

    if(mysqli_query($conn, $queryInsert)) {
          $fecha = date('Y-m-d H:i:s');
          $queryInsertb = "INSERT INTO bitacora (usuario, accion, descripcion, fecha) VALUES ('".$_SESSION["usuario"]."','agregar','".$rut."','".$fecha."')";

          if(mysqli_query($conn, $queryInsertb)) {
              
          }else{
            echo "error al insertar bitácora";
          }

      }else{

        echo "error al insertar";

      }

  }else{

      ?>

    

  <div class="barra2">

          <div class="barra2__interior contenedor">

 

          </div>

  </div>



<div class="contenedor flex">

  <div>

        <h2 class="titulo">Usuario ya fue ingresado anteriormente</h2>

  </div>

</div>



      <?

  }



}



//mysqli_free_result($result); 
?>
          <div class="contenedor">

      <div class="barra2">

              <div class="barra2__interior contenedor">

                <a href="ingreso.php" class="btn btn-danger">Volver</a>

              </div>

      </div>            

            <?php  

            $result = mysqli_query($conn, "SELECT id, rut, nombres, apellido_paterno, apellido_materno, email FROM personas order by apellido_paterno ASC");

            if ($row = mysqli_fetch_assoc($result)){ 
               echo "<table border = '2' BORDERCOLOR=#cccccc width=100%> \n"; 
               echo "<tr height:2px><td><b> RUT </b></td><td><b> NOMBRES </b></td><td><b> APELLIDO PATERNO </b></td><td><b> APELLIDO MATERNO </b></td><td><b> EMAIL </b></td></tr>\n"; 
               do { 
            echo "<tr><td>".$row["rut"]."</td><td>".$row["nombres"]."</td><td>".$row["apellido_paterno"]."</td><td>".$row["apellido_materno"]."</td><td>".$row["email"]."</td><td><a href='modificar.php?id=".$row["id"]."'>Modificar</a></td><td><a href='eliminar.php?id=".$row["id"]."'>Eliminar</a></td></tr> \n"; 
               } while ($row = mysqli_fetch_assoc($result)); 
               echo "</table> \n"; 
            } else { 
            echo "No se ha encontrado ning&uacute;n registro"; 
            } 
            mysqli_close($conn);
            ?>
          </div>
<?
mysqli_close($conn); 
?>
</body> 
</html>