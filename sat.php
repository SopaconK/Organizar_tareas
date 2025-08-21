<?php 
$servidor="localhost";
$usuario="root";
$contra="";
$bd="tarea";

$con=new mysqli($servidor, $usuario, $contra, $bd);

if($con->connect_error){
    die("Conexion fallida: ". $con->connect->error );
}

$sql="SELECT distinct(unit) FROM sat";

$result= $con->query($sql);

$stmt = $con->prepare("SELECT * FROM sat WHERE unit = ?");
if(!$stmt){
    die("Error al preparar la consulta: " . $con->error);
}

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

            .btn {
    padding: 16px 20px;
    border-radius: 10px;
    border: 2px solid #6b21a8; 
    font-size: 16px;
    cursor: pointer;
  }

  .btn-si {
    background-color: #6b21a8; 
    color: white;
  }

  .btn-no {
    background-color: white;
    color: #6b21a8; 
  }

  .btn:hover {
    opacity: 0.85;
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
            <form action="agregartarea.php" method="post">
                <input type="submit" value="Agregar Tarea" class="boton">
            </form>
         

        </div>
        
    
         <table>
            <tr>
                <th> Unidad </th>
                <th> L1 </th>
                <th> L2 </th>
                <th> L3 </th>
                <th> L4 </th>
                <th> L5 </th>
                <th> L6 </th>
                <th> L7 </th>
                <th> L8 </th>
                <th> L9 </th>
                <th> L10 </th>
                <th> L11 </th>
                <th> L12 </th>

            </tr>

            

            <?php while($fila=$result->fetch_assoc()){?>
                
                <tr>
                    <td> Unit <?php echo $fila['unit']; ?></td>
                  <?php 
                    $stmt->bind_param("i", $fila['unit']);
                     $stmt->execute();
                    $result2 = $stmt->get_result();
                    while($fila2=$result2->fetch_assoc()){?>
                    <td>
                        <form action="cambiarsat.php" method="POST">
                            <input type="hidden" name="id" value="<?php echo $fila2['id_sat']; ?>">
                            <input type="hidden" name="mandar" value="<?php echo $fila2['hecho']; ?>">
                             <button type="submit", class = "
                               <?php
                                if($fila2['hecho']) echo "btn btn-si";
                                else echo "btn btn-no"; 
                            ?>
                             
                             "></button> 
                           
                             
                        </form>
                    </td>
                   <?php }?>
                </tr>

            <?php }?>
        </table>
    </body>
</html>