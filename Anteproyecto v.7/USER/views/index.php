<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anteproyecto (Vista Alumnos)</title>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">

    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
</head>

<body>
    <br>

    <div class="container">
        <div class="col-sm-12">
            <h2 style="text-align: center;">Mi Anteproyecto</h2>
            <br>
            <div>
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#agregar"> Agregar </button>
            </div>
            <br>
            <br>
            <br>

            <div class="container">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nombre del alumno</th>
                            <th>Nombre del proyecto</th>
                            <th>Empresa</th>
                            <th>Archivo</th>
                            <th>Descargar</th>
                            <th>Ver PDF</th>
                            <th>Ver Revisión</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        require_once "../includes/db.php";
                        session_start();
                        $id=$_SESSION['usuario'];
                        $consulta = mysqli_query($conexion, "SELECT * FROM documento WHERE idalumno='$id'");
                        while ($fila = mysqli_fetch_assoc($consulta)) :
                        ?>
                            <tr>
                                <td><?php echo $fila['idalumno']; ?></td>
                                <td><?php echo $fila['nombrealumno']; ?></td>
                                <td><?php echo $fila['nombreproyecto']; ?></td>
                                <td><?php echo $fila['empresa']; ?></td>
                                <td><?php echo $fila['archivo']; ?></td>
                                <td>
                                    <a href="../includes/download.php?id=<?php echo $fila['idalumno']; ?>" class="btn btn-primary">
                                        <i class="fas fa-download"></i> Descargar
                                    </a>
                                </td>
                                <td>
                                    <a href="../includes/visualizar_pdf.php?id=<?php echo $fila['idalumno']; ?>" class="btn btn-success">
                                        <i class="fas fa-eye"></i> Ver PDF
                                    </a>
                                </td>
                                <td>
                                    <?php
                                        $asesor = mysqli_fetch_assoc(mysqli_query($conexion, "SELECT Asesor FROM asesorados WHERE Alumno='$id'"));
                                    ?>
                                    <a href="../../../comunicacionDocenteAlumno.php?id=<?php echo $asesor['Asesor']; ?>" class="btn btn-danger">
                                        <i class="fas fa-message"></i> Ver revisión
                                    </a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <style>
        a {
            text-decoration: none;
        }

        .s {
            padding-top: 50px;
            text-align: center;
        }
    </style>


    <?php include "agregar.php"; ?>

</body>

</html>
