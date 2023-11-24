<?php

session_start();
$id=$_SESSION['usuario'];
$idsec=$_GET['id'];

require 'php/app.php';
require 'php/Chat.php';
require 'php/Revision.php';

if($_SERVER['REQUEST_METHOD']==='POST'){
    if(count($_POST)>3) {
        $filas=Revision::find("idalumno='$idsec'");
        if(count($filas)==0) {
            $revision=new Revision($_POST);
            $revision->crear();
        }else {
            $revision=new Revision($_POST);
            $revision->actualizar("idalumno='$idsec'");
        }
        $valueLiberado=$_POST['liberado'];
        $actualizarDocumento=mysqli_query($db, "UPDATE documento SET liberado='$valueLiberado' WHERE idalumno='$idsec'");
        
    } else {
        $chat=new Chat($_POST);
        $chat->crear();
    }
    header("Location: ".$_SERVER["PHP_SELF"]."?id=".$idsec);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/comunicacionDocenteAlumno.css">
    <title>Comunicación docente-alumno</title>
</head>
<body>
    <header class="fixed w-100">
        <a href="<?php if ($_SESSION['tipo_usuario'] === 'docente'){ echo 'ANTEPROYECTO V.15/views/index(VISTA ASESOR).php'; } elseif ($_SESSION['tipo_usuario'] === 'alumno'){ echo 'ANTEPROYECTO v.15/views/index(VISTA ALUMNO).php'; } ?>" class="back-arrow rounded-pill d-flex justify-content-start">
            <img src="img/back.svg" alt="" height="50">
            <span class="regresar d-none text-white m-auto">Regresar</span>
        </a>
        <div class="usuarioOp d-flex justify-content-end">
            <img src="img/profile.png" alt="" >
            <?php
            $nombre = $_SESSION['nombre']; // Asigna el valor a $nombre
            echo '<p>' . $nombre . '</p>';
            ?>
            <div class="dropdown-content">
                <a href="logout.php">Cerrar sesión</a>
            </div>
        </div>
    </header>
    <div class="headerHidden"></div>

    <main class="d-flex">
        <div class="barraLateral fixed h-100">
            <a href="Anteproyecto.php" class="back-arrow rounded-pill d-flex">
                <img src="img/back.svg" alt="" height="50">
                <span class="regresar d-none text-white m-auto">Regresar</span>
            </a>
        </div>
        <div class="barraLateral h-100"></div>
        <div class="tasks row">
            <?php
                if($_SESSION['tipo_usuario']=="docente") {
                    include 'php/includes/comunicacionDocente.php';
                } elseif($_SESSION['tipo_usuario']=="alumno") {
                    include 'php/includes/comunicacionAlumno.php';
                }
            ?>
            
            <div class="col">
                <form class="chatbot" method="POST" action="">
                    <input type="text" name="idinput" style="display: none" value="<?php echo $id; ?>">
                    <input type="text" name="idaoutput" style="display: none" value="<?php echo $idsec; ?>">
                    <header>
                        <h2>Chat</h2>
                    </header>
                    <ul class="chatbox">
                    <?php foreach($chats as $msj): ?>
                        <li class="chat <?php if($msj->idinput==$id){echo "outgoing";} else{echo "incoming";} ?>">
                            <p><?php echo $msj->msj; ?></p>
                        </li>
                    <?php endforeach; ?>
                    </ul>
                    <fieldset class="chat-input">
                        <textarea name="msj" placeholder="Mensaje" spellcheck="false" required></textarea>
                        <span id="send-btn" class="material-symbols-rounded">
                            <svg height="24" width="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M1.946 9.315c-.522-.174-.527-.455.01-.634l19.087-6.362c.529-.176.832.12.684.638l-5.454 19.086c-.15.529-.455.547-.679.045L12 14l6-8-8 6-8.054-2.685z" fill="currentColor"></path>
                            </svg>
                        </span>
                    </fieldset>
                </form>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="js/comunicacionDocenteAlumno.js"></script>
    <script>
        document.getElementById('enviarFormulario').addEventListener('click', function() {
            var formulario = document.getElementsByClassName('checklist');
            formulario.submit();
        });
    </script>
</body>
</html>