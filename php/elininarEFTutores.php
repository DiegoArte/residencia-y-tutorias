<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
include "conexion.php";
$cone = conecta();
$dire = $_POST["dire"];
$id=$_POST["id"];
echo $id;
$sql = "DELETE FROM `fecha_enviada_tutorias` WHERE id=".$id."";
$que = mysqli_query($cone,$sql);

echo "
<script>
    function mostrar() {
        Swal.fire({
            title: 'Datos eliminados',
            icon: 'success',
            showConfirmButton: false,
            timer: 1500
        }).then(function() {
            window.location.href = '$dire';
        });
    }

    mostrar();
</script>

";


?>