<?php
// Establecer la conexión a la base de datos
function Enviados(){
    include 'db.php';
    $conn = conecta();
    // Verificar la conexión
    $Tabla = "ya_enviados";
    $tABLA_ = "fecha_enviada";
    if ($conn->connect_error) {
        //die("Conexión fallida: " . $conn->connect_error);
        ?>
        <script type="text/javascript">
                function mostrar(){
                    alert("Error");

                }
            </script>
        <?php
    }
    else{
        $sql = "SELECT * FROM  fecha_enviada";
        $resultado = mysqli_query($conn,$sql);
        if ($resultado->num_rows > 0){
            while ($row = $resultado->fetch_array()){
                $Archivo = $row["Archivo"];
                $nombre = $row["Nombre"] ;
                $T_A = $row["Tipo_de_archivo"] ;
                $rutak = $row["ruta"];
                $sql2 = "INSERT INTO ".$Tabla."(archivo, Nombre,Tipo_de_archivo,ruta)
                VALUES('$Archivo','$nombre','$T_A','$rutak')" ;
                $resultado2 = mysqli_query($conn,$sql2);

                
            }
            $conn->close();
            ?>
        <script type="text/javascript">
                function mostrar(){
                    alert("Error");

                }
            </script>
        <?php
            
            echo '<script>window.history.back();</script>';

        }

    
    }
}
Enviados();
?>
