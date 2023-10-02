
<style>
    /* Paleta de colores personalizada */
:root {
    --color-fondo: #f5f5f5;
    --color-borde: #d1d1d1;
    --color-fila1: #ffffff;
    --color-fila2: #f0f0f0;
    --color-texto: #333333;
    --color-boton: #007BFF;
    --color-boton-hover: #0056b3;
}

/* Estilo para la tabla */
table{
    border-collapse: collapse;
    width: 90%;
    margin: 20px auto;
    margin-left: 5%;
    margin-top: 3%;
    background-color: var(--color-fondo);
    border: 1px solid var(--color-borde);
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    
}

/* Estilo para las celdas de la tabla */
table, tr, td {
    border: 1px solid var(--color-borde);
    padding: 12px;
    text-align: left;
}

/* Estilo para los encabezados de columna */
th {
    background-color: var(--color-boton);
    color: white;
    text-align: center;
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
$conn = Conex();
// Verificar la conexión
$tABLA_ = "fecha_enviada";
if ($conn->connect_error) {
    //die("Conexión fallida: " . $conn->connect_error);
}
else{
    $sql = "SELECT * FROM  fecha_enviada";
    $resultado = mysqli_query($conn,$sql);
    if ($resultado->num_rows > 0){
        echo "<table id='miTabla' >";
        echo "<tr>";
            echo "<th> Archivo </th>";
            echo "<th> Nombre </th>";
            echo "<th> Tipo de archivo </th>";
            echo "</tr>";
        while ($row = $resultado->fetch_array()){
            echo "<tr>";
            echo "<td>" . $row["Archivo"] . "</td>";
            echo "<td>" . $row["Nombre"] . "</td>";
            echo "<td>" ;
            if($row["Tipo_de_archivo"] == 1){
                echo '<i class="fa-regular fa-file-pdf" ></i> PDF';

            }
            elseif($row["Tipo_de_archivo"] == 2){
                echo '<i class="fa-regular fa-file-word"></i> Word';

            }
            elseif($row["Tipo_de_archivo"] == 3){
                echo '<i class="fa-regular fa-file-excel" ></i> Excel';
            }
            "</td>";
            
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
