<?php 
$id=$_REQUEST['id'];

$servidor="localhost";
$usuario="root";
$contra="";
$bd="tarea";

$con=new mysqli($servidor, $usuario, $contra, $bd);

if($con->connect_error){
    die("Conexion fallida: ". $con->connect->error );
}


$sql="UPDATE prob SET hecho=false WHERE id_prob=$id";
if($con->query($sql)){
    //yey
}
else{
    echo "". $con->error;
}

header("Location: infohechos.php");
?>