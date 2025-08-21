<?php 
$fuente=$_REQUEST['fuente'];
$nombre=$_REQUEST['nombre'];
$link=$_REQUEST['link'];

$servidor="localhost";
$usuario="root";
$contra="";
$bd="tarea";

$con=new mysqli($servidor, $usuario, $contra, $bd);

if($con->connect_error){
    die("Conexion fallida: ". $con->connect->error );
}


$sql="INSERT INTO prob (titulo, link, id_tipo, hecho) VALUES ('$nombre','$link',$fuente, 0)";
if($con->query($sql)){
    //yey
}
else{
    echo "". $con->error;
}

header("Location: info.php");
?>