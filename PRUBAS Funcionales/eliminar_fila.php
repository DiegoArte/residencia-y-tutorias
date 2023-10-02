<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Realiza la eliminación en la base de datos (reemplaza "nombre_de_la_tabla" con el nombre de tu tabla)
    $mysqli = new mysqli("localhost", "root", "", "Tutorias_Residencia");
    if (mysqli_connect_errno()) {
        echo "Error de conexión a MySQL: " . mysqli_connect_error();
        exit();
    }

    $deleteQuery = "DELETE FROM alumnos WHERE id = ?";
    $stmt = $mysqli->prepare($deleteQuery);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        // Redirige de nuevo a la página principal o a donde desees después de eliminar
        header("Location: RegistraUS.php");
        exit();
    } else {
        echo "Error al eliminar fila: " . $stmt->error;
    }

    $stmt->close();
    $mysqli->close();
}
?>
