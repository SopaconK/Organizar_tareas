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
           prob.id_prob as id, prob.titulo as titulo, prob.link as enlace, tipo.nombre as fuente, tipo.color as color
        FROM prob
        INNER JOIN tipo ON prob.id_tipo=tipo.id_tipo 
        WHERE hecho=false";
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
             <form action="info.php" method="post">
                <input type="submit" value="Problemas info" class="boton">
            </form>
            <form action="sat.php" method="post">
                <input type="submit" value="SAT" class="boton">
            </form>
        </div>
        
        <div style="display:flex; justify-content:center; gap:10px">
            <form action="agregarinfo.php" method="post">
                <input type="submit" value="Agregar Problema" class="boton">
            </form>
            <form action="infohechos.php" method="post">
                <input type="submit" value="Problemas Hechos" class="boton">
            </form>
         

        </div>
        

         <table>
            <tr>
                <th> Lugar </th>
                <th> Titulo </th>
                <th> Hecho </th>
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
                            <?php echo $fila['fuente']; ?>
                        </span>
                    </td>
                    
                    <td> <a href="<?php echo $fila['enlace'];?>"><?php echo $fila['titulo'];?></a></td>
                 
                    <td>
                        <form action="infohecho.php" method="POST">
                            <input type="hidden" name="id" value="<?php echo $fila['id']; ?>">
                            <button type="submit", class = "botoninside">Hecho</button>   
                        </form>
                    </td>
                </tr>

            <?php }?>
        </table>
    </body>
</html>