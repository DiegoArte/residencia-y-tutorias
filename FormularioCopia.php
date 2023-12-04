<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/asignar_Tutores.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/comunicacionDocenteAlumno.css">
    <title>Plan de Acción Tutorial</title>

    <style> 
        .formulario {
            padding: 50px;
        }
        
        .formulario div {
            margin-bottom: 10px;
        }
        
        .formulario label {
            display: block;
        }

        /* Estilo para el formulario */
        .formulario {
            margin: 5px; /* Margen para centrar el formulario horizontalmente */
            padding: 100px; /* Espacio interior alrededor del formulario */
            font-size: 30px;
        }

        .formulario label.etiqueta-grande {
            font-size: 20px; /* Tamaño de letra de 20 píxeles solo para etiquetas con la clase "etiqueta-grande" */
        }

        #titulo {
            text-align: center; /* Centra el título horizontalmente */
            font-weight: bold; /* Establece el texto en negritas */
            font-size: 24px; /* Tamaño de letra del título */
        }

        div.radio-group label {
            display: inline-block;
            margin-right: 20px; /* Espacio entre los botones de radio */
        }

        /* Estilo para cajas de texto, fecha y área de texto */
        input[type="text"],
        input[type="date"],
        textarea {
            width: 80%; /* Ancho del 80% para cajas de texto y áreas de texto */
            padding: 8px; /* Espaciado interior */
            margin-top: 5px;
            border: 1px solid gray;
            border-radius: 4px;
            box-sizing: border-box;
            margin-bottom: 10px;
        }
    </style>

</head>
<body>
<main class="d-flex">
    <div class="barraLateral fixed h-100">
        <a href="#"></a>
    </div>
</main>

<header class="fixed w-100">
<div class="usuarioOp d-flex justify-content-end">
    <img src="img/profile.png" alt="">
    <p>Usuario</p>
    <a href="#">Cerrar sesión</a>
</div>

<h4 id="titulo">Plan de Acción Tutorial</h4>

</header>


<form action="guardar_datos.php" method="post" class="formulario" enctype="multipart/form-data">
    <h3 style="text-align: center; font-weight: bold; margin-top: 5px;">Plan de Acción Tutorial</h3>
    
    <div class="radio-group">
            <label class="etiqueta-grande">Periodo:</label>
            <input type="radio" id="enero_julio" name="periodo" value="Enero-Julio" required>
            <label for="enero_julio">Enero-Julio</label>

            <input type="radio" id="agosto_diciembre" name="periodo" value="Agosto-Diciembre" required>
            <label for="agosto_diciembre">Agosto-Diciembre</label>
        </div>

    <div><label for="fecha_actual" class="etiqueta-grande">Fecha Actual:</label>
        <input type="date" id="fecha_actual" name="fecha_actual" required></div>

    <div><label for="plan_estudios" class="etiqueta-grande">Plan de Estudios:</label>
        <input type="text" id="plan_estudios" name="plan_estudios" required></div>

    <div><label for="grupo" class="etiqueta-grande">Grupo:</label>
        <input type="text" id="grupo" name="grupo" required></div>

    <div><label for="num_estudiantes" class="etiqueta-grande">Número de Estudiantes:</label>
        <input type="text" id="num_estudiantes" name="num_estudiantes" required></div>

    <div><label for="nombre_tutor" class="etiqueta-grande">Nombre del Tutor:</label>
        <input type="text" id="nombre_tutor" name="nombre_tutor" required></div>

    <div><label for="num_actividad1" class="etiqueta-grande">Número de Actividad 1:</label>
        <input type="text" id="num_actividad1" name="num_actividad1" required></div>

    <div><label for="num_actividad2" class="etiqueta-grande">Número de Actividad 2:</label>
        <input type="text" id="num_actividad2" name="num_actividad2" required></div>

    <div><label for="num_actividad3" class="etiqueta-grande">Número de Actividad 3:</label>
        <input type="text" id="num_actividad3" name="num_actividad3" required></div>

    <div><label for="actividad1" class="etiqueta-grande">Nombre de la Actividad 1:</label>
        <input type="text" id="actividad1" name="actividad1" required></div>

    <div><label for="actividad2" class="etiqueta-grande">Nombre de la Actividad 2:</label>
        <input type="text" id="actividad2" name="actividad2" required></div>

    <div><label for="actividad3" class="etiqueta-grande">Nombre de la Actividad 3:</label>
        <input type="text" id="actividad3" name="actividad3" required></div>

    <div><label for="horas1" class="etiqueta-grande">Horas (1):</label>
        <input type="text" id="horas1" name="horas1" required></div>

    <div><label for="horas2" class="etiqueta-grande">Horas (2):</label>
        <input type="text" id="horas2" name="horas2" required></div>

    <div><label for="horas3" class="etiqueta-grande">Horas (3):</label>
        <input type="text" id="horas3" name="horas3" required></div>

    <div><label for="fecha_inicio1" class="etiqueta-grande">Fecha de Inicio (1):</label>
        <input type="date" id="fecha_inicio1" name="fecha_inicio1" required></div>

    <div><label for="fecha_final1" class="etiqueta-grande">Fecha de Finalización (1):</label>
        <input type="date" id="fecha_final1" name="fecha_final1" required></div>

    <div><label for="fecha_inicio2" class="etiqueta-grande">Fecha de Inicio (2):</label>
        <input type="date" id="fecha_inicio2" name="fecha_inicio2" required></div>

    <div><label for="fecha_final2" class="etiqueta-grande">Fecha de Finalización (2):</label>
        <input type="date" id="fecha_final2" name="fecha_final2" required></div>

    <div><label for="fecha_inicio3" class="etiqueta-grande">Fecha de Inicio (3):</label>
        <input type="date" id="fecha_inicio3" name="fecha_inicio3" required></div>

    <div><label for="fecha_final3" class="etiqueta-grande">Fecha de Finalización (3):</label>
        <input type="date" id="fecha_final3" name="fecha_final3" required></div>

    <div><label for="info_adicional1" class="etiqueta-grande">Información Adicional (1):</label>
        <textarea id="info_adicional1" name="info_adicional1" required></textarea></div>

    <div><label for="info_adicional2" class="etiqueta-grande">Información Adicional (2):</label>
        <textarea id="info_adicional2" name="info_adicional2" required></textarea></div>

    <div><label for="info_adicional3" class="etiqueta-grande">Información Adicional (3):</label>
        <textarea id="info_adicional3" name="info_adicional3"required></textarea></div>

    <div><label for="firma_tutor" class="etiqueta-grande">Nombre y Firma del Tutor:</label>
        <input type="file" id="firma_tutor" name="firma_tutor" required></div>

    <div><label for="nombre_coordinador" class="etiqueta-grande">Nombre y Firma del Coordinador del PIT:</label>
        <input type="file" id="nombre_coordinador" name="nombre_coordinador" required></div>

    <div><label for="nombre_academico" class="etiqueta-grande">Nombre y Firma del Jefe de Desarrollo Académico:</label>
        <input type="file" id="nombre_academico" name="nombre_academico" required></div>

    <input type="submit" value="Guardar Datos">
</form>
</body>
</html>
