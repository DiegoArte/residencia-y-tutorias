<?php
// Verifica si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupera los valores seleccionados del formulario
    $alumnoSeleccionado = $_POST["Lista1"];
    $docenteSeleccionado = $_POST["Lista2"];

    // Realiza la conexión a la base de datos (reemplaza con tus propios datos de conexión)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "tutorias_residencia";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Consultas
    $sql_insert = "INSERT INTO tabla_tutorados (grupo, tutor) VALUES ('$alumnoSeleccionado', '$docenteSeleccionado')";

    if ($conn->query($sql_insert) === TRUE) {
    } else {
        echo "Error al insertar datos: " . $conn->error;
    }

    $sql_eliminar = "DELETE FROM grupos WHERE NumerodeControl = '$alumnoSeleccionado'";

    if ($conn->query($sql_eliminar) === TRUE) {
        echo "Error al eliminar el registro: " . $conn->error;
    } else {
        echo "Error al eliminar el registro: " . $conn->error;
    }

    header("Location: ../asignar_Tutores.php");
    exit();

    // Cierra la conexión a la base de datos
    $conn->close();
}
?>