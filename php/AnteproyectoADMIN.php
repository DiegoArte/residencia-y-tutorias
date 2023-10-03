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

<head>
  <title>Conexión a la Base de Datos y Visualización de PDF</title>
  <style>
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 240px;
    }

    th,
    td {
      border: 1px solid black;
      padding: 8px;
      text-align: left;
    }

    th {
      background-color: #f2f2f2;
    }
  </style>
</head>

<body>

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
      <div id="message">
        <?php
        function conectar()
        {
          $conexion = mysqli_connect("localhost", "root", "", "anteproyecto");

          if (!$conexion) {
            echo "No se puede establecer una conexión: " . mysqli_connect_error();
            return;
          }

          // Consulta para obtener todos los registros de la tabla 'archivos'
          $consulta = "SELECT * FROM archivos";
          $resultado = mysqli_query($conexion, $consulta);

          if ($resultado) {
            // Mostrar los resultados en una tabla
            echo "<h2>Datos de la tabla 'archivos':</h2>";
            echo "<table>";
            echo "<tr><th>ID</th><th>Nombre del alumno</th><th>Nombre del proyecto</th><th>Empresa</th><th>Ver PDF</th></tr>";

            while ($fila = mysqli_fetch_assoc($resultado)) {
              $ruta_pdf = $fila['Ruta_Anteproyecto'];

              // Verifica la ruta del archivo PDF
              if (!file_exists($ruta_pdf)) {
                echo "El archivo PDF no existe: $ruta_pdf";
                return;
              }

              echo "<tr>";
              echo "<td>{$fila['Id']}</td>";
              echo "<td>{$fila['Nombre_Alumno']}</td>";
              echo "<td>{$fila['Nombre_del_proyecto']}</td>";
              echo "<td>{$fila['Empresa']}</td>";
              echo "<td><a href='#' onclick='visualizarPDF(\"" . $ruta_pdf . "\")'>Ver PDF</a></td>";
              echo "</tr>";
            }

            echo "</table>";
          } else {
            echo "Error en la consulta: " . mysqli_error($conexion);
          }

          // Liberar el resultado y cerrar la conexión
          mysqli_free_result($resultado);
          mysqli_close($conexion);
        }

        function visualizarPDF($ruta_pdf)
        {
          // Obtiene el contenido del archivo PDF
          $contenido = file_get_contents($ruta_pdf);

          // Crea un objeto DOMDocument
          $doc = new DOMDocument();

          // Carga el contenido del archivo PDF en el objeto DOMDocument
          $doc->loadHTML($contenido);

          // Obtiene el elemento <body> del documento PDF
          $body = $doc->getElementsByTagName("body")->item(0);

          // Elimina todos los elementos del documento PDF
          $body->removeChild($body->firstChild);


          // Muestra el archivo PDF en un visor de PDF
          echo "<embed src='" . $ruta_pdf . "' type='application/pdf' width='100%' height='700px'></embed>";
        }

        conectar();
        ?>
      </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
      crossorigin="anonymous"></script>
  </body>

</html>