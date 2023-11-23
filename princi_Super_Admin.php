<?php
session_start();
$carrera=$_GET['carrera']??"";
?>

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
    <?php
            $nombre = $_SESSION['nombre']; // Asigna el valor a $nombre
            echo '<p>' . $nombre . '</p>';
            ?>
            <div class="dropdown-content">
                <a href="logout.php">Cerrar sesión</a>
    </div>
</header>

    <a href="RegistraCarrera.php" class="boton1">Registrar Carrera</a>
    <a href="RegistraDOC.php" class="boton2">Registrar Docente</a>
    <?php
        if($_SESSION['pagina']=='resdencia'){
            ?>
                <a href="RegistraUS.php" class="boton3">Registrar Alumno</a>
                <a href="FechaReporte.php" class="boton1 boton4">Asignar fechas</a>
            <?php
        }
    ?>
    <?php
        if($_SESSION['pagina']=='tutorias'){
            ?>
            <a href="RegistraUSNormales.php" class="boton3">Registrar Alumno</a>
            <a href="RegistraGrupo.php" class="boton1 boton4">Registrar Grupo</a>
            <a href="RegistraMaterias.php" class="boton1 boton5">Registrar Materia</a>
            <a href="FechaReporteTut.php" class="boton1 boton6">Asignar Fechas</a>

            <?php
        }
    ?>

    <div class="button-container">
    <?php

        // Conexión a la base de datos (ajusta los valores según tu configuración)
        require 'php/db.php';

$conn=conectar();

        // Consulta para obtener los datos de la tabla
        $sql = "SELECT * FROM carrera";
        $result = $conn->query($sql);
        if($_SESSION['pagina']=='tutorias'){
            if($carrera==""){
                if ($result->num_rows > 0) {
                    $counter = 0;
                    echo '<div class="button-table">';
                    
                    while ($row = $result->fetch_assoc()) {
                        // Iniciar una nueva fila cada tres botones
                        if ($counter % 3 == 0) {
                            echo '<div class="button-row">';
                        }
                        
                        echo '<div class="button-cell">';
                        echo '<a href="princi_Super_Admin.php?carrera=' . $row["NombredeCarrera"] . '"><button class="custom-button" type="submit" name="button_id">' . $row["NombredeCarrera"]. '</button></a>';
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
            } else {
                $sql = "SELECT * FROM grupos WHERE NombredeCarrera='$carrera'";
                $result2 = $conn->query($sql);
                if ($result2->num_rows > 0) {
                    $counter = 0;
                    echo '<div class="button-table">';
                    
                    while ($row = $result2->fetch_assoc()) {
                        // Iniciar una nueva fila cada tres botones
                        if ($counter % 3 == 0) {
                            echo '<div class="button-row">';
                        }
                        
                        echo '<div class="button-cell">';
                        echo '<a href=""><button class="custom-button" type="submit" name="button_id" value="' . $row["NombredeCarrera"] . '">' . $row["NombredeCarrera"]." ".$row["Semestre"]  . '</button></a>';
                        echo '</div>';
                        
                        $counter++;
                        
                        // Cerrar la fila después de tres botones o al final
                        if ($counter % 3 == 0 || $counter == $result2->num_rows) {
                            echo '</div>';
                        }
                    }
                    
                    echo '</div>';
                } else {
                    echo "No se encontraron registros en la tabla.";
                }
            }
            
        }else {

            if ($result->num_rows > 0) {
                $counter = 0;
                echo '<div class="button-table">';
                
                while ($row = $result->fetch_assoc()) {
                    // Iniciar una nueva fila cada tres botones
                    if ($counter % 3 == 0) {
                        echo '<div class="button-row">';
                    }
                    
                    echo '<div class="button-cell">';
                    echo '<a href="ANTEPROYECTO v.15/views/index(VISTA ADMIN).php"><button class="custom-button" type="submit" name="button_id" value="' . $row["NombredeCarrera"] . '">' . $row["NombredeCarrera"] . '</button></a>';
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
        }

        // Cerrar la conexión
        $conn->close();
        ?>
    </div>


</body>

</html>