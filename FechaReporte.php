<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estiloFechaRep.css">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Fechas</title>
</head>
<body>
    <header class="fixed w-100">
        <div class="usuarioOp d-flex justify-content-end">
            <img src="img/profile.png" alt="" >
            <p>Usuario</p>
            <a href="#">Cerrar sesión</a>
        </div>
    </header>
    <main>
        <div class="barraLateral fixed h-100">
            <a href="#"></a>
            <button><img src="img/inicio-ubicacion-alt.png" alt=""></button>
        </div>
        <section style="margin-top: 70px;">
        <?php
// Establece la conexión a la base de datos (ajusta los valores según tu configuración)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "protutres";
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Consulta SQL para obtener las fechas de la tabla fecharepo1
$sql = "SELECT fechaini, fechafin FROM fecharepo1";
$result = $conn->query($sql);

// Verifica si hay resultados
if ($result->num_rows > 0) {
    // Mostrar los resultados en el formulario
    while ($row = $result->fetch_assoc()) {
        $fechaInicio = $row["fechaini"];
        $fechaFinal = $row["fechafin"];
        echo '<form action="php/guardarFechaRepo1.php" method="POST">';
        echo '<h2>Reporte 1</h2>';
        echo '<label>Fecha de inicio</label>';
        echo '<input type="date" name="fechaInicio1" value="' . $fechaInicio . '">';
        echo '<label>Fecha final</label>';
        echo '<input type="date" name="fechaFinal1" value="' . $fechaFinal . '">';
        echo '<br>';
        echo '<button type="submit"><span>Activar Fecha</span></button>';
        echo '</form>';
    }
} else {
    echo "No se encontraron fechas en la tabla fecharepo1.";
}

// Cierra la conexión
$conn->close();
?>
        </section>
        
        <section>
        <?php
// Establece la conexión a la base de datos (ajusta los valores según tu configuración)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "protutres";
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Consulta SQL para obtener las fechas de la tabla fecharepo1
$sql = "SELECT fechaini, fechafin FROM fecharepo2";
$result = $conn->query($sql);

// Verifica si hay resultados
if ($result->num_rows > 0) {
    // Mostrar los resultados en el formulario
    while ($row = $result->fetch_assoc()) {
        $fechaInicio = $row["fechaini"];
        $fechaFinal = $row["fechafin"];
        echo '<form action="php/guardarFechaRepo2.php" method="POST">';
        echo '<h2>Reporte 2</h2>';
        echo '<label>Fecha de inicio</label>';
        echo '<input type="date" name="fechaInicio2" value="' . $fechaInicio . '">';
        echo '<label>Fecha final</label>';
        echo '<input type="date" name="fechaFinal2" value="' . $fechaFinal . '">';
        echo '<br>';
        echo '<button type="submit"><span>Activar Fecha</span></button>';
        echo '</form>';
    }
} else {
    echo "No se encontraron fechas en la tabla fecharepo3.";
}

// Cierra la conexión
$conn->close();
?>
        </section>
        
        <section>
            <    <?php
// Establece la conexión a la base de datos (ajusta los valores según tu configuración)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "protutres";
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Consulta SQL para obtener las fechas de la tabla fecharepo1
$sql = "SELECT fechaini, fechafin FROM fecharepo3";
$result = $conn->query($sql);

// Verifica si hay resultados
if ($result->num_rows > 0) {
    // Mostrar los resultados en el formulario
    while ($row = $result->fetch_assoc()) {
        $fechaInicio = $row["fechaini"];
        $fechaFinal = $row["fechafin"];
        echo '<form action="php/guardarFechaRepo3.php" method="POST">';
        echo '<h2>Reporte 3</h2>';
        echo '<label>Fecha de inicio</label>';
        echo '<input type="date" name="fechaInicio3" value="' . $fechaInicio . '">';
        echo '<label>Fecha final</label>';
        echo '<input type="date" name="fechaFinal3" value="' . $fechaFinal . '">';
        echo '<br>';
        echo '<button type="submit"><span>Activar Fecha</span></button>';
        echo '</form>';
    }
} else {
    echo "No se encontraron fechas en la tabla fecharepo3.";
}

// Cierra la conexión
$conn->close();
?>
        </section>
    </main>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
</script>
</body>
</html>