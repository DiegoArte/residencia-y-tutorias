<?php
    session_start();
    $carrera=$_GET['carrera']??"";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">  
    <title>Creación de formatos</title>
    <link rel="stylesheet" href="css/estilo5.css">
    <link rel="stylesheet" href="css/estilofromatos.css">
    <link rel="stylesheet" href="css/estiloBoton.css">
    <link rel="stylesheet" href="css/estiloModal.css"> <!-- Agrega el estilo del modal -->
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/comunicacionDocenteAlumno.css">
    <script src="js/scriptCarrera.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
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
        <?php
                $nombre = $_SESSION['nombre']; // Asigna el valor a $nombre
                echo '<p>' . $nombre . '</p>';
                ?>
                <div class="dropdown-content">
                    <a href="logout.php">Cerrar sesión</a>
        </div>
    </header>
        
        <a href="hoja de vida/hv2.html"class="beautiful-button">Hoja de vida</a>

        <a class="beautiful-button1">Plan de acción</a>

        <!--<a class="beautiful-button2">Retícula</a>-->


        <a class="beautiful-button3">
        Informe de resultados</a>


        <a class="beautiful-button4">
        Formato de canalización</a>

        <a class="beautiful-button5">
        Evaluación al alumno</a>


        <a class="beautiful-button6">
        Informe parcial</a>

        <a class="beautiful-button7">
        Ficha técnica</a>

        <a class="beautiful-button8">
        Diagnóstico original</a>


        <a class="beautiful-button9">
        Evaluacion al docente</a>

        <a class="beautiful-button10">
        Lista de asistencia</a>

    </main>


</body>
</html>