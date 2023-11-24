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
    
<div class="ventana-emergente" id="ventanaEmergente">
        <h1>Recuperar contraseña</h1>
        <p>Ingrese la dirección de su correo electrónico (gmail) que utilizó para su registro. <br>
            Recibirás un correo electrónico que te permitirá volver a conectarte.</p>
        <hr><br>

        <form method="post" action="../php/recupContra1.php">
            <label id="correoL";>Su correo electronico </label><br>
            <input type='hidden' name='variab' value=10000>
            <input placeholder="@gmail.com" required="" type="email" id="correo1" name="correo"><br><br><br>
            <button id="cerrarVentana" class="cerrar" onclick="regresar()">Cancelar</button>
            <button id="enviar" class="enviar1" name="envi">Mandar correo</button>
        </form>
            <br><br><br>
    </div>


    <script>
        const ventanaEmergente = document.getElementById('ventanaEmergente');

        // Mostrar la ventana de pedir correo
        window.onload = function() {
            ventanaEmergente.style.display = 'block';
            document.body.style.backgroundColor = '#000000b7'; // Oscurece el fondo
        }

        function regresar() {
            window.location.href = '../LoginResidencia.php';
        }
    </script>

</body>
</html>