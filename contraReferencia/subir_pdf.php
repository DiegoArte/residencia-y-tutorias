<?php
session_start();
$carrera = $_GET['carrera'] ?? "";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subir PDF</title>

    <style>
        body {
            background-color: white;
            font-family: 'Open Sans', sans-serif;
        }

        form {
            width: 60%;
            margin: 0 auto;
            font-weight: bold;
        }

        label {
            display: block;
            margin-top: 10px;
        }

        input[type="text"],
        input[type="date"],
        input[type="number"],
        input[type="file"],
        select,
        textarea {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid gray;
            border-radius: 4px;
            box-sizing: border-box;
        }


        .boton {
            display: inline-block;
            background: linear-gradient(to bottom, #0D65D9, #57E3F2);
            width: 300px;
            height: 80px;
            text-align: center;
            color: #000000;
            font-family: 'Open Sans', sans-serif;
            font-weight: bold;
            font-size: 18px;

            border-radius: 20px;
            cursor: pointer;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            animation: button-shimmer 2s infinite;
            transition: all 0.3s ease-in-out;
            white-space: nowrap;
            /* Evita que el texto se divida en varias líneas */

        }


        /* Hover animation */
        .boton:hover {
            background: linear-gradient(to bottom, #49C2F2, white);
            animation: button-particles 1s ease-in-out infinite;
            transform: translateY(-2px);
        }
    </style>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <link rel="stylesheet" href="../css/normalize.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/comunicacionDocenteAlumno.css">
</head>

<body>
    <main class="d-flex">
        <div class="barraLateral fixed h-100">
            <a href="#"></a>
        </div>
    </main>

    <header class="fixed w-100">
        <a href="F_Canal.php" class="back-arrow rounded-pill d-flex justify-content-start">
            <img src="../img/back.svg" alt="" height="50">
            <span class="regresar d-none text-white m-auto">Regresar</span>
        </a>
        <div class="usuarioOp d-flex justify-content-end">
            <img src="../img/profile.png" alt="">
            <?php
            $nombre = $_SESSION['nombre']; // Asigna el valor a $nombre
            echo '<p>' . $nombre . '</p>';
            ?>
            <div class="dropdown-content">
                <a href="../logout.php">Cerrar sesión</a>
            </div>
    </header>
    <br><br><br><br><br>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Obtener datos del formulario
        $numeroControl = $_POST['numeroControl'] ?? "";
        $nombre = $_POST['nombre'] ?? "";
        $nombreTutor = $_POST['nombreTutor'] ?? "";
        $problematica = $_POST['problematica'] ?? "";
    }
    
    echo "
    <form action='guardar_pdf.php' method='post' enctype='multipart/form-data'>
        <label for='pdfFile'>Enviar PDF al docente o tutor:</label>
        <input type='file' id='pdfFile' name='pdfFile' accept='.pdf' required>
        <br><br>
        <input type='hidden' id='campoOculto1' name='campoOculto1' value='$numeroControl'>
        <input type='hidden' id='campoOculto2' name='campoOculto2' value='$nombre'>
        <input type='hidden' id='campoOculto3' name='campoOculto3' value='$nombreTutor'>
        <input type='hidden' id='campoOculto4' name='campoOculto4' value='$problematica'>
        <button type='submit'>Enviar</button>
    </form>";

    ?>
</body>

</html>