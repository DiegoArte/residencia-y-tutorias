<!DOCTYPE html>
<html>
<head>
    <title>Búsqueda en Base de Datos</title>
</head>
<body>
    <form action="" method="GET"> <!-- El formulario envía los datos a la misma página -->
        <label for="idalumno">Buscar idalumno:</label>
        <input type="text" id="idalumno" name="idalumno">
        <input type="submit" value="Buscar">
    </form>

    <?php
    // Verificar si se recibió un valor del formulario
    if(isset($_GET['idalumno'])) {
        // Establecer la conexión con la base de datos (cambiar según tus credenciales)
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "tutorias_residencia";

        // Crear la conexión
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Verificar la conexión
        if ($conn->connect_error) {
            die("Conexión fallida: " . $conn->connect_error);
        }

        $elemento_a_buscar = $_GET['idalumno'];

        // Consulta para buscar el idalumno en la tabla 'documento'
        $sql = "SELECT * FROM documento WHERE idalumno = '$elemento_a_buscar'"; // Reemplaza 'nombre_columna' por el nombre de la columna que deseas buscar

        // Ejecutar la consulta
        $result = $conn->query($sql);

        // Verificar si se encontraron resultados
        if ($result->num_rows > 0) {
            // Mostrar otros elementos de la base de datos
            $row = $result->fetch_assoc();
            echo "<h2>Datos del idalumno '$elemento_a_buscar':</h2>";
            echo "Nombre: " . $row['nombrealumno'] . "<br>"; // Reemplaza 'nombre_columna' por el nombre de la columna que deseas mostrar
            echo "Nombre Proyecto: " . $row['nombreproyecto'] . "<br>"; // Reemplaza 'otra_columna' por el nombre de otra columna que deseas mostrar
            echo "Empresa: " . $row['empresa'] . "<br>"; // Reemplaza 'nombre_columna' por el nombre de la columna que deseas mostrar
            echo "Archivo: " . $row['archivo'] . "<br>"; // Reemplaza 'otra_columna' por el nombre de otra columna que deseas mostrar
            
            // Añade más líneas como las anteriores para mostrar otros datos necesarios
        } else {
            echo "El idalumno '$elemento_a_buscar' NO existe en la tabla 'documento'";
        }

        // Cerrar la conexión a la base de datos al finalizar
        $conn->close();
    }
    ?>
</body>
</html>
