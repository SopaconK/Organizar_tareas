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
        WHERE hecho=false
        ORDER BY deadline ASC";
$result= $con->query($sql);

$sql1 ="SELECT COUNT(*) AS tareas_proximas FROM tarea WHERE fechalim= CURDATE() AND hecho=false";
$result1=$con->query($sql1);
$fila1=$result1->fetch_assoc();
$sql1= "SELECT COUNT(*) AS tareas_proximas FROM tarea WHERE fechalim>= CURDATE() AND fechalim < DATE_ADD(CURDATE(), INTERVAL 7 DAY) AND hecho=false";
$result2=$con->query($sql1);
$fila2=$result2->fetch_assoc();
$sql1= "SELECT COUNT(*) AS tareas_proximas FROM tarea WHERE hecho=false";
$result3=$con->query($sql1);
$fila3=$result3->fetch_assoc();
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
            .grande td {
                font-size: 1.5em; 
                font-weight: bold; 
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
        
        <div style="display:flex; justify-content:center; gap:10px">
            <form action="agregartarea.php" method="post">
                <input type="submit" value="Agregar Tarea" class="boton">
            </form>
         

        </div>
        
        <table>
            <tr>
                <th>Pendientes HOY</th>
                <th> Pendientes los siguientes 7 dias</th>
                <th> Pendientes en total</th>
            </tr>
            <tr class="grande">
                <td><?php echo $fila1['tareas_proximas'];?></td>
                <td><?php echo $fila2['tareas_proximas'];?></td>
                <td><?php echo $fila3['tareas_proximas'];?></td>
            </tr>

        </table>

         <table>
            <tr>
                <th> Materia </th>
                <th> Nombre </th>
                <th> Descripcion </th>
                <th> Deadline </th>
                <th> Hecho </th>
                <th> Editar </th>

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
                        <form action="tareahecha.php" method="POST">
                            <input type="hidden" name="id" value="<?php echo $fila['id']; ?>">
                            <button type="submit", class = "botoninside">Hecho</button>   
                        </form>
                    </td>
                    <td>
                        <form action="edittarea.php" method="POST">
                            <input type="hidden" name="id" value="<?php echo $fila['id']; ?>">
                            <button type="submit", class = "botoninside">Editar</button>   
                        </form>
                    </td>
                </tr>

            <?php }?>
        </table>
    </body>
</html>