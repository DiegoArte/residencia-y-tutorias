<?php
session_start();
$carrera=$_GET['carrera']??"";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Formato de Canalización</title>
    
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


        .boton{
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
            white-space: nowrap; /* Evita que el texto se divida en varias líneas */
            
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

    <script src="jspdf.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@2.3.2/dist/signature_pad.min.js"></script>
    <script src="canal.js"></script>

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
    <div class="usuarioOp d-flex justify-content-end">
        <img src="../img/profile.png" alt="" >
        <?php
        echo "Usuario";
        $nombre = $_SESSION['nombre']; // Asigna el valor a $nombre
        echo '<p>' . $nombre . '</p>';
        ?>
        <div class="dropdown-content">
        <a href="../logout.php">Cerrar sesión</a>
        </div>
    </header>
    <br><br><br><br>


    <form id="form"> <!-- Inicio del formulario -->
        <h3>Formato de Canalización</h3><hr><br>
        <label for="nombreCompleto">Nombre Completo del Estudiante:</label>
        <input type="text" id="nombre" name="nombre" required><br>

        <label for="fecha">Fecha:</label>
        <input type="date" id="fecha" name="fecha" required><br>

        <label for="numeroControl">Número de Control:</label>
        <input type="text" id="numeroControl" name="numeroControl" required><br>

        <label for="semestre">Semestre:</label>
        <input type="text" id="semestre" name="semestre" required><br>

        <label for="edad">Edad:</label>
        <input type="number" id="edad" name="edad" required><br>

        <label for="nombreTutor">Nombre del Tutor(a):</label>
        <input type="text" id="nombreTutor" name="nombreTutor" required><br>

        <label for="estudio" class="form-label">Plan de estudio</label>
        <select class="form-select" id="estudio" required>
            <option value="0">Seleccione</option> 
            <option value="Ingeniería Industrial">Ingeniería Industrial</option>
            <option value="Ingeniería en Sistemas Computacionales">Ingeniería en Sistemas Computacionales</option>
            <option value="Ingeniería en Electromecánica">Ingeniería en Electromecánica</option>
            <option value="Ingeniería en Gestión Empresarial">Ingeniería en Gestión Empresarial</option>
            <option value="Contador Público">Contador Público</option>
            <option value="Ingeniería en Administración">Ingeniería en Administración</option>
        </select>

        <label for="problematica">Problemática Identificada:</label>
        <textarea id="problematica" name="problematica" rows="4" required></textarea><br>

        <label for="servicioSolicitado">Servicio Solicitado:</label>
        <input type="text" id="servicioSolicitado" name="servicioSolicitado" required value="servicio solicitado"><br>

        <label for="observaciones">Observaciones:</label>
        <textarea id="observaciones" name="observaciones" rows="4" required></textarea><br>

        <label for="imagen1">Firma del coordindor(a) de tutorías:</label>
        <input type="file" id="imagen1" name="imagen1" accept="image/*" required><br>

        <label for="imagen1">Firma del tutor(a):</label>
        <input type="file" id="imagen2" name="imagen2" accept="image/*" required><br>

        <label for="imagen1">Firma y cargo de quien recibe la canalización:</label>
        <input type="file" id="imagen3" name="imagen3" accept="image/*" required><br>

        <br><br>
        <button type="submit" class="boton">Generar PDF</button>
        <br><br><br>

    </form> <!-- Cierre del formulario -->

</body>
</html> 