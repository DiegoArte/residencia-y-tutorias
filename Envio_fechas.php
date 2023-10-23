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
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/Envio_fecha.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <title>Envío de fecha</title>
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
            <section style="margin-top: 70px;
                            width: 200%;">
        <?php
// Establece la conexión a la base de datos (ajusta los valores según tu configuración)
require 'php/db.php';

$conn=conectar();

// Consulta SQL para obtener las fechas de la tabla fecharepo1
$sql = "SELECT fechaini, fechafin FROM fecharepo1";
$result = $conn->query($sql);


// Verifica si hay resultados
if ($result->num_rows > 0) {
    // Mostrar los resultados en el formulario
    while ($row = $result->fetch_assoc()) {
        $fechaInicio = $row["fechaini"];
        $fechaFinal = $row["fechafin"];
        
        echo '<form action="" method="POST">';
        echo '<h2>Reporte</h2>';
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
                        margin-left: 10px;
                        margin-right: 10px;
                        
                        width: 200%;
    padding: 10px;
    padding-right : 10px;">
    
            <form action="php/Enviartabla.php" class="Tabla_contenido" method="post">
                <?php
                include 'php/Mostrar_tabla.php';
                Tabla();
                ?>
                
                
            
        </section>
        
        <section style="margin-top: 10px;
            ">
        <button type="submit" onclick="mostrar()">
            <div class="svg-wrapper-1">
              <div class="svg-wrapper">
                <svg height="24" width="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                  <path d="M0 0h24v24H0z" fill="none"></path>
                  <path d="M1.946 9.315c-.522-.174-.527-.455.01-.634l19.087-6.362c.529-.176.832.12.684.638l-5.454 19.086c-.15.529-.455.547-.679.045L12 14l6-8-8 6-8.054-2.685z" fill="currentColor"></path>
                </svg>
              </div>
            </div>
            <span>Enviar</span>
            <script type="text/javascript">
                function mostrar(){
                    alert("Los datos se mandaron correctamente");

                }
            </script>
          </button>
          </section>
          </form>
    </main>
    <script src="js/envia_FECH.js"></script>
    

    
</body>
</html>