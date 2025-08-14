<?php 
$servidor="localhost";
$usuario="root";
$contra="";
$bd="tarea";

$con=new mysqli($servidor, $usuario, $contra, $bd);

if($con->connect_error){
    die("Conexion fallida: ". $con->connect->error );
}

//$sql="SELECT * FROM problema INNER JOIN concurso ON problema.id_conc=concurso.id_conc INNER JOIN usuario ON problema.id_usuario=usuario.id_user LEFT JOIN tag_problema ON tag_problema.id_pr = problema.id_pr ORDER BY problema.id_pr";

$sql = "SELECT 
            tarea.id_tarea AS id, tarea.nombre AS nombre, tarea.descr AS descr, tarea.fechalim AS deadline, tarea.hecho AS hecho, tipo.nombre AS materia, tipo.color AS color
        FROM tarea
        INNER JOIN tipo ON tarea.id_tipo=tipo.id_tipo 
        WHERE hecho=true
        ORDER BY deadline ASC";
$result= $con->query($sql);

?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Menu principal</title>
        <style>
            table {
                border-collapse: collapse;
                width: 70%;
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
        </style>
    </head>
    <body>
       
        <div style="display:flex; justify-content:center; gap:10px">
            <form action="main.php" method="post">
                <input type="submit" value="Tareas No Hechas" class="boton">
            </form>
            <form action="hechas.php" method="post">
                <input type="submit" value="Tareas Hechas" class="boton">
            </form>

        </div>


         <table>
            <tr>
                <th> Materia </th>
                <th> Nombre </th>
                <th> Descripcion </th>
                <th> Deadline </th>
                <th> Hecho </th>
                <th> Eliminar </th>

            </tr>
            <?php while($fila=$result->fetch_assoc()){?>

                <tr>
                    <td>
                        <span style="
                            display:inline-block; 
                            background-color: <?php echo $fila['color']; ?>; 
                            color: white; 
                            padding: 5px 12px; 
                            border-radius: 8px;
                            font-family: Arial, sans-serif;
                            font-size: 14px;">
                            <?php echo $fila['materia']; ?>
                        </span>
                    </td>
                    <td> <?php echo $fila['nombre'];?></td>
                    <td> <?php echo $fila['descr'];?></td>
                    <td> <?php echo $fila['deadline'];?></td>
                    <td>
                        <form action="tareanohecha.php" method="POST">
                            <input type="hidden" name="id" value="<?php echo $fila['id']; ?>">
                            <button type="submit", class = "botoninside">Hecho</button>   
                        </form>
                    </td>

                    <td>
                        <form action="eliminartarea.php" method="POST">
                            <input type="hidden" name="id" value="<?php echo $fila['id']; ?>">
                            <button type="submit", class = "botoninside">Eliminar</button>   
                        </form>
                    </td>
                </tr>

            <?php }?>
        </table>
    </body>
</html>