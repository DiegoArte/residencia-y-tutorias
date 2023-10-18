<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet" />
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="css/estiloFechaRep.css" />
  <link rel="stylesheet" href="css/normalize.css" />
  <link rel="stylesheet" href="css/style.css" />
  <title>Vista docente</title>
  <link rel="icon" type="image/gif" href="css/plano.gif">
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
    <?php
    
    if (isset($_GET['usuario'])) {
        $usuario = $_GET['usuario'];

        require 'php/db.php';

    $conexion=conectar();
        $sql_presidente = "SELECT * FROM docentes WHERE NumerodeControl = '$usuario' AND Presidente = 1";
        $resultado_presidente = $conexion->query($sql_presidente);
    
        if ($resultado_presidente->num_rows == 1) {
            echo '<div class="barraLateral fixed h-100">
                    <button>Asignar Asesores</button>
                </div>';
        } else {
            echo '<div class="barraLateral fixed h-100">
                </div>';
        }
    } 
    ?>
  </main>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
    crossorigin="anonymous">
</script>
</body>
</html>