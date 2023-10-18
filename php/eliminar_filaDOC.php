<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Realiza una consulta para obtener el NumerodeControl basado en el id
    require 'php/db.php';

    $mysqli=conectar();

    // Consulta para obtener el NumerodeControl basado en el id
    $selectQuery = "SELECT NumerodeControl FROM docentes WHERE id = ?";
    $stmtSelect = $mysqli->prepare($selectQuery);
    $stmtSelect->bind_param("i", $id);

    if ($stmtSelect->execute()) {
        $stmtSelect->bind_result($numeroControl);
        $stmtSelect->fetch();
        $stmtSelect->close();

        // Ahora que tienes el NumerodeControl, puedes eliminar la fila correspondiente en la tabla docentes
        $deleteQueryDocentes = "DELETE FROM docentes WHERE id = ?";
        $stmtDeleteDocentes = $mysqli->prepare($deleteQueryDocentes);
        $stmtDeleteDocentes->bind_param("i", $id);

        if ($stmtDeleteDocentes->execute()) {
            // Ahora elimina la fila correspondiente en la tabla usuarios
            $deleteQueryUsuarios = "DELETE FROM usuarios WHERE usuario = ?";
            $stmtDeleteUsuarios = $mysqli->prepare($deleteQueryUsuarios);
            $stmtDeleteUsuarios->bind_param("s", $numeroControl);

            if ($stmtDeleteUsuarios->execute()) {
                // Redirige de nuevo a la página principal o a donde desees después de eliminar
                header("Location: ../RegistraDOC.php");
                exit();
            } else {
                echo "Error al eliminar fila en usuarios: " . $stmtDeleteUsuarios->error;
            }

            $stmtDeleteUsuarios->close();
        } else {
            echo "Error al eliminar fila en docentes: " . $stmtDeleteDocentes->error;
        }

        $stmtDeleteDocentes->close();
    } else {
        echo "Error al obtener NumerodeControl: " . $stmtSelect->error;
    }

    $mysqli->close();
}
?>
