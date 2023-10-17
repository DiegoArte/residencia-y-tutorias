<?php
session_start(); // Inicia la sesión (si no lo has hecho ya)

// Destruye todas las variables de sesión
session_destroy();

// Redirige al usuario a la página de inicio de sesión
if($_SESSION['pagina']=='tutorias'){
    header("Location: loginTutorias.php");
    exit();
}else{
    header("Location: LoginResidencia.php");
    exit();
}

?>
