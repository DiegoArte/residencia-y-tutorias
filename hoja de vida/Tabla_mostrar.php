<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Tabla de Índices</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ccc;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
   <h1>Indices</h1>

<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tutorias_residencia";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Obtener datos de la tabla 'indices'
$sql = "SELECT * FROM indices";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>Plan de estudio</th><th>Materia</th><th>Semestre</th><th>Unidad</th><th>AlumnosA</th><th>AlumnosR</th><th>Acciones</th></tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["carrera"] . "</td>";
        echo "<td>" . $row["materia"] . "</td>";
        echo "<td>" . $row["semestre"] . "</td>";
        echo "<td>" . $row["unidad"] . "</td>";
        echo "<td>" . $row["alumnosA"] . "</td>";
        echo "<td>" . $row["alumnosR"] . "</td>";
        echo "<td><a href='editar.php?id=" . $row["id"] . "'>Editar</a> | <a href='eliminar.php?id=" . $row["id"] . "'>Eliminar</a> ";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "0 resultados encontrados";
}

$conn->close();
?>
 <a href='anadir.php?id=" . $row["id"] . "'>Añadir</a> </td>
 <a href="NUEVO.php">Generar Indices</a>

</body>
</html>
