<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hoja de vida</title>
    <link rel="stylesheet" href="css/estilo5.css">
    <link rel="stylesheet" href="css/estiloHV.css">
    <link rel="stylesheet" href="css/estiloBoton.css">
    <link rel="stylesheet" href="css/estiloModal.css"> <!-- Agrega el estilo del modal -->
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/comunicacionDocenteAlumno.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="jspdf.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@2.3.2/dist/signature_pad.min.js"></script>
    <script src="a.js"></script>
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
              <!-- #region -->
              <form class="container">
     
              <div class="row mb-5">
                        <h3>Hoja de vida</h3>
                     
                        <div class="col-md-5">
                            <label for="nombre" class="form-label">Nombre del estudiante</label>
                            <input type="text" class="form-control" id="nombre">
                        </div>
                        <div class="col-md-5">
                            <div>
                                <label for="Estudio" class="form-label">Plan de estudio</label>
                                <select class="form-select" id="estudio">
                                  <option value="0">Seleccione</option> 
                                    <option value="II">Ingeniería Industrial</option>
                                    <option value="ISC">Ingeniería en Sistemas Computacionales</option>
                                    <option value="IEM">Ingeniería en Electromecánica</option>
                                    <option value="IGE">Ingeniería en Gestión Empresarial</option>
                                    <option value="CP">Contador Público</option>
                                    <option value="IA">Ingeniería en Administración</option>
                                </select>
                            </div>
                        </div>
                    </div>


                <button type="submit" class="btn btn-primary mb-4">Generar PDF</button>
            </form>
        </div>


    </main>



    


</body>
</html>