<?php
$id=$_REQUEST['id'];
$mandar=$_REQUEST['mandar'];
$servidor="localhost";
$usuario="root";
$contra="";
$bd="tarea";

$hecho = $mandar ? 0 : 1;

$con=new mysqli($servidor, $usuario, $contra, $bd);



$stmt=$con->prepare("UPDATE sat SET hecho= ? WHERE id_sat= ?");
if(!$stmt){
    die("Error al preparar la consulta: " . $con->error);
}

      $stmt->bind_param("ii", $hecho, $id);
    $stmt->execute();


//if($con->query($sql)){
    //yey
//}
//else{
//    echo "". $con->error;
//}

header("Location: sat.php");

?>