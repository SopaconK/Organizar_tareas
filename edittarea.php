<?php 
$idtarea=$_REQUEST['id'];
$servidor="localhost";
$usuario="root";
$contra="";
$bd="tarea";

$con=new mysqli($servidor, $usuario, $contra, $bd);

if($con->connect_error){
    die("Conexion fallida: ". $con->connect->error );
}


$sql="SELECT * FROM tarea WHERE tarea.id_tarea=$idtarea";
$result= $con->query($sql);
$fila=$result->fetch_assoc();

$sqltipo="SELECT * FROM tipo";
$resulttipo= $con->query($sqltipo);
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Editar problema</title>
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

            .boton {
                font-size: 20px;         
                padding: 10px 20px;      
                border: none;            
                border-radius: 8px;
                cursor: pointer;         
                font-weight: bold;       
                border: 3px solid black; 
                transition: background-color 0.5s; 
            }

            .boton:hover {
                background-color: #000000;
                color: white;
            }

            .botoninside {
                font-size: 15px;         
                padding: 5px 15px;      
                border: none;            
                border-radius: 8px;
                cursor: pointer;         
                font-weight: bold;       
                border: 3px solid black; 
                transition: background-color 0.5s; 
            }

            .botoninside:hover {
                background-color: #000000;
                color: white;
            }

            .textareas {
                font-size: 17px;
                font-weight: bold;
                margin-top:10px;
                display: block;
            }

            .textosaux {
                font-size: 17px;
                font-weight: bold;
                margin-top:10px;
                display: block;
            }
        </style>
    </head>
    <body>  
        <form action="acttarea.php" method="post">
            <label class = "textosaux" for = "ids"> ID: <?php echo $fila['id_tarea']?> <br> </div>
            <input id = "ids" type="hidden" name="id" value="<?php echo $fila['id_tarea']?>">
            
            <label class = "textosaux" for = "materia">Materia:</label>
            <select id = "materia" name="materia">
                <?php
             
                while($filatipo=$resulttipo->fetch_assoc()){
                
                    if( $filatipo['id_tipo'] == $fila['id_tipo'] ){
                    
                        echo '<option value="'.$filatipo['id_tipo'].'"SELECTED >'.$filatipo['nombre']."</option>";
                    }
                    else{
                        echo "<option value=".$filatipo['id_tipo'].">".$filatipo['nombre']."</option>";
                    }
                }
                ?>
            </select> <br>

            <label class = "textosaux" for="textn">Nombre:</label>
            <textarea id="textn" ROWS="3" COLS="70" NAME="nombre"> <?php echo $fila['nombre']?> </textarea> <br>
            
            <label class = "textosaux" for="textd">Descr:</label>
            <textarea id="textd" ROWS="15" COLS="70" NAME="descr"> <?php echo $fila['descr']?> </textarea> <br>
            
            <label class = "textosaux" for="textdl">Fecha limite:</label>
            <input type="date" name="fechalim" value=""> <br>
            
            
            
            <INPUT TYPE="submit" VALUE="Actualizar" class="boton"> 

        </form>
    </body>
</html>