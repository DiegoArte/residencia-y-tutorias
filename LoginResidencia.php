<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estiloLogin.css">
    <link rel="stylesheet" href="css/normalize.css">
    <script src="js/scriptLogin.js"></script>
    <title>Login</title>
</head>
<body>
    <div class="contenedor">
        <img src="img/Logo-TecNM.png" alt="Logo TecNM">
        <div class="recuadroBienvenido">
            <p>BIENVENIDO</p>
        </div>
        <div class="recuadroUC">
            <form action="" method="POST">
                <div class="group">
                <input required="" type="text" class="input" id="usuarioInput" name="usuarioInput">
                    <span class="highlight"></span>
                    <span class="bar"></span>
                    <label>Usuario</label>
                </div>
                <div class="group">
                <input required="" type="password" class="input" id="contrasenaInput" name="contrasenaInput">
                    <span class="highlight"></span>
                    <span class="bar"></span>
                    <label>Contraseña</label>
                    <!-- Agrega el botón de mostrar/ocultar contraseña aquí -->
                    <div class="mostrar-contrasena" onclick="mostrarContrasena(this)">
                        <svg class="eye" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 576 512">
                            <!-- Agrega el código SVG del ojo abierto aquí -->
                            <path d="M288 32c-80.8 0-145.5 36.8-192.6 80.6C48.6 156 17.3 208 2.5 243.7c-3.3 7.9-3.3 16.7 0 24.6C17.3 304 48.6 356 95.4 399.4C142.5 443.2 207.2 480 288 480s145.5-36.8 192.6-80.6c46.8-43.5 78.1-95.4 93-131.1c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C433.5 68.8 368.8 32 288 32zM144 256a144 144 0 1 1 288 0 144 144 0 1 1 -288 0zm144-64c0 35.3-28.7 64-64 64c-7.1 0-13.9-1.2-20.3-3.3c-5.5-1.8-11.9 1.6-11.7 7.4c.3 6.9 1.3 13.8 3.2 20.7c13.7 51.2 66.4 81.6 117.6 67.9s81.6-66.4 67.9-117.6c-11.1-41.5-47.8-69.4-88.6-71.1c-5.8-.2-9.2 6.1-7.4 11.7c2.1 6.4 3.3 13.2 3.3 20.3z"></path>

                        </svg>
                        <svg class="eye-slash" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 640 512">
                            <!-- Agrega el código SVG del ojo tachado aquí -->
                            <path d="M38.8 5.1C28.4-3.1 13.3-1.2 5.1 9.2S-1.2 34.7 9.2 42.9l592 464c10.4 8.2 25.5 6.3 33.7-4.1s6.3-25.5-4.1-33.7L525.6 386.7c39.6-40.6 66.4-86.1 79.9-118.4c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C465.5 68.8 400.8 32 320 32c-68.2 0-125 26.3-169.3 60.8L38.8 5.1zM223.1 149.5C248.6 126.2 282.7 112 320 112c79.5 0 144 64.5 144 144c0 24.9-6.3 48.3-17.4 68.7L408 294.5c8.4-19.3 10.6-41.4 4.8-63.3c-11.1-41.5-47.8-69.4-88.6-71.1c-5.8-.2-9.2 6.1-7.4 11.7c2.1 6.4 3.3 13.2 3.3 20.3c0 10.2-2.4 19.8-6.6 28.3l-90.3-70.8zM373 389.9c-16.4 6.5-34.3 10.1-53 10.1c-79.5 0-144-64.5-144-144c0-6.9 .5-13.6 1.4-20.2L83.1 161.5C60.3 191.2 44 220.8 34.5 243.7c-3.3 7.9-3.3 16.7 0 24.6c14.9 35.7 46.2 87.7 93 131.1C174.5 443.2 239.2 480 320 480c47.8 0 89.9-12.9 126.2-32.5L373 389.9z"></path>

                        </svg>
                    </div>
                    <!-- Fin del botón de mostrar/ocultar contraseña -->
                </div>
                <!-- Botón "Sign up" -->
                <div class="main_div">
                    <button>Inciar Secion</button>
                </div> 

            </form>
        </div>
    </div>

    

    <?php
    session_start(); // Inicia la sesión (si no lo has hecho ya)

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Establece la conexión a la base de datos (ajusta los valores según tu configuración)
        $conexion = new mysqli("localhost", "root", "", "Tutorias_Residencia");

        if ($conexion->connect_error) {
            die("La conexión a la base de datos falló: " . $conexion->connect_error);
        }

        // Obtiene los datos del formulario
        $usuario = $_POST['usuarioInput'];
        $contrasena = $_POST['contrasenaInput'];

        // Consulta la base de datos para verificar el usuario y la contraseña
        $sql = "SELECT usuario, tipo_usuario FROM usuarios WHERE usuario = '$usuario' AND contrasena = '$contrasena'";
        $resultado = $conexion->query($sql);

        if ($resultado->num_rows == 1) {
            // Inicio de sesión exitoso, almacena el nombre de usuario y tipo de usuario en la sesión
            $row = $resultado->fetch_assoc();
            $_SESSION['usuario'] = $row['usuario'];
            $_SESSION['tipo_usuario'] = $row['tipo_usuario'];
        
            // Redirecciona a la página correspondiente según el tipo de usuario
            if ($_SESSION['tipo_usuario'] === 'Admistrador') {
                header("Location: princi_Super_Admin.php");
                exit; // Termina el script después de la redirección
            } elseif ($_SESSION['tipo_usuario'] === 'docente') {
                header("Location: princi_Super_Admin.php");
                exit;
            } elseif ($_SESSION['tipo_usuario'] === 'alumno') {
                header("Location: princi_Super_Admin.php");
                exit;
            }
        } else {
            // Inicio de sesión fallido, muestra un mensaje de error
            echo '<div class="mensaje-error">
                    <p>Inicio de sesión fallido. Verifica tu usuario y contraseña.</p>
                </div>';
        }

        // Cierra la conexión a la base de datos
        $conexion->close();
    }
    ?>

</body>
</html>
