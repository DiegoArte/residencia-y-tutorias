<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">  
    <title>Hoja de vida</title>
    <link rel="stylesheet" href="css/estilo5.css">
    <link rel="stylesheet" href="css/estilofromatos.css">
    <link rel="stylesheet" href="css/estiloBoton.css">
    <link rel="stylesheet" href="css/estiloModal.css"> <!-- Agrega el estilo del modal -->
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/comunicacionDocenteAlumno.css">
    <script src="js/scriptCarrera.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
    <!-- RAYAS DE ARRIBA,IZ -->
    <header class="fixed w-100">
        <div class="usuarioOp d-flex justify-content-end">
            <img src="img/profile.png" alt="" >
            <p>Usuario</p>
            <a href="#">Cerrar sesión</a>
        </div>
    </header>

    <main class="d-flex">
        <div class="barraLateral fixed h-100">
            <a href="#"></a>
        </div>
        <div class="tasks d-flex">
        </div>

        <div class="container">
            <h2>Registrate</h2>
            <form action="REGISTRAR.php" method="post">
                <label for="Nombre">Nombre:</label>
                <input type="text" id="Nombre" name="Nombre" required>

                <label for="Edad">Edad:</label>
                <input type="number" id="Edad" name="Edad" required>
                
                <label for="edad">Genero:</label>
                <input type="text" id="Genero" name="Genero" required>
                
                <label for="Email">Email:</label>
                <input type="email" id="Email" name="Email" required>
                
                <label for="Contrasena">Contrasena:</label>
                <input type="text" id="Contrasena" name="Contrasena" required>
                
                <label for="Ccontrasena">Confirmar Contraseña:</label>
                <input type="text" id="Ccontrasena" name="Ccontrasena" required>
                

                <input class="botonenviar" type="submit" value="Enviar">
            </form>
        </div>

    </main>



    


</body>
</html>