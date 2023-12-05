<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
include "conexion.php";
$cone = conecta();
$id=$_POST["id"];
$regreso = $_POST["sitio"];
$base = $_POST["datos"];
echo $id;
$sql = "DELETE FROM `$base` WHERE id=".$id."";
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
            window.location.href = '../$regreso';
        });
    }

    mostrar();
</script>

";
//header("Location: ../$regreso");


?>