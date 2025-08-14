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
        <form action="addtareaaction.php" method="post">
            Materia:
            <select name="materia">
             <?php 
             while($filatipo=$resulttipo->fetch_assoc()){
                
              
                    echo "<option value=".$filatipo['id_tipo'].">".$filatipo['nombre']."</option>";
            
             }
            ?>
            </select> <br>
            Nombre:
            
            <textarea ROWS="3" COLS="35" NAME="nombre"></textarea> <br> 
            Descripcion:
            
            <textarea ROWS="15" COLS="70" NAME="descr"></textarea> <br> 
            Fecha Limite : 
            <input type="date" name="fechalim" value=""> <br>
      

             <INPUT TYPE="submit" VALUE="Agregar">    
            </select> <br>

        </form>
    </body>
</html>