<?php
session_start();
require 'php/app.php';
require 'php/Materias.php';

function enteroARomano($numero) {
    $valores = array(
        1000 => 'M',
        900  => 'CM',
        500  => 'D',
        400  => 'CD',
        100  => 'C',
        90   => 'XC',
        50   => 'L',
        40   => 'XL',
        10   => 'X',
        9    => 'IX',
        5    => 'V',
        4    => 'IV',
        1    => 'I'
    );

    $resultado = '';

    foreach ($valores as $valor => $romano) {
        while ($numero >= $valor) {
            $resultado .= $romano;
            $numero -= $valor;
        }
    }

    return $resultado;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">      
    <title>Formulario informe parcial</title><!-- Agrega el estilo del modal -->
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/comunicacionDocenteAlumno.css">
    <link rel="stylesheet" href="css/informe_parcial.css">
    <script src="js/script.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>

    <!-- RAYAS DE ARRIBA,IZ -->
    <header class="fixed w-100">
    <a href="formatos.php" class="back-arrow rounded-pill d-flex justify-content-start">
            <img src="img/back.svg" alt="" height="50">
            <span class="regresar d-none text-white m-auto">Regresar</span>
    </a>
        <div class="usuarioOp d-flex justify-content-end">
            <img src="img/profile.png" alt="">
            <?php
            $nombre = $_SESSION['nombre']; // Asigna el valor a $nombre
            echo '<p>' . $nombre . '</p>';
            ?>
            <div class="dropdown-content">
                <a href="logout.php">Cerrar sesión</a>
        </div>
    </div>
    </header>

    <main class="d-flex">
        <div class="barraLateral fixed h-100">
            <a href="#"></a>
        </div>
        <div class="barraLateral h-100"></div>
        <div class="tasks">
            <?php
            $numero_control=$_SESSION['usuario'];
            $materias=Materias::find("NumerodeControl IN(SELECT materia from `materias-grupos` WHERE grupo IN(SELECT Grupo from tabla_tutorados WHERE Tutor='$numero_control'))");
            foreach($materias as $materia) { 
            ?>
            <form action="">
                <table>
                    <thead>
                        <tr>
                            <th><?php echo $materia->NombredelaMateria ?></th>
                            <?php
                            for($i=1; $i<=$materia->Unidades; $i++){
                                $unidad=enteroARomano($i);
                                ?>
                                <th colspan="2"><?php echo $unidad ?></th>
                                <?php
                            } 
                            for($i=$materia->Unidades; $i<6; $i++){
                                ?>
                                <th colspan="2"></th>
                                <?php
                            } 
                            ?>
                            <th></th>
                        </tr>
                        <tr>
                            <th>Datos solicitados</th>
                            <?php
                            for($i=1; $i<=6; $i++){
                                ?>
                                <th>No R</th>
                                <th>%R</th>
                                <?php
                            } 
                            ?>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Datos</td>
                            <?php
                            for($i=1; $i<=6; $i++){
                                ?>
                                <td colspan=".5">
                                    <input type="text">
                                </td>
                                <td colspan=".5"> 
                                    <input type="text">
                                </td>
                                <?php
                            } 
                            ?>
                            <th>Núm. De Estudiantes</th>
                        </tr>
                        <tr>
                            <td>Promedio aprobados</td>
                            <?php
                            for($i=1; $i<=7; $i++){
                                ?>
                                <td colspan="2">
                                    <input type="text">
                                </td>
                                <?php
                            } 
                            ?>
                        </tr>
                        <tr>
                            <th colspan="14">Listado de estudiantes reprobados en el período</th>
                        </tr>
                        <tr>
                            <th>No.</th>
                            <th colspan="4">Número de control</th>
                            <th colspan="8">Nombre completo del estudiante</th>
                            <th>Unidad(es)</th>
                        </tr>
                        
                    </tbody>
                </table>
                <button class="agregar">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                        <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                    </svg>
                </button>
            </form>
            <?php
            
            }
            ?>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>

