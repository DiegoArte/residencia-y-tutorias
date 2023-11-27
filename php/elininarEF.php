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
function mostrar(){
    alert('Datos eliminados');
    '<script>window.history.back();</script>';
    

}
mostrar();
</script>

";
header("Location: ../$regreso");


?>