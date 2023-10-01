
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
        echo "<table id='miTabla'>";
        echo "<tr>";
            echo "<td> Archivo </td>";
            echo "<td> Nombre </td>";
            echo "<td> Tipo de archivo </td>";
            echo "</tr>";
        while ($row = $resultado->fetch_array()){
            echo "<tr>";
            echo "<td>" . $row["Archivo"] . "</td>";
            echo "<td>" . $row["Nombre"] . "</td>";
            echo "<td>" ;
            if($row["Tipo_de_archivo"] == 1){
                echo '<i class="fa-regular fa-file-pdf" ></i>';

            }
            elseif($row["Tipo_de_archivo"] == 2){
                echo '<i class="fa-regular fa-file-word"></i>';

            }
            elseif($row["Tipo_de_archivo"] == 3){
                echo '<i class="fa-regular fa-file-excel" ></i>';
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
