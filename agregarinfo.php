<?php 
$servidor="localhost";
$usuario="root";
$contra="";
$bd="tarea";

$con=new mysqli($servidor, $usuario, $contra, $bd);

if($con->connect_error){
    die("Conexion fallida: ". $con->connect->error );
}


$sqltipo="SELECT * FROM tipo";
$resulttipo= $con->query($sqltipo);


?>
<style>
    table {
        border-collapse: collapse;
        width: 60%;
        margin: 20px auto;
    }
    th, td {
        padding: 8px 12px;
        text-align: center;
    }
    th {
        background-color: #eee;
    }
    tr {
        border-bottom: 1px solid #ccc;
    }
</style>
<html>
    <body>  
        <form action="addinfoaction.php" method="post">
            Materia:
            <select name="fuente">
             <?php 
             while($filatipo=$resulttipo->fetch_assoc()){
                
                if($filatipo['id_tipo']==11){
                    echo "<option value=".$filatipo['id_tipo']." SELECTED >".$filatipo['nombre']."</option>";
                }
                else{
                    echo "<option value=".$filatipo['id_tipo'].">".$filatipo['nombre']."</option>";
                }
             }
            ?>
            </select> <br>
            Titulo:
            
            <textarea ROWS="3" COLS="35" NAME="nombre"></textarea> <br> 
            Link:
            
            <textarea ROWS="3" COLS="35" NAME="link"></textarea> <br> 

             <INPUT TYPE="submit" VALUE="Agregar">    
            </select> <br>

        </form>
    </body>
</html>