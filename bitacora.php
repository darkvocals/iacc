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

//mysqli_free_result($result); 
?>
          <div class="contenedor">

      <div class="barra2">

              <div class="barra2__interior contenedor">

                <a href="ingreso.php" class="btn btn-danger">Volver</a>

              </div>

      </div>            

            <?php  

            $result = mysqli_query($conn, "SELECT usuario, accion, descripcion, fecha FROM bitacora order by id ASC");

            if ($row = mysqli_fetch_assoc($result)){ 
               echo "<table border = '2' BORDERCOLOR=#cccccc width=100%> \n"; 
               echo "<tr height:2px><td><b> USUARIO </b></td><td><b> ACCION </b></td><td><b> RUT </b></td><td><b> FECHA </b></td></tr>\n"; 
               do { 
            echo "<tr><td>".$row["usuario"]."</td><td>".$row["accion"]."</td><td>".$row["descripcion"]."</td><td>".$row["fecha"]."</td></tr> \n"; 
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