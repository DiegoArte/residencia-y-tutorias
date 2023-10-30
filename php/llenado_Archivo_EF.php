<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
include "conexion.php";
$connect = conecta();
$Nombre = $_POST["Nombre"];
$archivo = $_FILES["fichero"]["name"];
//$archivo2 = $_FILES['fichero']['name'];
//echo $Nombre;
echo "<br>";

//echo "<br>";
$ruta = "upload/";
$t = $archivo;
//echo "<br>";
$extension = pathinfo($archivo, PATHINFO_EXTENSION);
//echo $extension;


        $nombrefinal= trim ($archivo); //Eliminamos los espacios en blanco
        $nombrefinal= mb_ereg_replace (" ", "", $nombrefinal);//Sustituye una expresión regular
        
        $upload= $ruta . $nombrefinal; 
       // echo $upload;
        $query_com = "SELECT COUNT(*) AS count FROM fecha_enviada WHERE Nombre = '$Nombre' AND Archivo = '$nombrefinal'";
        $result = mysqli_query($connect, $query_com);
        $row = mysqli_fetch_assoc($result);
        if ($row['count'] > 0) {

            echo "<script>
            Swal.fire({
                icon: 'error',
          title: 'Oops...',
          text: 'Los datos ya existen '}
        ).then(() => {
            // Después de hacer clic en 'Aceptar' en la alerta, regresar a la página anterior
            window.history.back();
        });
        
        </script>
        
        ";
        
        }
        else {

        if(move_uploaded_file($_FILES['fichero']['tmp_name'], $upload)) { //movemos el archivo a su ubicacion 

            $Tipo_dearch = 0;
            if ($extension === "pdf"){
                $Tipo_dearch = 1;
            }
            elseif ($extension ==="doc" || $extension=="docx") {
                $Tipo_dearch = 2;
            }
            elseif($extension === "xls" || $extension=="xlsx"){
                $Tipo_dearch =3 ;
            }


            echo "<br>";
            echo "<br>";


           $query = "INSERT INTO fecha_enviada (`id`, `Archivo`, `Nombre`, `Tipo_de_archivo`,`ruta`)
           VALUES (NULL,'".$nombrefinal."','".$Nombre."', '".$Tipo_dearch."', '".$upload."');";
//VALUES ('$archivo','$Nombre','$Tipo_dearch')"; 
//echo $query;

//echo "<br>";

$a = mysqli_query($connect,$query);

echo "<script>
Swal.fire({
    icon: 'success',
title: 'Datos enviados',
text: 'Los datos se enviaron correctamente '}
).then(() => {
// Después de hacer clic en 'Aceptar' en la alerta, regresar a la página anterior
window.history.back();
});

</script>

";


}  

        }
?>
