<?php
// Verificar si se recibió una solicitud POST con un ID válido
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    // Conectar a la base de datos (ajusta la configuración de conexión según tu caso)
    require_once "../includes/db.php";

    // Obtener el ID del registro a eliminar
    $id = $_POST['id'];

    // Realizar la consulta de eliminación en la base de datos
    $sql = "DELETE FROM documento WHERE idalumno = ?"; // Ajusta la tabla y la columna según tu caso
    $stmt = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);

    if (mysqli_stmt_execute($stmt)) {
        // La eliminación fue exitosa
        echo json_encode(['success' => true]);
    } else {
        // Hubo un error en la eliminación
        echo json_encode(['error' => 'Error al eliminar el registro']);
    }

    // Cierra la conexión a la base de datos
    mysqli_stmt_close($stmt);
    mysqli_close($conexion);
} else {
    // La solicitud no es válida
    echo json_encode(['error' => 'Solicitud no válida']);
}
