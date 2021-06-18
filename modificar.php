<?php 

  include "db_connect.php";

  $buscar = $_GET['id'];

  $querySelect = "SELECT rut, nombres, apellido_paterno, apellido_materno, email FROM personas where id = ".$buscar;

  $resultSelect = mysqli_query($conn, $querySelect);

  $rowcount=mysqli_num_rows($resultSelect);

  if ($rowcount >= 0){ 

    $row = mysqli_fetch_assoc($resultSelect);
    $id = $buscar;
    $rut = $row["rut"];
    $nombres = $row["nombres"];
    $apellido_paterno = $row["apellido_paterno"];
    $apellido_materno = $row["apellido_materno"];
    $email = $row["email"];

  }

?>

<html>

<head>

<meta name="viewport" content="width=device-width, initial-scale=1">

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<link rel="preconnect" href="https://fonts.gstatic.com">

<link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;1,700&display=swap" rel="stylesheet">

<link rel="stylesheet" href="css/style.css">

<link rel="stylesheet" href="css/normalize.css">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

<link rel="apple-touch-icon-precomposed" href="https://www.phpzag.com/wp-content/uploads/2019/05/cropped-cropped-coollogo_com-7816453-60x60-180x180.png" />

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<meta name="msapplication-TileImage" content="https://www.phpzag.com/wp-content/uploads/2019/05/cropped-cropped-coollogo_com-7816453-60x60-270x270.png" /><title>IACC</title>

<script type="text/javascript" src="form.js"></script>

<script type="text/javascript" src="multi_form_action.js"></script>



<style type="text/css">

  #register_form fieldset:not(:first-of-type) {

    display: none;

  }

</style>

<style>

body {

  /*background-image: url('img/Fondo.png');*/

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

<script>

function validarRut(rut){

   var ExpresionRut = /^\d{1,8}-{1}[0-9kK]{1}$/;

   if (!ExpresionRut.test(rut)){

      return 1

   }

}



function validarCorreo(correo){

   var ExpresionCorreo = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/;

   if (correo == ""){

      return ""

   }else{

      if (!ExpresionCorreo.test(correo)){

      return 1

      }

   }

}



function validarLetras(texto){

    var ExpresionLetras = /^[a-z A-Z ñÑ]*$/;

    if (texto == ""){

      return ""

    }else{

      if (!ExpresionLetras.test(texto)){

        return 1

      }

    }

}



function validarNumeros(texto){

    var ExpresionNumeros = /^[0-9]+$/;

    if (texto == ""){

      return ""

    }else{

      if (texto.length < 9){

        return 2

      }      



      if (!ExpresionNumeros.test(texto)){

        return 1

      }

    }  

}



function valida_envia(){

  rut = document.fvalida.rut.value
  rut = validarRut(rut) 
  if (rut == 1){
     //alert("Rut inválido")
    swal({
      title: "Rut Inválido",
      text: "Favor ingrese formato correcto",
      icon: "warning",
    })
     document.fvalida.rut.focus()
     return false;         
  }   

  nombres = document.fvalida.nombres.value
  nombres = validarLetras(nombres)
  if (nombres == ""){
 //       alert("Debe ingresar un nombre")
    swal({
      title: "Ingrese Nombres",
      text: "Favor ingrese nombres de usuario",
      icon: "warning",
    }) 
        document.fvalida.nombres.focus()
        return false;
  }else{
    if (nombres == 1){
        //alert("Nombre Inválido")
    swal({
      title: "Nombre Inválido",
      text: "Favor ingrese sólo letras",
      icon: "warning",
    })        
        document.fvalida.nombres.focus()
        return false;
    }
  }

  apellidopat = document.fvalida.apellidopat.value
  apellidopat = validarLetras(apellidopat)
  if (apellidopat == ""){
        //alert("Debe ingresar apellido paterno")
    swal({
      title: "Ingrese Apellido Paterno",
      text: "Favor ingrese apellido paterno de usuario",
      icon: "warning",
    })        
        document.fvalida.apellidopat.focus()
        return false;
  }else{
    if (apellidopat == 1){
        //alert("Apellido Paterno Inválido")
    swal({
      title: "Apellido Paterno Inválido",
      text: "Favor ingrese sólo letras",
      icon: "warning",
    })        
        document.fvalida.apellidopat.focus()
        return false;
    }
  }  

  apellidomat = document.fvalida.apellidomat.value
  apellidomat = validarLetras(apellidomat)
  if (apellidomat == ""){
        //alert("Debe ingresar apellido materno")
    swal({
      title: "Ingrese Apellido Materno",
      text: "Favor ingrese apellido materno de usuario",
      icon: "warning",
    })          
        document.fvalida.apellidomat.focus()
        return false;
  }else{
    if (apellidomat == 1){
        //alert("Apellido Materno Inválido")
    swal({
      title: "Apellido Materno Inválido",
      text: "Favor ingrese sólo letras",
      icon: "warning",
    })          
        document.fvalida.apellidomat.focus()
        return false;
    }
  }


  email = document.fvalida.email.value
  email = validarCorreo(email)
  if (email==""){
     //alert("Debe ingresar un correo");
    swal({
      title: "Ingrese Email",
      text: "Favor ingrese email de usuario",
      icon: "warning",
    })      
     document.fvalida.email.focus()
     return false;  
  }else{
     if (email == 1){
        //alert("El correo no es válido");
    swal({
      title: "Ingrese Email Válido",
      text: "Favor ingrese formato correcto con @ y extensión",
      icon: "warning",
    })         
        document.fvalida.email.focus()
        return false; 
     }     
  }

  celular = document.fvalida.celular.value
  celular = validarNumeros(celular)
  if (celular == ""){
        //alert("Debe ingresar número de celular")
    swal({
      title: "Ingrese N° de Celular",
      text: "Favor ingrese celular de usuario",
      icon: "warning",
    })         
        document.fvalida.celular.focus()
        return false;
  }else{

    if (celular == 2){
        //alert("Número de celular inválido, faltan dígitos")
    swal({
      title: "N° de Celular Inválido",
      text: "Favor complete los 9 dígitos",
      icon: "warning",
    })           
        document.fvalida.celular.focus()
        return false;
    }

    if (celular == 1){
        //alert("Número de celular inválido, ingrese sólo números")
    swal({
      title: "N° de Celular Inválido",
      text: "Favor ingrese sólo números",
      icon: "warning",
    })           
        document.fvalida.celular.focus()
        return false;
    }
  }  
  //el formulario se envia
  document.fvalida.submit();
}
</script>  

</head>

<body>



<div class="barra2">

  <div class="barra2__interior contenedor">

    <a href="listar.php">listar</a>

  </div>

</div>

<div class="container">

<div class="container-form">

<form class="formulario" name="fvalida" method="post" style="margin:0 auto" action="listarm.php" onsubmit="return valida_envia()" >    

  <legend class="legend">Modificar Usuario</legend>

  <div class="contenedor-campos">

          <div class="campo">

            <label class="">Rut</label>

            <input type="text" class="input" name="rut" id="rut" maxlength="10" value="<?php echo $rut ?>" readonly="readonly"/> 

          </div>

          <div class="campo">

              <label class="">Nombres</label>

              <input type="text" class="input" name="nombres" id="nombres" value="<?php echo $nombres ?>" />

          </div>

          <div class="campo">

            <label class="">Apellido Paterno</label>

            <input type="text" class="input" name="apellidopat" id="apellidopat" value="<?php echo $apellido_paterno ?>" />

          </div>

          <div class="campo">

              <label class="">Apellido Materno</label>

              <input type="text" class="input" name="apellidomat" id="apellidomat" value="<?php echo $apellido_materno ?>" />

          </div>

          <div class="campo">

            <label class="">Email</label>

            <input type="text" class="input" name="email" id="email" value="<?php echo $email ?>" />

          </div>

   </div>      

 <div class="row">

    <div class="col-md-4 form-group text-center">

    </div>

    <div class="col-md-4 form-group text-center">

<input type="submit" value="Registrarse" class="btn btn-success right boton" /> 

    </div>

    <div class="col-md-4 form-group text-center">

    </div>

</div>

</form>

</div>

<div class="modal fade" id="modal_exito" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3 class="modal-title">Usuario modicado correctamente</h3>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

</div>

</body>

</html>



