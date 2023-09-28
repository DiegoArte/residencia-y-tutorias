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
      </div>
          <table>
            <tr>
              <th>Reporte</th>
              <th>numero de control</th>
              <th>Nombre Alumno</th>
              <th>Nombre del maestro que envia</th>
              <th>motivo</th>
              <th>responder</th>
            </tr>
          </table>
        <?php
        // Conecta a la base de datos (reemplaza con tus credenciales)
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "protutres";


        $conn = new mysqli($servername, $username, $password, $dbname);

        // Verifica la conexión
        if ($conn->connect_error) {
          die("Error de conexión: " . $conn->connect_error);
        }

        // Consulta SQL para obtener los datos
        $sql = "SELECT reporte, nocontrol, nomAlu, nomMaes, motivo FROM tablavispsico";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
          // Imprime los datos en la tabla
          while ($row = $result->fetch_assoc()) {
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
        } else {
          echo "No se encontraron resultados";
        }

        $conn->close();
        ?>
  </main>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
    crossorigin="anonymous">
</script>
</body>
</html>