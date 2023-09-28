<?php

require 'php/Revision.php';
if($_SERVER['REQUEST_METHOD']==='POST'){
    $revision=new Revision($_POST);
    $revision->crear();
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
    <title>Document</title>
</head>
<body>
    <header class="fixed w-100">
        <a href="" class="back-arrow rounded-pill d-flex justify-content-start">
            <img src="img/back.svg" alt="" height="50">
            <span class="regresar d-none text-white m-auto">Regresar</span>
        </a>
        <div class="usuarioOp d-flex justify-content-end">
            <img src="img/profile.png" alt="" >
            <p>Usuario</p>
            <div class="dropdown-content">
                <a href="#">Cerrar sesión</a>
            </div>
        </div>
    </header>
    <div class="headerHidden"></div>

    <main class="d-flex">
        <div class="barraLateral fixed h-100">
            <a href="" class="back-arrow rounded-pill d-flex">
                <img src="img/back.svg" alt="" height="50">
                <span class="regresar d-none text-white m-auto">Regresar</span>
            </a>
        </div>
        <div class="barraLateral h-100"></div>
        <div class="tasks row">
            <div class="col">
                <form class="checklist" method="POST" action="">
                    <input value="1" name="nombreProyecto" type="checkbox" id="01">
                    <label for="01">Nombre del proyecto</label>
                    <textarea name="comnombreProyecto" id="" cols="20" rows="1" placeholder="Escribe un comentario" ></textarea>
                    <input value="1" name="empresa" type="checkbox" id="02">
                    <label for="02">Empresa</label>
                    <textarea name="comempresa" id="" cols="20" rows="1" placeholder="Escribe un comentario" ></textarea>
                    <input value="1" name="objetivos" type="checkbox" id="03">
                    <label for="03">Objetivos</label>
                    <textarea name="comobjetivos" id="" cols="20" rows="1" placeholder="Escribe un comentario" ></textarea>
                    <input value="1" name="justificacion" type="checkbox" id="04">
                    <label for="04">Justificación</label>
                    <textarea name="comjustificacion" id="" cols="20" rows="1" placeholder="Escribe un comentario" ></textarea>
                    <input value="1" name="cronograma" type="checkbox" id="05">
                    <label for="05">Cronograma de act.</label>
                    <textarea name="comcronograma" id="" cols="20" rows="1" placeholder="Escribe un comentario" ></textarea>
                    <input value="1" name="descripcion" type="checkbox" id="06">
                    <label for="06">Descripción de act.</label>
                    <textarea name="comdescripcion" id="" cols="20" rows="1" placeholder="Escribe un comentario" ></textarea>
                    <button id="enviarFormulario">
                        <div class="svg-wrapper-1">
                            <div class="svg-wrapper">
                            <svg height="24" width="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M1.946 9.315c-.522-.174-.527-.455.01-.634l19.087-6.362c.529-.176.832.12.684.638l-5.454 19.086c-.15.529-.455.547-.679.045L12 14l6-8-8 6-8.054-2.685z" fill="currentColor"></path>
                            </svg>
                            </div>
                        </div>
                        <span>Enviar</span>
                    </button>
                </form>
            </div>
            
            <div class="col">
                <form class="chatbot">
                    <header>
                        <h2>Chat</h2>
                    </header>
                    <ul class="chatbox">
                    </ul>
                    <div class="chat-input">
                        <textarea placeholder="Mensaje" spellcheck="false" required></textarea>
                        <span id="send-btn" class="material-symbols-rounded">
                            <svg height="24" width="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M1.946 9.315c-.522-.174-.527-.455.01-.634l19.087-6.362c.529-.176.832.12.684.638l-5.454 19.086c-.15.529-.455.547-.679.045L12 14l6-8-8 6-8.054-2.685z" fill="currentColor"></path>
                            </svg>
                        </span>
                    </div>
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