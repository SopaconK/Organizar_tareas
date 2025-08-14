<?php 
$materia=$_REQUEST['materia'];
$nombre=$_REQUEST['nombre'];
$descr=$_REQUEST['descr'];
$fechalim = str_replace('T', ' ', $_REQUEST['fechalim']) . ':00';

$servidor="localhost";
$usuario="root";
$contra="";
$bd="tarea";

$con=new mysqli($servidor, $usuario, $contra, $bd);

if($con->connect_error){
    die("Conexion fallida: ". $con->connect->error );
}


$sql="INSERT INTO tarea (nombre, descr, id_tipo, fechalim, hecho) VALUES ('$nombre', '$descr',$materia, '$fechalim',0)";
if($con->query($sql)){
    //yey
}
else{
    echo "". $con->error;
}

header("Location: main.php");
?>