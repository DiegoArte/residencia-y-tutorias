<?php
require_once '../../php/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    if (isset($data['id'])) {
        $idAlumno = $data['id'];

        $conexion = conectar();

        $query = "DELETE FROM documento WHERE idalumno = '$idAlumno'";

        if ($stmt = $conexion->prepare($query)) {
            $stmt->bind_param("i", $idAlumno);

            if ($stmt->execute()) {
                // Éxito al eliminar el registro
                echo json_encode(["message" => "Registro eliminado correctamente"]);
            } else {
                // Error al eliminar el registro
                echo json_encode(["error" => "Error al eliminar el registro"]);
            }

            $stmt->close();
        }

        $conexion->close();
    } else {
        // No se proporcionó un ID válido
        echo json_encode(["error" => "ID de alumno no válido"]);
    }
}
?>
