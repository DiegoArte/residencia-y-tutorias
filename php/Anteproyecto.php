<!DOCTYPE html>
<html lang="es">

<head>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet" />
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="css/estiloAnteproyecto.css" />
  <link rel="stylesheet" href="css/normalize.css" />
  <link rel="stylesheet" href="css/style.css" />
  <title>Anteproyecto</title>
  <link rel="icon" type="image/gif" href="css/plano.gif">
</head>

<body>
  <header class="fixed w-100">
    <div class="usuarioOp d-flex justify-content-end">
      <img src="img/profile.png" alt="" />
      <p>Usuario</p>
      <a href="#">Cerrar sesión</a>
    </div>
  </header>
  <main>
    <div class="barraLateral fixed h-100">
    </div>

    <div class="barraLateral fixed h-100">
      <a href="#"></a>
    </div>
    <div class="barraLateral fixed h-100">

      <button class="BtnResponder" name="responder">Responder </button>
      <button class="BtnReportes" name="Reportes">Reportes </button>
    </div>
    <form id="form1" name="form1" method="post" action="php/llena.php"  enctype="multipart/form-data">
      <style>
        table {
          width: 80%;
          border-collapse: collapse;
          position: absolute;
          top: 50%;
          left: 50%;
          transform: translate(-50%, -50%);
        }

        th,
        td {
  
          padding: 0;
          border: 1px solid black;
          text-align: center;
        }

        input {
          width: 100%;
        }
      </style>

      <form>
        <table>
          <tr>
            <th>Id</th>
            <th>Nombre Alumno</th>
            <th>Nombre del proyecto</th>
            <th>Empresa</th>
            <th>Anteproyecto</th>
          </tr>
          <tr>
            <td><input name="Id" type="text" id="Id"></td>
            <td><input name="Nombre_Alumno" type="text" id="Nombre_Alumno"></td>
            <td><input name="Nombre_del_proyecto" type="text" id="Nombre_del_proyecto"></td>
            <td><input name="Empresa" type="text" id="Empresa"></td>
            <td><input name="Anteproyecto" type="file" id="Anteproyecto"></td>
          </tr>

        </table>
        <button type="submit" value="Guardar">Enviar
          <div class="arrow-wrapper">
            <div class="arrow"></div>
          </div>
        </button>
        <button class="BtnEliminar" type="button">
        <span class="BtnEliminar__text">Eliminar</span>
        <span class="BtnEliminar__icon"><svg class="svg" height="512" viewBox="0 0 512 512" width="512"
            xmlns="http://www.w3.org/2000/svg">
            <title></title>
            <path d="M112,112l20,320c.95,18.49,14.4,32,32,32H348c17.67,0,30.87-13.51,32-32l20-320"
              style="fill:none;stroke:#fff;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></path>
            <line style="stroke:#fff;stroke-linecap:round;stroke-miterlimit:10;stroke-width:32px" x1="80" x2="432"
              y1="112" y2="112"></line>
            <path d="M192,112V72h0a23.93,23.93,0,0,1,24-24h80a23.93,23.93,0,0,1,24,24h0v40"
              style="fill:none;stroke:#fff;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></path>
            <line style="fill:none;stroke:#fff;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px" x1="256"
              x2="256" y1="176" y2="400"></line>
            <line style="fill:none;stroke:#fff;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px" x1="184"
              x2="192" y1="176" y2="400"></line>
            <line style="fill:none;stroke:#fff;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px" x1="328"
              x2="320" y1="176" y2="400"></line>
          </svg></span>
      </button>

      </form>
      <?php

      ?>
      
  </main>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
    crossorigin="anonymous"></script>
</body>

</html>