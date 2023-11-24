<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="../css/recupContra.css">
    <style>
        .imagen {
            position: absolute;
            left: 5%;
            top: 50%;
            transform: translateY(-50%);
            width: 200px; /* Ancho de la imagen */
            height: 300px; /* Alto de la imagen */
            background-image: url('img/Logo-TecNM.png'); /* Ruta a tu imagen */
            background-size: cover; /* Ajusta la imagen al tamaño del contenedor */
        }
        p{
            font-size: 20px;
        }
        label{
            font-size: 20px;
        }
    </style>
</head>
<body>
    <div class="imagen"></div>

    <div class="ventana-emergente" id="ventanaEmergente2">
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $numAlea = $_POST["variable1"];
            $control = $_POST["variable2"];
            $dirCorreo = $_POST["variable3"];
            $num1 = $_POST["num1"];
            $num2 = $_POST["num2"];
            $num3 = $_POST["num3"];
            $num4 = $_POST["num4"];
            $num5 = $_POST["num5"];
        }

        list($digito1, $digito2, $digito3, $digito4, $digito5) = str_split($numAlea);

        
        if ($num1 == $digito1 and $num2 == $digito2 and $num3 == $digito3 and $num4 == $digito4 and $num5 == $digito5){
            echo"
            <img src='../img/si.jpg' alt='correo enviado' class='img1'>
            <p>El código de recuperación es correcto, puedes cambiar tu contraseña</p>
            <hr><br>

            <form method='post' action='../php/recupContra3.php' onsubmit='return validarContraseñas();'>
                <input type='hidden' name='variable2' value='$control'>
                <label id='correoL'>Nueva contraseña</label><br>
                <input required='' type='password' id='contra1' name='contraseña' class='campo'/><br><br>
                <label id='correoL'>Confirmar contraseña</label><br>
                <input required='' type='password' id='contra2' class='campo'/><br><br><br>
                <button id='cerrarVentana2' class='cerrar' onclick='regresar()'>Cancelar</button>
                <button id='siguiente' class='enviar1'>Siguiente</button>
            </form>
            <br><br><br>";
        }else {
            echo " <img src='../img/no.jpg' alt='correo enviado' class='img1'><hr><br>
            
            <label id='error1'> El código de recuperación es incorrecto, por favor intente de nuevo. </label> <br><br>
            <label  id='error1'> Le mandaremos otro código de verificación a su correo electrónico. </label> <br><br><br>
            <form method='post' action='../php/recupContra1.php'>
                <input type='hidden' name='variab' value='$numAlea'>
                <input type='hidden' name='correo' value='$dirCorreo'>
                <button type'submit' id='siguiente' class='enviar1'>Siguiente</button>
            </form>
            <button id='' class='cerrar' onclick='regresar()'>Cancelar</button>
            <br><br><br>";
        }
        ?>
    </div>

    <script>
        const ventanaEmergente = document.getElementById('ventanaEmergente2');

        // Mostrar la ventana de pedir contraseñas
        window.onload = function() {
            ventanaEmergente.style.display = 'block';
            document.body.style.backgroundColor = '#000000b7'; // Oscurece el fondo
        }


        function regresar() {
            window.location.href = '../LoginResidencia.php';
        }


        // Función para verificar si las contraseñas son iguales
        function validarContraseñas() {
            var password1 = document.getElementById("contra1").value;
            var password2 = document.getElementById("contra2").value;

            if (password1 !== password2) {
                alert("Las contraseñas no coinciden");
                return false; // Evita que el formulario se envíe
            }

            return true; // Permite que el formulario se envíe si las contraseñas coinciden
        }
    </script>
</body>
</html>