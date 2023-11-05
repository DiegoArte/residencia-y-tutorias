<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario'])) {
    header("Location: login_prueba1.php"); // Redirige al usuario al formulario de inicio de sesión si no ha iniciado sesión
    exit();
}

// Establecer la conexión a la base de datos (ajusta los valores según tu configuración)
require 'php/db.php';
$conexion = conectar();

// Inicializa las variables
$nuevaContrasena = $confirmarContrasena = "";
$contrasenaErr = "";

// Manejar la solicitud de cambio de contraseña
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nuevaContrasena = $_POST['nuevaContrasena'];
    $confirmarContrasena = $_POST['confirmarContrasena'];
    if (
        !preg_match('/[0-9]/', $nuevaContrasena) || // Al menos un número
        !preg_match('/[A-Z]/', $nuevaContrasena) || // Al menos una letra mayúscula
        !preg_match('/[a-z]/', $nuevaContrasena) || // Al menos una letra minúscula
        !preg_match('/[^A-Za-z0-9]/', $nuevaContrasena) || // Al menos un carácter especial
        strlen($nuevaContrasena) < 8 // Al menos 8 caracteres
    ) {
        $contrasenaErr = "Nueva contraseña no cumple con los requisitos.";
    } else {
        
    // Verificar que la nueva contraseña no sea igual a la contraseña actual
    $usuario = $_SESSION['usuario'];
    $sql = "SELECT contrasena FROM usuarios WHERE usuario = '$usuario'";
    $resultado = $conexion->query($sql);
    if ($resultado->num_rows == 1) {
        $row = $resultado->fetch_assoc();
        $contrasenaActual = $row['contrasena'];
        

        if ($nuevaContrasena === $contrasenaActual) {
            $contrasenaErr = "Nueva contraseña no puede ser igual a la contraseña actual. Por favor, elige una contraseña diferente.";
        } else {
            if ($nuevaContrasena === $confirmarContrasena) {
                // Actualiza la contraseña en la base de datos
                $sql = "UPDATE usuarios SET contrasena = '$nuevaContrasena' WHERE usuario = '$usuario'";
                if ($conexion->query($sql) === TRUE) { 
                    echo '<div class="mensaje-error">
                    <p>Contraseña actualizada con éxito</p>
                </div>';
                } else {
                    echo '<div class="mensaje-error">
                    <p>Error al actualizar la contraseña</p>
                </div>' . $conexion->error;
                }
            } else {
                $contrasenaErr = "Contraseñas no coinciden. Por favor, asegúrate de que las contraseñas sean iguales en ambos campos.";
            }
        }
    }
}}

// Cierra la conexión a la base de datos
$conexion->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
    <title>Cambio de contraseña</title>
    <link rel="stylesheet" href="css/estilo5.css">
    <link rel="stylesheet" href="css/estilofromatos.css">
    <link rel="stylesheet" href="css/estiloBoton.css">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/estiloLogin.css">
    <link rel="stylesheet" href="css/comunicacionDocenteAlumno.css">
    <script src="js/scriptCarrera.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    
    <style>
        /* Estilos para el modal */
        .modal {
            display: none; /* El modal está oculto por defecto */
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7); /* Fondo oscuro semi-transparente */
            font-family: 'Open Sans', sans-serif;
            
        }

        .modal-content {
            background-color: #1e3188;
            color: #000000;
            width: 300px;
            margin: 10% auto; /* Centrar verticalmente */
            padding: 20px;
            border-radius: 5px;
            font-family: 'Open Sans', sans-serif;
            
        }

        
        .modal-boton{
            display: inline-block;
            background: linear-gradient(to bottom, #1e3188, #4F648B);
            /*--color9: #4F648B;
           
            /*--color9: #4F648B;
            --color10:#1e3188;*/
            width: 100px;
            height: 80px;
            text-align: center;
            
           
            color: #000000;
           
            font-family: 'Open Sans', sans-serif;
            font-weight: bold;
            font-size: 18px;
            /* Large font size */
            border: none;
            /* No border */
            border-radius: 30px;
            
            cursor: pointer;
            /* Cursor on hover */
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            /* Subtle shadow */
            animation: button-shimmer 2s infinite;
            transition: all 0.3s ease-in-out;
            /* Smooth transition */
            }


            /* Hover animation */
        .modal-boton:hover {
            background: linear-gradient(to bottom, #2c2f63, #5b67b7);
            animation: button-particles 1s ease-in-out infinite;
            transform: translateY(-2px);
            }
        /* ... Estilos anteriores ... */


        .close {
            color: #FFFFFF;
            float: right;
            font-size: 20px;
            font-weight: bold;
            cursor: pointer;
            font-family: 'Open Sans', sans-serif;
           
        }
        .mensaje-error{
            background-color: #1e3188;
            color: #000000;
            border-radius: 20px;
            width: 400px;
            height: 50px;
            text-align: center;
            top: 100px;
            left:500px;

        }
       

        h2{
            font-size: 60px;
            font-weight: bold;
            font-family: 'Open Sans', sans-serif;
            text-align: center;


        }
        label{
            font-size: 20px;
            font-weight: bold;
          
            font-family: 'Open Sans', sans-serif;


        }
        button{
            font-family: 'Open Sans', sans-serif;
        }

        body {
            background: #f0f0f0;
            font-family:'Open Sans', sans-serif;
            margin: 0;
            padding: 1%; /* Cambio a porcentaje */
            font-size: 1rem; /* Cambio a unidades rem */
            text-align: center;
        }

        .pagina{

            background-color: #f0f0f0;
            width: 300px;
            margin: 10% auto;
            padding: 20px;
            border-radius: 5px;
            font-family: 'Open Sans', sans-serif;
            text-align: center;


        }
        .beautiful-button {
            position: absolute;
           
            display: inline-block;
            background: linear-gradient(to bottom, #1e3188, #4F648B);
            /*--color9: #4F648B;
            --color10:#1e3188;*/
            width: 200px;
            height: 100px;
            text-align: center;
            top: 450px;
            left:580px;
            /* Gradient background */
            color: #000000;
            /* White text color */
            font-family:'Open Sans', sans-serif;
            /* Stylish and legible font */
            font-weight: bold;
            font-size: 18px;
            /* Large font size */
            border: none;
            /* No border */
            border-radius: 30px;
            /* Rounded corners 
            padding: 14px 28px;
            Large padding */
            cursor: pointer;
            /* Cursor on hover */
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            /* Subtle shadow */
            animation: button-shimmer 2s infinite;
            transition: all 0.3s ease-in-out;
            /* Smooth transition */
            }

            /* Hover animation */
        .beautiful-button:hover {
            background: linear-gradient(to bottom, #2c2f63, #5b67b7);
            animation: button-particles 1s ease-in-out infinite;
            transform: translateY(-2px);
            }
        /* ... Estilos anteriores ... */
        
        .password-input {
            background-color: #a5a5b0;
            border: 3px solid black; /* Estilo de borde predeterminado */
        }
        
        .password-input.invalid {
            background-color: #a5a5b0;
            border: 2px solid red; /* Estilo de borde en caso de contraseña no válida */
        }
        
        .password-input.valid {
            background-color: #a5a5b0;
            border: 2px solid white; /* Estilo de borde en caso de contraseña válida */
        }
        
        /* ... Estilos posteriores ... */
        .mostrar-ocultar-contrasena {
            position:absolute;
            background-color: #1e3188;
            --color: #a5a5b0;
            width: 30px; /* Ancho deseado */
            height: 30px; /* Alto deseado */
        }
        .mostrar-ocultar-contrasena1 {
            position:absolute;
            background-color: #1e3188;
            --color: #a5a5b0;
            width: 30px; /* Ancho deseado */
            height: 30px; /* Alto deseado */
        }

        input{
            background-color: #f0f0f0;
            
            height: 30px; /* Alto deseado */

        }

       
    </style>
</head>
<body>
     <!-- RAYAS DE ARRIBA,IZ -->
    <header class="fixed w-100">
        <div class="usuarioOp d-flex justify-content-end">
        <a href="login_prueba1.php" class="back-arrow rounded-pill d-flex justify-content-start">
            <img src="img/back.svg" alt="" height="50">
            <span class="regresar d-none text-white m-auto">Regresar</span>
         </a>
            
        </div>
    </header>

    <main class="d-flex">
        <div class="barraLateral fixed h-100">
            <a href="#"></a>
        </div>
        <div class="tasks d-flex">
        </div>
    </main>

    <div id="error-message" class="error-message" style="display: none;"></div>
    <div class="mensaje-error" style="visibility: <?php echo empty($contrasenaErr) ? 'hidden' : 'visible'; ?>">
    <?php echo $contrasenaErr; ?></div>
    <div class="spacer"></div>



    <div class="pagina"style="width: 300px;">
    <h2>Cambiar Contraseña</h2>
    <label>Por cuestiones de seguridad, se exije a los usuarios cambiar su contraseña</label>
    <!-- Botón para abrir el modal -->
    
    </div>
    <button class="beautiful-button" id="openModal">Cambiar Contraseña</button>
    
    <!-- Modal -->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close" id="closeModal">&times;</span>
            <h3>Cambiar Contraseña</h3>

            <!-- Agrega esto dentro del formulario HTML -->
            <div id="password-requirements">
                <p>Requisitos de contraseña:</p>
                <ul>
                    <li id="length-requirement">Al menos 8 caracteres</li>
                    <li id="uppercase-requirement">Al menos una letra mayúscula</li>
                    <li id="lowercase-requirement">Al menos una letra minúscula</li>
                    <li id="number-requirement">Al menos un número</li>
                    <li id="special-character-requirement">Al menos un carácter especial</li>
                </ul>
            </div>

            <form action="" method="POST">


                <div class="group">
                    <label for="nuevaContrasena">Nueva Contraseña:</label>
                    <input required="" type="password" class="input" id="nuevaContrasena" name="nuevaContrasena">
                    <img class="mostrar-ocultar-contrasena" src="img/ojoB.png" onclick="mostrarOcultarContrasena('nuevaContrasena')" alt="Mostrar / Ocultar Contraseña">


                    <label for="confirmarContrasena">Confirmar Contraseña:</label>
                    <input required="" type="password" class= "input" id="confirmarContrasena" name="confirmarContrasena">
                    <img class="mostrar-ocultar-contrasena1" src="img/ojoB.png" onclick="mostrarOcultarContrasena1('confirmarContrasena')" alt="Mostrar / Ocultar Contraseña1">

                
                    <br>
                    <br
                    <span class="error"><?php echo $contrasenaErr; ?></span>
                    <br>
                    
                </div>
                <script>
                    function mostrarOcultarContrasena(inputId) {
                        var input = document.getElementById(inputId);
                        var imagen = document.querySelector(`img[alt="Mostrar / Ocultar Contraseña"]`);
                        if (input && imagen) {
                            if (input.type === "password") {
                                input.type = "text"; // Mostrar la contraseña
                                imagen.src = "img/ojoA.png"; // Cambiar la imagen a un ojo abierto
                            } else {
                                input.type = "password"; // Ocultar la contraseña
                                imagen.src = "img/ojoB.png"; // Cambiar la imagen a un ojo cerrado
                            }
                        }
                    }

                    function mostrarOcultarContrasena1(inputId) {
                        var input = document.getElementById(inputId);
                        var imagen = document.querySelector(`img[alt="Mostrar / Ocultar Contraseña1"]`);
                        if (input && imagen) {
                            if (input.type === "password") {
                                input.type = "text"; // Mostrar la contraseña
                                imagen.src = "img/ojoA.png"; // Cambiar la imagen a un ojo abierto
                            } else {
                                input.type = "password"; // Ocultar la contraseña
                                imagen.src = "img/ojoB.png"; // Cambiar la imagen a un ojo cerrado
                            }
                        }
                    }


                    

                    // JavaScript para mostrar y ocultar el modal
                    var modal = document.getElementById("myModal");
                    var btnOpen = document.getElementById("openModal");
                    var btnClose = document.getElementById("closeModal");

                    btnOpen.onclick = function() {
                        modal.style.display = "block"; // Mostrar el modal
                    }

                    btnClose.onclick = function() {
                        modal.style.display = "none"; // Ocultar el modal
                    }

                    window.onclick = function(event) {
                        if (event.target === modal) {
                            modal.style.display = "none"; // Cerrar el modal si se hace clic fuera de él
                        }
                    }
                
    
                    var nuevaContrasenaInput = document.getElementById("nuevaContrasena");
                    var confirmarNuevaInput = document.getElementById("confirmarContrasena");
                    var passwordRequirements = document.getElementById("password-requirements");
                    
                     // JavaScript para validar la contraseña en tiempo real
   
                    
                    nuevaContrasenaInput.addEventListener("input", function() {
                        var password = nuevaContrasenaInput.value;
                        var lengthRequirement = document.getElementById("length-requirement");
                        var uppercaseRequirement = document.getElementById("uppercase-requirement");
                        var lowercaseRequirement = document.getElementById("lowercase-requirement");
                        var numberRequirement = document.getElementById("number-requirement");
                        var specialCharacterRequirement = document.getElementById("special-character-requirement");
                        
                        lengthRequirement.style.color = password.length >= 8 ? "white" : "red";
                        uppercaseRequirement.style.color = /[A-Z]/.test(password) ? "white " : "red";
                        lowercaseRequirement.style.color = /[a-z]/.test(password) ? "white" : "red";
                        numberRequirement.style.color = /\d/.test(password) ? "white" : "red";
                        specialCharacterRequirement.style.color = /[^A-Za-z0-9]/.test(password) ? "white" : "red";
                    });

                    nuevaContrasenaInput.addEventListener("input", function() {
                        var password = nuevaContrasenaInput.value;

                        // Validación de contraseña en tiempo real
                        var passwordIsValid = (
                            password.length >= 8 &&
                            /[A-Z]/.test(password) &&
                            /[a-z]/.test(password) &&
                            /\d/.test(password) &&
                            /[^A-Za-z0-9]/.test(password)
                        );

                        // Aplica las clases CSS según la validación
                        nuevaContrasenaInput.className = passwordIsValid ? "password-input valid" : "password-input invalid";
                    });

                    confirmarNuevaInput.addEventListener("input", function() {
                        var password = nuevaContrasenaInput.value;
                        var confirmation = confirmarNuevaInput.value;

                        // Validación de confirmación en tiempo real
                        var confirmationIsValid = (password === confirmation);

                        // Aplica las clases CSS según la validación
                        confirmarNuevaInput.className = confirmationIsValid ? "password-input valid" : "password-input invalid";
                    });
                    <?php
                    if (!empty($contrasenaErr)) {
                        echo "var errorMessage = document.getElementById('error-message');";
                        echo "errorMessage.innerHTML = '$contrasenaErr';";
                        echo "errorMessage.style.display = 'block';";
                    }
                    ?>

                </script>
               <button class="modal-boton" type="submit">Cambiar Contraseña</button>
            </form>
        </div>
    </div>

</body>
</html>

