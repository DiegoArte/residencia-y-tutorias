
<?php
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    $id = $_GET["id"];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <script>
        var confirmacion = confirm('¿Estás seguro de que deseas eliminar el registro');

        if (confirmacion) {
            // Eliminar el registro de la base de datos
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (this.readyState == 4) {
                    if (this.status == 200) {
                        // Redirige después de la eliminación
                        window.location.href = 'Tabla_mostrar.php';
                    } else {
                        console.error('Error al eliminar el registro: ' + this.responseText);
                    }
                }
            };
            xhr.open('GET', 'eliminar.php?id=<?php echo $id; ?>', true);
            xhr.send();
        } else {
            // El usuario canceló la eliminación
            window.location.href = 'Tabla_mostrar.php';
        }
    </script>
</head>
<body>
</body>
</html>

<?php
}

$conn->close();
?>