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
        <p>Usuario</p>
        <a href="#">Cerrar sesión</a>
      </div>
    </header
        <a href="#"></a>
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
            </tr>
          
        <?php
        // Conecta a la base de datos (reemplaza con tus credenciales)


        require 'php/db.php';

    $conn=conectar();

        // Consulta SQL para enumerar las filas
        $sl = "SELECT reporte, nocontrol, nomAlu, nomMaes, motivo FROM tablavispsico";
        $rep = $conn->query($sl);

        if ($rep->num_rows > 0) {
            // Imprime los datos en la tabla
            while ($row = $rep->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["reporte"] . "</td>";
                echo "<td>" . $row["nocontrol"] . "</td>";
                echo "<td>" . $row["nomAlu"] . "</td>";
                echo "<td>" . $row["nomMaes"] . "</td>";
                echo "<td>" . $row["motivo"] . "</td>";
                // Agrega un botón para responder en la última columna
                echo '<td><button>Responder</button></td>';
                echo "</tr>";
            }
        }

        else {
          echo "No se encontraron resultados";
        }

        $conn->close();
        ?>

    </table>
  </main>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
    crossorigin="anonymous">
</script>
</body>
</html>