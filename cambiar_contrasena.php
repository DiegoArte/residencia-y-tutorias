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
        $contrasenaErr = "La nueva contraseña no cumple con los requisitos.";
    } else {
        
    // Verificar que la nueva contraseña no sea igual a la contraseña actual
    $usuario = $_SESSION['usuario'];
    $sql = "SELECT contrasena FROM usuarios WHERE usuario = '$usuario'";
    $resultado = $conexion->query($sql);
    if ($resultado->num_rows == 1) {
        $row = $resultado->fetch_assoc();
        $contrasenaActual = $row['contrasena'];
        

        if ($nuevaContrasena === $contrasenaActual) {
            $contrasenaErr = "La nueva contraseña no puede ser igual a la contraseña actual. Por favor, elige una contraseña diferente.";
        } else {
            if ($nuevaContrasena === $confirmarContrasena) {
                // Actualiza la contraseña en la base de datos
                $sql = "UPDATE usuarios SET contrasena = '$nuevaContrasena' WHERE usuario = '$usuario'";
                if ($conexion->query($sql) === TRUE) {
                    echo "Contraseña actualizada con éxito.";
                    
                } else {
                    echo "Error al actualizar la contraseña: " . $conexion->error;
                }
            } else {
                $contrasenaErr = "Las contraseñas no coinciden. Por favor, asegúrate de que las contraseñas sean iguales en ambos campos.";
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
    
    <title>Cambiar Contraseña</title>
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
            width: 300px;
            margin: 10% auto; /* Centrar verticalmente */
            padding: 20px;
            border-radius: 5px;
            font-family: 'Open Sans', sans-serif;
            
        }

        .close {
            color: #aaaaaa;
            float: right;
            font-size: 20px;
            font-weight: bold;
            cursor: pointer;
            font-family: 'Open Sans', sans-serif;
           
        }

        h2{
            font-family: 'Open Sans', sans-serif;

        }
        button{
            font-family: 'Open Sans', sans-serif;
        }

        body {
            background: white;
            font-family: 'Inter UI', sans-serif;
            margin: 0;
            padding: 1%; /* Cambio a porcentaje */
            font-size: 1rem; /* Cambio a unidades rem */
            text-align: center;
        }

        .pagina{

            background-color: #ffffff;
            width: 300px;
            margin: 10% auto; /* Centrar verticalmente */
            padding: 100px;
            border-radius: 5px;
            font-family: 'Open Sans', sans-serif;

        }
        /* ... Estilos anteriores ... */
        
        .password-input {
            border: 1px solid #ccc; /* Estilo de borde predeterminado */
        }
        
        .password-input.invalid {
            border: 2px solid red; /* Estilo de borde en caso de contraseña no válida */
        }
        
        .password-input.valid {
            border: 2px solid green; /* Estilo de borde en caso de contraseña válida */
        }
        
        /* ... Estilos posteriores ... */

    </style>
</head>
<body>
    <div id="error-message" class="error-message" style="display: none;"></div>

    <div class="pagina">
    <h2>Cambiar Contraseña</h2>
    <label>Por cuestiones de seguridad, se exije a los usuarios cambiar su contraseña de </label>
    
    <!-- Botón para abrir el modal -->
    <button id="openModal">Cambiar Contraseña</button>
    </div>

    <!-- Modal -->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close" id="closeModal">&times;</span>
            <h3>Cambiar Contraseña</h3>
            <br>
            <label for="text">La nueva contraseña debe incluir:</label>
            <br>
            <label for="text">Mínimo un carácter especial</label>
            <br>
            <label for="text">Mínimo un número</label>
            <br>
            <label for="text">Debe de tener letras mayúsculas y minúsculas</label>
            <br>
            <form action="" method="POST">

                <label for="nuevaContrasena">Nueva Contraseña:</label>
                <input type="password" id="nuevaContrasena" name="nuevaContrasena" required>
                <br>
                <label for="confirmarContrasena">Confirmar Contraseña:</label>
                <input type="password" id="confirmarContrasena" name="confirmarContrasena" required>
                <br>
                <span class="error"><?php echo $contrasenaErr; ?></span>
                <br>
                <script>
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
                    
                    // En tu código PHP, puedes definir una variable que contenga el mensaje de error y luego mostrarla en JavaScript
                    <?php
                    if (!empty($contrasenaErr)) {
                        echo "var errorMessage = document.getElementById('error-message');";
                        echo "errorMessage.innerHTML = '$contrasenaErr';";
                        echo "errorMessage.style.display = 'block';";
                    }
                    ?>
                </script>
               <button type="submit">Cambiar Contraseña</button>
            </form>
        </div>
    </div>

</body>
</html>

