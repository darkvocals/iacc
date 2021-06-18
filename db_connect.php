<?php
$servername = "ingedeus.cl";
$username = "ingedeus_iacc";
$password = "passwordiacc";
$dbname = "ingedeus_iacc";
$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
?>