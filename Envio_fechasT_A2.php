<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" 
    integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" 
    crossorigin="anonymous" referrerpolicy="no-referrer" >
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/Envio_fecha.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    
    <title>Envío de fecha tutor o asesor</title>
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
            </div>
            <section style="margin-top: 80px;
                margin-left:50px;
                            width: 95%;
                            align-items: center;">
        <?php
// Establece la conexión a la base de datos (ajusta los valores según tu configuración)
require 'php/db.php';

$conn=conectar();

// Consulta SQL para obtener las fechas de la tabla fecharepo1
$sql = "SELECT fechaini, fechafin FROM fecharepo2";
$result = $conn->query($sql);


// Verifica si hay resultados
if ($result->num_rows > 0) {
    // Mostrar los resultados en el formulario
    while ($row = $result->fetch_assoc()) {
        $fechaInicio = $row["fechaini"];
        $fechaFinal = $row["fechafin"];
        
        echo '<form action="" method="POST">';
        echo '<h2>Reporte 2</h2>';
        echo '<label>Fecha de inicio</label>';
        echo '<input type="date" name="fechaFinal1" value="' . $fechaInicio . '" readonly >';
        echo '<label>Fecha final</label>';
        echo '<input type="date" name="fechaFinal1" value="' . $fechaFinal . '" readonly >';
        echo '<br>';
        
        echo '</form>';
    }
}

// Cierra la conexión
$conn->close();
?>
        </section>
        <section style="margin-top: 10px;
                        margin-left: 50px;
                        margin-right: 50px;
                        
                        width: 95%;
    padding: 10px;
    padding-right : 10px;">
    
            
                <?php
                include 'php/Mostrar_tablaT_A2.php';
                Tabla();
                ?>
                <form action="php/Enviartabla.php" class="Tabla_contenido" method="post">
                
            
        </section>
        
        
    
          
    </main>
    <script src="js/envia_FECH.js"></script>
    
    

    
</body>
</html>