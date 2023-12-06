<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
include "conexion.php";
$connect = conecta();
$Nombre = $_POST["Nombre"];
$archivo = $_FILES["fichero"]["name"];
$dire = $_POST["dir"];
//$archivo2 = $_FILES['fichero']['name'];
//echo $Nombre;
echo "<br>";
/*echo "<pre>";
var_dump($_FILES['fichero']);
echo "</pre>";
echo "<br>";*/
/*echo $_FILES['fichero']["name"][0];
echo "<br>";
echo $_FILES['fichero']["name"][1];*/
$ruta = "upload/uno/";
foreach ($_FILES['fichero']['name'] as $key => $value){
    $extension = pathinfo($_FILES['fichero']['name'][$key], PATHINFO_EXTENSION);
    $nombrefinal = "";
    $nombrefinal = trim ($_FILES['fichero']['name'][$key]);
    $nombrefinal2 = mb_ereg_replace (" ", "", $nombrefinal);
    //echo $_FILES['fichero']['name'][$key]."---".$nombrefinal2;
    $upload = $ruta.$nombrefinal2;
    //echo "<br>";
    if(move_uploaded_file($_FILES['fichero']['tmp_name'][$key], $upload)) { //movemos el archivo a su ubicacion 
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
            $query = "INSERT INTO fecha_enviada (`id`, `Archivo`, `Nombre`, `Tipo_de_archivo`,`ruta`)
           VALUES (NULL,'".$nombrefinal2."','".$Nombre."', '".$Tipo_dearch."', '".$upload."');";
//VALUES ('$archivo','$Nombre','$Tipo_dearch')"; 
//echo $query;

//echo "<br>";

$a = mysqli_query($connect,$query);}
else{
    echo "<script>
Swal.fire({
    icon: 'error', // Cambia 'success' a 'error' para mostrar un mensaje de error
    title: 'Error',
    text: 'Ha ocurrido un error al subir los datos'
}).then(() => {
    // Después de hacer clic en 'Aceptar' en la alerta, regresar a la página anterior
    window.location.href = '$dire';
});
</script>";
}

echo "<script>
Swal.fire({
    icon: 'success',
title: 'Datos enviados',
text: 'Los datos se enviaron correctamente '}
).then(() => {
// Después de hacer clic en 'Aceptar' en la alerta, regresar a la página anterior
window.location.href = '$dire';
});

</script>

";


  

        }
?>
