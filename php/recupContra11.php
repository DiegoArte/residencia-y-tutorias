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
    </style>
</head>
<body>


    <div class="imagen"></div>

    <div class="ventana-emergente" id="ventanaEmergente2">
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $dirCorreo = $_POST["correo"];
            $numAlea = $_POST["variab"];
        }

        require '../php/db.php';
        $conexion=conectar();

        $consulta = "SELECT NumerodeControl FROM alumnos WHERE correo = '$dirCorreo'";

        // Ejecutar la consulta SQL
        $resultado = $conexion->query($consulta);
        $control = 0;

        // Verificar si la consulta fue exitosa
        if ($resultado && $resultado->num_rows > 0) {
            // Iterar a través de los resultados
            while ($fila = $resultado->fetch_assoc()) {
                $control = $fila['NumerodeControl'];
            }
        } else {
            $consulta = "SELECT NumerodeControl FROM docentes WHERE correo = '$dirCorreo'";

            // Ejecutar la consulta SQL
            $resultado = $conexion->query($consulta);
            $control = 0;

            // Verificar si la consulta fue exitosa
            if ($resultado && $resultado->num_rows > 0) {
                // Iterar a través de los resultados
                while ($fila = $resultado->fetch_assoc()) {
                    $control = $fila['NumerodeControl'];
                }
            }
        }
        // Cerrar la conexión
        $conexion->close();
        
        use PHPMailer\PHPMailer\PHPMailer;
        use vendor\PHPMailer\PHPMailer\SMTP;
        use vendor\PHPMailer\PHPMailer\Exception;
        if ($control != 0){

            require '../vendor1/autoload.php';

            $mail = new PHPMailer(true);
            $mail->CharSet = 'UTF-8';

            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'frausto754537@gmail.com';
            $mail->Password = 'aburttbcwwelhtuv';//abur ttbc wwel htuv
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->setFrom('frausto754537@gmail.com', 'ITSZaS');
            $mail->addAddress($dirCorreo, 'Usuario');
            $mail->addCC('concopia@gmail.com');

            $numAlea = rand(10000, 99999);

            $mail->isHTML(true);
            $mail->Subject = 'Recuperación de contraseña';
            $mail->Body = "Hola, <br/>Tu código de recuperación es \"$numAlea\"";
            $mail->send();

            echo"
            <img src='../img/enviado.jpg' alt='correo enviado' class='img1'>
            <p>El código de recuperación se ha enviado a su cuenta de correo electrónico.</p>
            <hr><br>

            <form  method='post' action='../php/recupContra22.php'>
                <label id='correoL'>Código de recuperación</label><br>
                <input type='hidden' name='variable1' value='$numAlea'>
                <input type='hidden' name='variable2' value='$control'>
                <input type='hidden' name='variable3' value='$dirCorreo'>
                <input required='' type='text' name='num1' id='codigo' class='campo'/>
                <input required='' type='text' name='num2' id='codigo' class='campo'/>
                <input required='' type='text' name='num3' id='codigo' class='campo'/>
                <input required='' type='text' name='num4' id='codigo' class='campo'/>
                <input required='' type='text' name='num5' id='codigo' class='campo'/><br><br><br>
                <button class='cerrar' onclick='regresa()'>Cancelar</button>
                <button id='siguiente' class='enviar1'>Siguiente</button>
            </form>
            <br><br><br>";
        }else {
            echo "<img src='../img/no.jpg' alt='correo enviado' class='img1'><hr>
            <label id='error1'> La dirección de correo electrónico <br>
             no se encuentra registrada actualmente. </label> <br>

             <label  id='error1'> Asegurate de escribir correctamente <br>
             tu dirección de correo electrónico. </label> <br><br>

            <button id='cerrarVentana2' class='cerrar1' onclick='regresar()'>Regresar</button>
            <br><br><br>";
        }
    
        ?>
    </div>

    <script>
        const ventanaEmergente = document.getElementById('ventanaEmergente2');

        // Mostrar la ventana de pedir correo
        window.onload = function() {
            ventanaEmergente.style.display = 'block';
            document.body.style.backgroundColor = '#000000b7'; // Oscurece el fondo
        }


        const campos = document.querySelectorAll('.campo');
        campos.forEach((campo, index) => {
            campo.addEventListener('input', () => {
                if (campo.value.length === 1) {
                    const siguienteCampo = campos[index + 1];
                    if (siguienteCampo) {
                        siguienteCampo.focus();
                    }
                }
            });
        });


        function regresar() {
            window.location.href = '../loginTutorias.php';
        }
        function regresa() {
            window.location.href = '../loginTutorias.php';
        }
    </script>
</body>
</html>