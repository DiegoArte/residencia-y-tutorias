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
    width: 80em;
    margin: 20px auto;
    margin-left: 5em;
    margin-right: 5em;
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
    padding: 7px;
    text-align: left;
    text-align: center;

}
.A{
    width: 10rem;
}
.tipo{
    width: 7rem;
}
.n{
    width: 5rem;
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
$login = $_POST["ses"];
echo $login;
if ($conn->connect_error) {
    //die("Conexión fallida: " . $conn->connect_error);
}
else{
    $sql = "SELECT * FROM `fecha_enviada` WHERE `Nombre`='".$login."';";
    $resultado = mysqli_query($conn,$sql);
    if ($resultado->num_rows > 0){
        echo "<table id='table-responsive' >";
        echo "<tr>";
            echo "<th> Archivo </th>";
            echo "<th> Nombre </th>";
            echo "<th> Tipo de archivo </th>";
            echo "</tr>";
            


            echo "<td>";
        while ($row = $resultado->fetch_array()){
            $axu = $row["Archivo"];
            echo $axu;
            echo "<br>";
            
        }
            echo "</td>";
            echo "<td class = 'n'>" ;
            $sql2 = "SELECT * FROM `alumnos` WHERE `NumerodeControl`='".$login."';";
            $resultado2 = mysqli_query($conn,$sql2);

            while ($row2 = $resultado2->fetch_array()){
                echo "". $row2["NombredelEstudiante"]. "";
            }
            echo "</td>";
            echo "<td class = 'tipo' >" ;
            
            $axu = $login;
            $sql3 = "SELECT * FROM `fecha_enviada2` WHERE Nombre='$axu';";
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
            $sql3 = "SELECT * FROM `fecha_enviada2` WHERE Nombre='$axu';";
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
        

        echo "</table>";
    }else {
        echo "No se encontraron registros.";
    }

    
}

// Cerrar la conexión


$conn->close();
}

?>
