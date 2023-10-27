<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Realiza la eliminación en la base de datos (reemplaza "nombre_de_la_tabla" con el nombre de tu tabla)
    require 'db.php';

    $mysqli=conectar();

    $deleteQuery = "DELETE FROM alumnosnormales WHERE id = ?";
    $stmt = $mysqli->prepare($deleteQuery);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        // Redirige de nuevo a la página principal o a donde desees después de eliminar
        header("Location: ../RegistraUSNormales.php");
        exit();
    } else {
        echo "Error al eliminar fila: " . $stmt->error;
    }

    $stmt->close();
    $mysqli->close();
}
?>
