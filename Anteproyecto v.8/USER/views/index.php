<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" 
    integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" 
    crossorigin="anonymous" referrerpolicy="no-referrer" >
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="Anteproyecto.css">
    <title>Anteproyecto (Vista Alumno)</title>

    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
</head>
<body>
    <header class="fixed w-100">
    <a href="princi_Super_Admin.php" class="back-arrow rounded-pill d-flex justify-content-start">
            <img src="back.svg" alt="" height="50">
            <span class="regresar d-none text-white m-auto">Regresar</span>
    </a>
        <div class="usuarioOp d-flex justify-content-end">
            <img src="profile.png" alt="" >
            <p>Usuario</p>
            <div class="dropdown-content">
                <a href="logout.php">Cerrar sesión</a>
            </div>
        </div>
    </header>


        <div class="barraLateral fixed h-100">
            <a href="#"></a>
            </div>
            <section style="margin-top: 70px;">
      
    

            <div class="container">
    <div class="col-sm-12">
        <h2 class="text-center">Anteproyecto</h2>
        <br>
        <div class="text-center">
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#agregar">Agregar</button>
        </div>
        <br>

        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre del alumno</th>
                        <th>Nombre del proyecto</th>
                        <th>Empresa</th>
                        <th>Archivo</th>
                        <th>Descargar</th>
                        <th>Ver PDF</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    require_once "../includes/db.php";
                    $consulta = mysqli_query($conexion, "SELECT * FROM documento");
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
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<?php include "agregar.php"; ?>

    
</body>
</html>