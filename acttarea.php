<?php 
$materia=$_REQUEST['materia'];
$nombre=$_REQUEST['nombre'];
$descr=$_REQUEST['descr'];
$fechalim = str_replace('T', ' ', $_REQUEST['fechalim']) . ':00';
$id=$_REQUEST['id'];

$servidor="localhost";
$usuario="root";
$contra="";
$bd="tarea";

$con=new mysqli($servidor, $usuario, $contra, $bd);

if($con->connect_error){
    die("Conexion fallida: ". $con->connect->error );
}


$sql="UPDATE tarea SET nombre='$nombre', descr='$descr', id_tipo=$materia, fechalim='$fechalim' WHERE id_tarea=$id";
if($con->query($sql)){
    //yey
}
else{
    echo "". $con->error;
}

header("Location: main.php");
?>