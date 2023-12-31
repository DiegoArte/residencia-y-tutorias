<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario'])) {
    header("Location: loginResidencia.php"); // Redirige al usuario al formulario de inicio de sesión si no ha iniciado sesión
    exit();
}

// Establecer la conexión a la base de datos (ajusta los valores según tu configuración)
require 'php/db.php';
$conexion = conectar();

// Inicializa las variables
$nuevaContrasena = $confirmarContrasena = "";


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
       
        echo '<div class="mensaje-error">
                    <p>La nueva contraseña no cumple con los requisitos.</p>
                </div>';
                
    } else {
        
    // Verificar que la nueva contraseña no sea igual a la contraseña actual
    $usuario = $_SESSION['usuario'];
    $sql = "SELECT contrasena FROM usuarios WHERE usuario = '$usuario'";
    $resultado = $conexion->query($sql);
    if ($resultado->num_rows == 1) {
        $row = $resultado->fetch_assoc();
        $contrasenaActual = $row['contrasena'];
        

        if ($nuevaContrasena === $contrasenaActual) {
         
            echo '<div class="mensaje-error">
                    <p>La nueva contraseña no puede ser igual a la contraseña actual.Porfavor, elige una contraseña diferente </p>
                </div>';
                
        } else {
            if ($nuevaContrasena === $confirmarContrasena) {
                // Actualiza la contraseña en la base de datos
                $sql = "UPDATE usuarios SET contrasena = '$nuevaContrasena' WHERE usuario = '$usuario'";
                if ($conexion->query($sql) === TRUE) { 
                    echo '<div class="mensaje-error">
                    <p>Contraseña actualizada con éxito. <a class="enlace-exito" href="LoginResidencia.php">Regresar a login</a></p>

                </div>';
                
                } else {

                    echo '<div class="mensaje-error">
                    <p>Error. No se pudo actualizar la contraseña  </p>
                </div>';
                    
                   
                }
            } else {
                echo '<div class="mensaje-error">
                <p>Las contraseñas no coinciden. Por favor, asegúrate de que las contraseñas sean iguales en ambos campos.</p>
            </div>';
                
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

        .modal-content {
            background-color: #0D65D9;
            color: #ffffff;
            width: 500px;
            right: 100px;
            margin: 18% auto; /* Centrar verticalmente */
            padding: 20px;
            border-radius: 20px;
            font-family: 'Open Sans', sans-serif;
            font-size: 18px;
            
        }
        .enlace-exito {
            color:#2c2f63;  /* Cambia el color del texto del enlace a blanco */
            padding: 5px 10px; /* Añade relleno alrededor del enlace para hacerlo más grande */
            text-decoration: none; /* Quita el subrayado del enlace */
            font-weight: bold; /* Hace que el texto del enlace sea más audaz */
            transition: background-color 0.3s, color 0.3s; /* Agrega una transición suave al color de fondo y al color del texto al pasar el cursor sobre el enlace */
        }

        .enlace-exito:hover {
            color: #fff; /* Cambia el color de fondo al pasar el cursor */
           
            animation: button-particles 1s ease-in-out infinite;
            transform: translateY(-2px);
           
        }
        .modal-boton {
            font-size: 16px;
            position: relative;
            margin: auto;
            padding: 1em 2.5em 1em 2.5em;
            border: none;
            background: #3498DB;
            color: #FFF;
            transition: all 0.1s linear;
            box-shadow: 0 0.4em 1em rgba(0, 0, 0, 0.1);
            border-radius: 2em;
        }

        .modal-boton:active {
            transform: scale(0.95);
        }

        .modal-boton span {
        color: #464646;
        }

        .modal-boton .border {
            position: absolute;
            border: 0.15em solid #fff;
            transition: all 0.3s 0.08s linear;
            top: 50%;
            left: 50%;
            width: 9em;
            height: 3em;
            transform: translate(-50%, -50%);
        }

        .modal-boton:hover .border {
            display: block;
            width: 9.9em;
            height: 3.7em;
        }


        .close {
            color: #FFFFFF;
            float: right;
            font-size: 20px;
            font-weight: bold;
            cursor: pointer;
            font-family: 'Open Sans', sans-serif;
           
        }
        .mensaje-error {
            background: linear-gradient(to bottom, #49C2F2, white);
            color: #000000;
            border-radius: 20px;
            width: 500px;
            margin: auto;
            padding: 10px;
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
            top: 10%;
            left: 38%;
        }

       

        h3{
            font-size: 30px;
            font-weight: bold;
            font-family: 'Open Sans', sans-serif;
            color: #ffffff;
            text-align: center;


        }
        
        .req{
            font-size: 18px;
            font-weight: bold;
          
            font-family: 'Open Sans', sans-serif;

        }
        label{
            font-size: 20px;
          
            font-family: 'Open Sans', sans-serif;


        }
        button{
            font-family: 'Open Sans', sans-serif;
        }

        body {
            background: #f0f0f0;
            font-family:'Open Sans', sans-serif;
            margin: 0;
            font-size: 1rem; /* Cambio a unidades rem */
            text-align: center;
        }

        .pagina {
        background-color: #f0f0f0;
        width: 300px;
        margin: 0 auto;
        padding: 20px;
        border-radius: 5px;
        font-family: 'Open Sans', sans-serif;
        text-align: center;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

       
        /* ... Estilos anteriores ... */
        
        .password-input {
            background-color: #f0f0f0;
            border: 3px solid black; /* Estilo de borde predeterminado */
        }
        
        .password-input.invalid {
            background-color: #f0f0f0;
            border: 2px solid red; /* Estilo de borde en caso de contraseña no válida */
        }
        
        .password-input.valid {
            background-color: #f0f0f0;
            border: 2px solid #49C2F2; /* Estilo de borde en caso de contraseña válida */
        }
       

        /* ... Estilos posteriores ... */
        .mostrar-ocultar-contrasena {
            position:absolute;
            background-color: #0D65D9;
            --color: #a5a5b0;
            width: 50px; /* Ancho deseado */
            height: 50px; /* Alto deseado */
        }
        .mostrar-ocultar-contrasena1 {
            position:absolute;
            background-color: #0D65D9;
            --color: #a5a5b0;
            width: 50px; /* Ancho deseado */
            height: 50px; /* Alto deseado */
        }

        /* ENTRADAS DE TEXTO DONDE VA LA CONTRASEÑA*/
        input {
            background: WHITE;
            border: 2px solid #1E5C97;
            height: 40px;
            width: 300px;
            border-radius: 20px;
            padding: 10px;
            font-size: 16px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
        }

        input:hover {
            background: WHITE;
            border: 2px solid #1E5C97;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }

        input:focus {
            outline: none;
            border: 2px solid #3498DB;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        }




       

       
    </style>
</head>
<body>
     <!-- RAYAS DE ARRIBA,IZ -->
    <header class="fixed w-100">
        <div class="usuarioOp d-flex justify-content-end">
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
    
    
    
    <!-- Modal -->
    <div id="myModal" class="pagina">
        <div class="modal-content">
            
            <h3>Cambiar Contraseña</h3>

            <!-- Agrega esto dentro del formulario HTML -->
            <div id="password-requirements">
                <p class="req">Requisitos de contraseña:</p>
                <ul>
                    <li id="length-requirement">Al menos 8 caracteres</li>
                    <li id="uppercase-requirement">Al menos una letra mayúscula</li>
                    <li id="lowercase-requirement">Al menos una letra minúscula</li>
                    <li id="number-requirement">Al menos un número</li>
                    <li id="special-character-requirement">Al menos un carácter especial</li>
                </ul>
            </div>

            <!-- Agrega esto dentro del formulario HTML -->



   

            <form action="" method="POST">


                <div class="group">
                    <label for="nuevaContrasena">Nueva Contraseña:</label>
                    <input required="" type="password" class="input" id="nuevaContrasena" name="nuevaContrasena">
                    <img class="mostrar-ocultar-contrasena" src="img/ojoBi.png" onclick="mostrarOcultarContrasena('nuevaContrasena')" alt="Mostrar / Ocultar Contraseña">


                    <label for="confirmarContrasena">Confirmar Contraseña:</label>
                    <input required="" type="password" class= "input" id="confirmarContrasena" name="confirmarContrasena">
                    <img class="mostrar-ocultar-contrasena1" src="img/ojoBi.png" onclick="mostrarOcultarContrasena1('confirmarContrasena')" alt="Mostrar / Ocultar Contraseña1">

                
                    <br>
                    <br
                    
                </div>
                <script>
                    function mostrarOcultarContrasena(inputId) {
                        var input = document.getElementById(inputId);
                        var imagen = document.querySelector(`img[alt="Mostrar / Ocultar Contraseña"]`);
                        if (input && imagen) {
                            if (input.type === "password") {
                                input.type = "text"; // Mostrar la contraseña
                                imagen.src = "img/ojoAbi.png"; // Cambiar la imagen a un ojo abierto
                            } else {
                                input.type = "password"; // Ocultar la contraseña
                                imagen.src = "img/ojoBi.png"; // Cambiar la imagen a un ojo cerrado
                            }
                        }
                    }

                    function mostrarOcultarContrasena1(inputId) {
                        var input = document.getElementById(inputId);
                        var imagen = document.querySelector(`img[alt="Mostrar / Ocultar Contraseña1"]`);
                        if (input && imagen) {
                            if (input.type === "password") {
                                input.type = "text"; // Mostrar la contraseña
                                imagen.src = "img/ojoAbi.png"; // Cambiar la imagen a un ojo abierto
                            } else {
                                input.type = "password"; // Ocultar la contraseña
                                imagen.src = "img/ojoBi.png"; // Cambiar la imagen a un ojo cerrado
                            }
                        }
                    }
                                
                    // JavaScript para validar la contraseña en tiempo real "#aef359"
                    var nuevaContrasenaInput = document.getElementById("nuevaContrasena");
                    var passwordRequirements = document.getElementById("password-requirements");
                    
                    nuevaContrasenaInput.addEventListener("input", function() {
                        var password = nuevaContrasenaInput.value;
                        var lengthRequirement = document.getElementById("length-requirement");
                        var uppercaseRequirement = document.getElementById("uppercase-requirement");
                        var lowercaseRequirement = document.getElementById("lowercase-requirement");
                        var numberRequirement = document.getElementById("number-requirement");
                        var specialCharacterRequirement = document.getElementById("special-character-requirement");
                        
                        lengthRequirement.style.color = password.length >= 8 ? "#66ff66" : "red";
                        uppercaseRequirement.style.color = /[A-Z]/.test(password) ? "#66ff66"  : "red";
                        lowercaseRequirement.style.color = /[a-z]/.test(password) ? "#66ff66"  : "red";
                        numberRequirement.style.color = /\d/.test(password) ? "#66ff66"  : "red";
                        specialCharacterRequirement.style.color = /[^A-Za-z0-9]/.test(password) ? "#66ff66"  : "red";
                        
                        // Aplica clases al campo de contraseña
                        nuevaContrasenaInput.className = (
                            (password.length >= 8 && /[A-Z]/.test(password) && /[a-z]/.test(password) && /\d/.test(password) && /[^A-Za-z0-9]/.test(password))
                            ? "password-input valid"
                            : "password-input invalid"
                        );
                    });


                   

                    var nuevaContrasenaInput = document.getElementById("nuevaContrasena");
                    var confirmarNuevaInput = document.getElementById("confirmarContrasena");

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
                                
                                    
                                

                </script>
               <button class="modal-boton" type="submit">Cambiar Contraseña</button>
            </form>
        </div>
    </div>

</body>
</html>

