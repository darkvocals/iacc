<?php
error_reporting(E_PARSE);

/*
$servername = "ingedeus.cl";
$username = "ingedeus_iacc";
$password = "passwordiacc";
$dbname = "ingedeus_iacc";
$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
*/

//Nombre de usuario de mysql
 const USER = "ingedeus_iacc";

//Servidor de mysql
 const SERVER = "ingedeus.cl"; 

//Nombre de la base de datos
const BD = "ingedeus_iacc";

//Contraseña de myqsl
const PASS = "passwordiacc";

//Carpeta donde se almacenaran las copias de seguridad
const BACKUP_PATH =  "../backup/";

/*Configuración de zona horaria de tu país para más información visita
    http://php.net/manual/es/function.date-default-timezone-set.php
    http://php.net/manual/es/timezones.php
*/
date_default_timezone_set('America/Chile');


class SGBD{
    //Funcion para hacer consultas a la base de datos
    public static function sql($query){
        $con=mysqli_connect(SERVER, USER, PASS, BD);
        mysqli_set_charset($con, "utf8");
        if (mysqli_connect_errno()) {
            printf("Conexion fallida: %s\n", mysqli_connect_error());
            exit();
        }else{
            mysqli_autocommit($con, false);
            mysqli_begin_transaction($con, MYSQLI_TRANS_START_WITH_CONSISTENT_SNAPSHOT);
            if($consul=mysqli_query($con, $query)){
                if (!mysqli_commit($con)) {
                    print("Falló la consignación de la transacción\n");
                    exit();
                }
            }else{
                mysqli_rollback($con);
                echo "Falló la transacción";
                exit();
            }
            return $consul;
        }
    }  

    //Funcion para limpiar variables que contengan inyeccion SQL
    public static function limpiarCadena($valor) {
        $valor=addslashes($valor);
        $valor = str_ireplace("<script>", "", $valor);
        $valor = str_ireplace("</script>", "", $valor);
        $valor = str_ireplace("SELECT * FROM", "", $valor);
        $valor = str_ireplace("DELETE FROM", "", $valor);
        $valor = str_ireplace("UPDATE", "", $valor);
        $valor = str_ireplace("INSERT INTO", "", $valor);
        $valor = str_ireplace("DROP TABLE", "", $valor);
        $valor = str_ireplace("TRUNCATE TABLE", "", $valor);
        $valor = str_ireplace("--", "", $valor);
        $valor = str_ireplace("^", "", $valor);
        $valor = str_ireplace("[", "", $valor);
        $valor = str_ireplace("]", "", $valor);
        $valor = str_ireplace("\\", "", $valor);
        $valor = str_ireplace("=", "", $valor);
        return $valor;
    }
}