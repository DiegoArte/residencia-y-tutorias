<script>
       
</script>
<style>
    :root {
        --color-fondo: #f5f5f5;
    --color-borde: #d1d1d1;
    --color-fila1: #ffffff;
    --color-fila2: #f0f0f0;
    --color-texto: #333333;
    --color-boton: #007BFF;
    --color-boton-hover: #0056b3;
}

 table {
    border-collapse: collapse;
    width: 100%;
    margin: 20px auto;
    margin-left: 0em;
    margin-top: 40px;
    background-color: var(--color-fondo);
    border: 1px solid var(--color-borde);
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}
.pdf-iframe {
            width: 100%;
            height: 500px; /* Ajusta la altura según tus necesidades */
            border: none;
        }

/* Estilo para las celdas de la tabla */
table, th, td {
    border: 1px solid var(--color-borde);
    padding: 5px;
    text-align: left;
    text-align: center;

}
.A{
    width: 30%;
}
.tipo{
    width: 10%;
}
.n{
    width: 7%;
}
.t{
    width: 1%;
}
/* Estilo para enlace de eliminar (rojo) */
.eliminar-enlace {
    display: inline-block;
    padding: 2px 3px;
    background-color: #FF0000;
    color: #fff;
    text-decoration: none;
    border: 1px solid #FF0000;
    border-radius: 5px;
    margin-right: 2px; /* Agregar un espacio entre los enlaces */
    margin-left: 2px;
    margin-bottom: 1px;
}

/* Estilo para enlace de modificar (azul) */
.modificar-enlace {
    display: inline-block;
    padding: 2px 3px;
    background-color: #007BFF;
    color: #fff;
    text-decoration: none;
    border: 1px solid #0056b3;
    border-radius: 5px;
    margin-bottom: 1px;
}


.modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal-content {
            background-color: #fff;
            width: 50%;
            margin: 100px auto;
            padding: 20px;
            border: 1px solid #333;
        }


/* Estilo para los encabezados de columna */
th {
    background-color: var(--color-fila2);
    color: black;
}

/* Estilo para las filas alternas */
tr:nth-child(even) {
    background-color: var(--color-fila1);
}

/* Estilo para las filas impares */
tr:nth-child(odd) {
    background-color: var(--color-fila2);
}
</style>
<?php
// Establecer la conexión a la base de datos
function Tabla(){
include 'conexion.php';
$conn = conecta();
// Verificar la conexión
$tABLA_ = "fecha_enviada";
if ($conn->connect_error) {
    //die("Conexión fallida: " . $conn->connect_error);
}
else{
    $sql = "SELECT MIN(id) AS id, Archivo, Nombre, Tipo_de_archivo,ruta FROM fecha_enviada GROUP BY Nombre;";
    $resultado = mysqli_query($conn,$sql);
    if ($resultado->num_rows > 0){
        echo "<table id='table-responsive' >";
        echo "<tr>";
            echo "<th> Archivo </th>";
            echo "<th> Nombre </th>";
            echo "<th> Tipo de archivo </th>";
            echo "</tr>";
            



        while ($row = $resultado->fetch_array()){
            $axu = $row["Nombre"];
            $sql2 = "SELECT * FROM `fecha_enviada` WHERE Nombre='$axu';";
            $resultado2 = mysqli_query($conn,$sql2);
            //while($row2 = $resultado2->fetch_array()){}
            echo "<tr>";
            echo "<td class = 'A'>"; 
            while($row2 = $resultado2->fetch_array()){
                echo "". $row2["Archivo"] . "";
                echo "<br>";
            }
            
            
            echo "</td>";
            echo "<td class = 'n'>" ;
           
                echo "". $row["Nombre"]. "";
                echo "<br>";
            
           
            echo "</td>";
            echo "<td class = 'tipo' >" ;
            
            $axu = $row["Nombre"];
            $sql3 = "SELECT * FROM `fecha_enviada` WHERE Nombre='$axu';";
            $resultado3 = mysqli_query($conn,$sql3);
            while($row3 = $resultado3->fetch_array()){
                //echo "". $row2["Nombre"]. "";
                $extension  = pathinfo($row3["Archivo"],PATHINFO_EXTENSION);
            
            if($row3["Tipo_de_archivo"] == 1){
                echo '<a href=php/'.$row3["ruta"].' onclick="mostrarPDF();" target="pdf-iframe"><i class="fa-regular fa-file-pdf" ></i> '.$extension.'</a>';
                
            }
            elseif($row3["Tipo_de_archivo"] == 2){
                echo '<a href=php/'.$row3["ruta"].' onclick="mostrarPDF();" target="pdf-iframe"><i class="fa-regular fa-file-word"></i> '.$extension.'</a>';


            }
            elseif($row3["Tipo_de_archivo"] == 3){
                echo '<a href=php/'.$row3["ruta"].' onclick="mostrarPDF();" target="pdf-iframe"><i class="fa-regular fa-file-excel" ></i> '.$extension.'</a>';
            }
            
            echo "<br>";
        }
            echo"</td>";
            echo "<td class='t'>";
            $sql3 = "SELECT * FROM `fecha_enviada` WHERE Nombre='$axu';";
            $resultado3 = mysqli_query($conn,$sql3);
           
            while($row3 = $resultado3->fetch_array()){
                ?>
                
        <form action="php/elininarEF.php" method="post">      
        <input type="hidden" name="id" value="<?php echo $row3["id"]?>">
        <input type="submit" value="Eliminar">
        </form>
        

        
        
        
            
        
        

        
        
        <?php
            }
            echo"</td>";


            
            echo "</tr>";
        }   

        echo "</table>";
    }else {
        echo "No se encontraron registros.";
    }

    
}

// Cerrar la conexión


$conn->close();
}

?>
