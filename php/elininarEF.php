<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
include "conexion.php";
$cone = conecta();
$id=$_POST["id"];
$sql = "DELETE FROM `fecha_enviada` WHERE id=".$id."";
$que = mysqli_query($cone,$sql);

echo "<script>
Swal.fire({
    icon: 'success',
title: 'Archivo Eliminado',
text: 'Los datos se enviaron correctamente '}
).then(() => {
// Después de hacer clic en 'Aceptar' en la alerta, regresar a la página anterior
window.history.back();
});

</script>

";

echo'<script type="text/javascript">
                function mostrar(){
                    alert("Error");

                }
            </script>';
echo '<script>window.history.back();</script>';
?>