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
    <style>
        /* Estilo para el diálogo modal */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal-content {
            background-color: #fff;
            width: 50%;
            margin: 100px auto;
            padding: 20px;
            border: 1px solid #333;
        }
    </style>
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
    
            <form action="php/Enviartabla.php" class="Tabla_contenido" method="post">
                <?php
                include 'php/Mostrar_tabla2.php';
                Tabla();
                ?>
                
                
            
        </section>
        
        <section class="container" style="margin-top: 10px;
                        margin: left 500px;
                        align-items:center;
                        width: 20%;
                        justify-content: center;
            ">
            <div class="row">
                <div class="col-md-6">
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
            </div>
            </div>
          </button>
          </form>
          <br>
          
          
          <div class="">
            <button type="submit" onclick="mostrarModal()">Insertar</button>
          <!--input type="submit" value="Nuevo" onclick="mostrarModal()"-->
          
          </div>
          
          
          </section>
          <div class="modal" id="myModal">
        <div class="modal-content">
            <span onclick="cerrarModal()" style="cursor: pointer; float: right;">Cerrar &times;</span>
            <h2>Formulario</h2>
            <form action="php/llenado_Archivo_EF2.php" method="post" enctype="multipart/form-data" onsubmit="return validarFormulario()">
                <input type="text" name="Nombre" id="Nombre">
                <input name="fichero" type="file" size="150" maxlength="150">
                <br>
                <br>
                <button type="submit">Insertar</button>
            </form>
        </div>
    </div>
          
    </main>
    <script src="js/envia_FECH.js"></script>
    <script>
        function mostrarModal() {
            document.getElementById("myModal").style.display = "block";
        }

        function cerrarModal() {
            document.getElementById("myModal").style.display = "none";
        }

        function validarFormulario() {
            var nombre = document.getElementById("Nombre").value;
            var archivo = document.querySelector('input[type="file"]').files[0];

            try {
                if (nombre.trim() === "") {
                    Swal.fire({
                        title: 'Error',
                        text: 'Por favor, ingrese un nombre.',
                        icon: 'error'
                    });
                    return false;
                }

                if (archivo) {
                    var extension = archivo.name.split('.').pop().toLowerCase();
                    if (extension !== "pdf" && extension !== "docx" && extension !== "xlsx") {
                        Swal.fire({
                            title: 'Error',
                            text: 'El archivo debe ser de tipo PDF, Word o Excel.',
                            icon: 'error'
                        });
                        return false;
                    }
                } else {
                    Swal.fire({
                        title: 'Error',
                        text: 'Por favor, seleccione un archivo.',
                        icon: 'error'
                    });
                    return false;
                }
            } catch (error) {
                // Si hay un error al mostrar la alerta personalizada, muestra una alerta común.
                alert('Ha ocurrido un error en la validación del formulario.');
                return false;
            }

            return true;
        }
    </script>
    

    
</body>
</html>