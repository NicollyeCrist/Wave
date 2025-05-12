<?php

$hostname = "localhost";
$db = "mesominds";
$user = "root";
$pass = "";

$mysqli = new mysqli($hostname, $user, $pass, $db);

if($mysqli->connect_errno){
    echo "falha ao conectar:(".$mysqli->connect_errno .")" . $mysqli->connect_error;
}else {
}
?>