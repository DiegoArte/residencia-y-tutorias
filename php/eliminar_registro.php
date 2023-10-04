<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "asignar_tutores";

// Crear una conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["eliminar"])) {
    $alumno = $_POST["alumno"];
    $asesor = $_POST["asesor"];

    // Consulta SQL para eliminar el registro
    $sql_eliminar = "DELETE FROM asesorados WHERE alumno = '$alumno' AND asesor = '$asesor'";

    if ($conn->query($sql_eliminar) === TRUE) {
        echo "Error al eliminar el registro: " . $conn->error;
    } else {
        echo "Error al eliminar el registro: " . $conn->error;
    }

    $sql_generar = "INSERT INTO `alumnos` (`Nombre`) VALUES ('$alumno')";

    if ($conn->query($sql_generar) === TRUE) {
        echo "Error al eliminar el registro: " . $conn->error;
    } else {
        echo "Error al eliminar el registro: " . $conn->error;
    }


    header("Location: asignar_Tutores.php");
    exit();
}

$conn->close();
?>