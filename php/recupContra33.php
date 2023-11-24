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
            $control = $_POST["variable2"];
            $contraseña = $_POST["contraseña"];
        }

        require '../php/db.php';
        $conexion=conectar();

        $consulta = "UPDATE usuarios SET contrasena = '$contraseña' WHERE usuario = '$control'";


        // Ejecutar la consulta SQL
        $resultado = $conexion->query($consulta);


        echo " <img src='../img/si.jpg' alt='correo enviado' class='img1'><hr><br>
        
        <label id='correoL'> La contraseña se ha actualizado con éxito. </label> <br>
        <label  id='correoL'> Vuelve a iniciar sesión con tu nueva contraseña. </label> <br><br>

        <button id='siguiente' class='enviar2' onclick='salir()'>Siguiente</button>
        <br><br><br>";
        
    
        ?>
    </div>

    <script>
        const ventanaEmergente = document.getElementById('ventanaEmergente2');

        // Mostrar la ventana de contraseñas modificadas
        window.onload = function() {
            ventanaEmergente.style.display = 'block';
            document.body.style.backgroundColor = '#000000b7'; // Oscurece el fondo
        }

        function salir() {
            window.location.href = '../loginTutorias.php';
        }
    </script>
</body>
</html>