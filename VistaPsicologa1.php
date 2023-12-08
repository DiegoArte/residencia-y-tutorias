<?php
session_start();
$carrera = $_GET['carrera'] ?? "";
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet" />
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="css/estiloVisPsico1.css" />
  <link rel="stylesheet" href="css/normalize.css" />
  <link rel="stylesheet" href="css/style.css" />
  <title>Psicologia</title>
  <link rel="icon" type="image/gif" href="css/plano.gif">
</head>

<body>
  <main>
    <div class="barraLateral fixed h-100">
    </div>
    <div class="barraLateral fixed h-100">

      <header class="fixed w-100">
        <div class="usuarioOp d-flex justify-content-end">
          <img src="img/profile.png" alt="" />
          <?php
          $nombre = $_SESSION['nombre']; // Asigna el valor a $nombre
          echo '<p>' . $nombre . '</p>';
          ?>
          <a href="#">Cerrar sesión</a>
        </div>
      </header>

    </div>
    <div class="barraLateral fixed h-100">
    </div>
    <table>
      <tr>
        <th>Reporte</th>
        <th>Número de control</th>
        <th>Nombre del Alumno</th>
        <th>Nombre del maestro que envía</th>
        <th>Motivo</th>
        <th>Responder</th>
        <th>Formato pdf</th>
      </tr>

      <?php
      // Conecta a la base de datos (reemplaza con tus credenciales)
      require 'php/db.php';

      try {
        $conn = conectar();

        // Consulta SQL para enumerar las filas
        $sl = "SELECT reporte, nocontrol, nomAlu, nomMaes, motivo FROM tablavispsico";
        $rep = $conn->query($sl);

        // Almacena todas las filas de la consulta en un array
        $filas = [];
        while ($fila = $rep->fetch_assoc()) {
          $filas[] = $fila;
        }

        // Cierra el recurso de resultado de la primera consulta
        $rep->close();

        // Consulta SQL para obtener todos los registros
        $consulta = "SELECT id, archivo FROM tabla_pdf";
        $resultado = $conn->query($consulta);

        // Almacena todos los archivos en un array
        $archivos = [];
        while ($fila = $resultado->fetch_assoc()) {
          $archivo = base64_encode($fila['archivo']);
          $archivos[] = $archivo;
        }

        // Cierra el recurso de resultado de la segunda consulta
        $resultado->close();


        // Consulta SQL para obtener todos los registros
        $consulta = "SELECT reporte FROM tabla1_pdf";
        $resultado55 = $conn->query($consulta);

        $data = array();
        // Obtener cada fila como un arreglo asociativo
        while ($rows = $resultado55->fetch_assoc()) {
          //$data[] = $rows;
          $data[] = strval($rows['reporte']);
        }

        // Cierra el recurso de resultado de la segunda consulta
        $resultado55->close();


        if (count($filas) > 0) {
          // Imprime los datos en la tabla
          $cont = 0;
          foreach ($filas as $row) {
            // Verifica si el valor de $row["reporte"] está en $data
            $filaEnVerde = in_array($row["reporte"], $data);

            // Aplica un estilo de fondo verde si la condición es verdadera
            $style = $filaEnVerde ? 'background-color: rgba(0, 253, 55, 0.377);' : '';

            // Imprime la fila con el estilo condicional
            echo '<tr style="' . $style . '">';
            echo "<td>" . $row["reporte"] . "</td>";
            echo "<td>" . $row["nocontrol"] . "</td>";
            echo "<td>" . $row["nomAlu"] . "</td>";
            echo "<td>" . $row["nomMaes"] . "</td>";
            echo "<td>" . $row["motivo"] . "</td>";
            // Agrega un botón para responder con el atributo data-nombre-maestro
            echo '<td><button value="' . $row['nomMaes'] , $row['reporte'] . '" onclick="responder(this)">Responder</button></td>';
            // Agrega un botón para abrir pdf en la última columna
            echo '<td><button onclick="abrirPDF(' . $cont . ')">Abrir Pdf</button></td>';
            echo "</tr>";
            $cont++;
          }
        } else {
          echo "<tr><td colspan='7'>No se encontraron resultados</td></tr>";
        }

        $conn->close();
      } catch (Exception $e) {
        echo "<tr><td colspan='7'>Error: " . $e->getMessage() . "</td></tr>";
      }
      ?>
    </table>
  </main>

  <script>
    function abrirPDF(index) {
      var archivos = <?php echo json_encode($archivos); ?>;

      if (archivos.length > 0) {
        if (index >= 0 && index < archivos.length) {
          var archivoBase64 = archivos[index];
          if (archivoBase64) {
            try {
              var blob = base64toBlob(archivoBase64, 'application/pdf');
              var url = URL.createObjectURL(blob);
              window.open(url, '_blank');
            } catch (error) {
              alert('Error al crear el Blob: ' + error.message);
            }
          } else {
            alert('Archivo no encontrado');
          }
        } else {
          alert('Índice fuera de rango');
        }
      } else {
        alert('La lista de archivos está vacía');
      }
    }


    function responder(boton) {
      var nombreMaestro = boton.value;

      // Construye la URL con la variable
      var url = "contraReferencia/contraRef.php?miVariable=" + encodeURIComponent(nombreMaestro);

      // Redirige a la página del archivo PHP
      window.location.href = url;
    }











    function base64toBlob(base64, contentType) {
      contentType = contentType || '';
      var sliceSize = 1024;
      var byteCharacters = atob(base64);
      var byteArrays = [];

      for (var offset = 0; offset < byteCharacters.length; offset += sliceSize) {
        var slice = byteCharacters.slice(offset, offset + sliceSize);
        var byteNumbers = new Array(slice.length);

        for (var i = 0; i < slice.length; i++) {
          byteNumbers[i] = slice.charCodeAt(i);
        }

        var byteArray = new Uint8Array(byteNumbers);
        byteArrays.push(byteArray);
      }

      var blob = new Blob(byteArrays, {
        type: contentType
      });
      return blob;
    }
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
  </script>
</body>

</html>