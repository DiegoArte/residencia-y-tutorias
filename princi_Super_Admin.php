<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/estilo01_botones.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/comunicacionDocenteAlumno.css">

    <title></title>
</head>

<body>

<main class="d-flex">
    <div class="barraLateral fixed h-100">
        <a href="#"></a>
    </div>
</main>

<header class="fixed w-100">
    <div class="usuarioOp d-flex justify-content-end">
        <img src="img/profile.png" alt="" >
        <p>Usuario</p>
        <a href="#">Cerrar sesión</a>
    </div>
</header>

    <a href="archivo.php" class="boton1">Registrar Carrera</a>
    <a href="archivo.php" class="boton2">Registrar Docente</a>
    <a href="archivo.php" class="boton3">Registrar Alumno</a>

    <div class="button-container">
    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Verificar si se envió el formulario mediante POST
        
            // Recibir los datos del formulario
            $nombre = $_POST["button_id"];
        
            $urlDestino = "archivo.php?param1=" . urlencode($nombre);
            header("Location: " . $urlDestino);
        }


        function funcion_Carreras() {
            echo "Hola, mundo!";
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Verificar si se envió el formulario mediante POST
            
                // Recibir los datos del formulario
                $nombre = $_POST["button_id"];
            
                // Realizar acciones con los datos recibidos
                echo "Carrera: " . $nombre . "<br>";
            } else {
                // El formulario no se envió mediante POST, puedes manejarlo aquí
                echo "El formulario no se ha enviado.";
            }
        }



        // Conexión a la base de datos (ajusta los valores según tu configuración)
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "tutorias_residencia"; // Nombre de tu base de datos

        // Crear conexión
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Verificar la conexión
        if ($conn->connect_error) {
            die("La conexión a la base de datos falló: " . $conn->connect_error);
        }

        // Consulta para obtener los datos de la tabla
        $sql = "SELECT * FROM tabla_carreras";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $counter = 0;
            echo '<div class="button-table">';
            
            while ($row = $result->fetch_assoc()) {
                // Iniciar una nueva fila cada tres botones
                if ($counter % 3 == 0) {
                    echo '<div class="button-row">';
                }
                
                echo '<div class="button-cell">';
                echo '<form method="post" action="princi_Super_Admin.php">';
                echo '<button class="custom-button" type="submit" name="button_id" value="' . $row["Nombre"] . '">' . $row["Nombre"] . '</button>';
                echo '</form>';
                echo '</div>';
                
                $counter++;
                
                // Cerrar la fila después de tres botones o al final
                if ($counter % 3 == 0 || $counter == $result->num_rows) {
                    echo '</div>';
                }
            }
            
            echo '</div>';
        } else {
            echo "No se encontraron registros en la tabla.";
        }

        // Cerrar la conexión
        $conn->close();
        ?>
    </div>


</body>

</html>