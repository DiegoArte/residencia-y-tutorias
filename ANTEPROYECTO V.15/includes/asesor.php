<?php
require_once "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idProyecto = $_POST["id"];
    $nuevoAsesor = $_POST["asesor"];

    // Realiza una consulta para actualizar el asesor en la base de datos
    $sql = "UPDATE documento SET asesor = ? WHERE idalumno = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("si", $nuevoAsesor, $idProyecto);

    if ($stmt->execute()) {
        echo "Asesor actualizado con éxito";
    } else {
        echo "Error al actualizar el asesor";
    }
}
