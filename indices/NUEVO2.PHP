<?php
session_start();
$carrera = $_GET['carrera'] ?? "";
$carrera1_actual = $_GET['carrera1'] ?? '';
$semestre1_actual = $_GET['semestre1'] ?? '';
$unidad1_actual = $_GET['unidad1'] ?? '';
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" 
    integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" 
    crossorigin="anonymous" referrerpolicy="no-referrer" >
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/comunicacionDocenteAlumno.css">  
    <link rel="stylesheet" href="indices.css">
    <link rel="stylesheet" href="../css/normalize.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

  <title>Informe de Índices</title>

  <style>
    header {
      z-index: 1;
    }

    .back-arrow {
      position: absolute !important;
      margin: 90px 70px;
      background-color: #4F648B;
      padding: 10px;
      top: 15px;
      font-size: 16px;
    }

    .back-arrow:hover .regresar {
      display: block !important;
    }

    img {
      width: 50px;
      /* Puedes ajustar el valor según tus necesidades */
      height: auto;
      /* Para mantener la proporción de la imagen */
    }
  </style>

</head>

<body>
    <header class="fixed w-100">
        <a href="/Tabla_mostrar.php" class="back-arrow rounded-pill d-flex justify-content-start">
        <img src="../img/back.svg" alt="" height="50">
        <span class="regresar d-none text-white m-auto">Regresar</span>
        </a>
        <div class="usuarioOp d-flex justify-content-end">
        <img src="../img/profile.png" alt="">
        <?php
        $nombre = $_SESSION['nombre'];
        echo '<p>' . $nombre . '</p>';
        ?>
        <div class="dropdown-content">
            <a href="logout.php">Cerrar sesión</a>
        </div>
        </div>
    </header>
    <main>
        <div class="barraLateral fixed h-100">
            <a href="#"></a>
        </div>
    </main>
    <div class="container" style="margin-top: 10%;">
      <h2>Informe de Índices</h2>



      <?php
      $servername = "localhost";
      $username = "root";
      $password = "";
      $dbname = "tutorias_residencia";

      // Crear conexión
      $conn = new mysqli($servername, $username, $password, $dbname);

      // Verificar la conexión
      if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
      }

      // Obtener carreras desde la base de datos
      $carreras_query = "SELECT DISTINCT carrera FROM indices";
      $carreras_result = $conn->query($carreras_query);

      // Obtener semestres desde la base de datos
      $semestres_query = "SELECT DISTINCT semestre FROM indices";
      $semestres_result = $conn->query($semestres_query);

      // Obtener unidades desde la base de datos
      $unidades_query = "SELECT DISTINCT unidad FROM indices";
      $unidades_result = $conn->query($unidades_query);

      ?>

      <form id="filtro-form" action="NUEVO2.PHP" method="get">
        <div class="col-md-5">
          <label for="carrera1" class="form-label">Carrera:</label>
          <select class="form-select" name="carrera1" id="carrera1">
            <option value="">Todas las carreras</option>
            <?php
            $carreras_options = array();
            $carreras_result->data_seek(0); // Reinicia el puntero a la posición inicial
            while ($carrera_row = $carreras_result->fetch_assoc()) {
              $selected = ($carrera1_actual == $carrera_row['carrera']) ? 'selected' : '';
              $carreras_options[] = array('value' => $carrera_row['carrera'], 'selected' => $selected);
            }
            foreach ($carreras_options as $option) {
              echo '<option value="' . $option['value'] . '" ' . $option['selected'] . '>' . $option['value'] . '</option>';
            }
            ?>
          </select>


          <label for="semestre1" class="form-label">Semestre:</label>
          <select class="form-select" name="semestre1" id="semestre1">
            <option value="">Todos los semestres</option>
            <?php
            $semestres_options = array();
            $semestres_result->data_seek(0);
            while ($semestre_row = $semestres_result->fetch_assoc()) {
              $selected = ($semestre1_actual == $semestre_row['semestre']) ? 'selected' : '';
              $semestres_options[] = array('value' => $semestre_row['semestre'], 'selected' => $selected);
            }
            foreach ($semestres_options as $option) {
              echo '<option value="' . $option['value'] . '" ' . $option['selected'] . '>' . $option['value'] . '</option>';
            }
            ?>
          </select>

          <label for="unidad1" class="form-label">Unidad:</label>
          <select class="form-select" name="unidad1" id="unidad1">
            <option value="">Todas las unidades</option>
            <?php
            $unidades_options = array();
            $unidades_result->data_seek(0);
            while ($unidad_row = $unidades_result->fetch_assoc()) {
              $selected = ($unidad1_actual == $unidad_row['unidad']) ? 'selected' : '';
              $unidades_options[] = array('value' => $unidad_row['unidad'], 'selected' => $selected);
            }
            foreach ($unidades_options as $option) {
              echo '<option value="' . $option['value'] . '" ' . $option['selected'] . '>' . $option['value'] . '</option>';
            }
            ?>
          </select>
        </div>

        <button class="eliminar" onclick="filtrarDatos()">Filtrar</button>
      </form>
      <br><br>



      <?php
      // Configuración de la conexión a la base de datos
      $servername = "localhost";
      $username = "root";
      $password = "";
      $dbname = "tutorias_residencia";

      // Crear conexión
      $conn = new mysqli($servername, $username, $password, $dbname);

      // Verificar la conexión
      if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
      }

      // Obtener los parámetros de la URL
      // Obtener los parámetros de la URL
      $carrera1 = isset($_GET['carrera1']) ? htmlspecialchars($_GET['carrera1']) : null;
      $semestre1 = isset($_GET['semestre1']) ? htmlspecialchars($_GET['semestre1']) : null;
      $unidad1 = isset($_GET['unidad1']) ? htmlspecialchars($_GET['unidad1']) : null;

      // Consulta SQL para obtener los datos filtrados de manera segura
      $sql = "SELECT carrera, materia, semestre, unidad, alumnosA, alumnosR FROM indices 
                        WHERE carrera = ? AND semestre = ? AND unidad = ?";

      $stmt = $conn->prepare($sql);

      // Verificar si la preparación de la consulta fue exitosa
      if ($stmt) {
        // Asignar valores y tipos de datos
        $stmt->bind_param("sss", $carrera1, $semestre1, $unidad1);

        $stmt->execute();
        $result = $stmt->get_result();

        // Procesar los resultados y generar el HTML de las gráficas
        if ($result->num_rows > 0) {
          $chartData = array();

          while ($row = $result->fetch_assoc()) {
            // Ejemplo de variables con datos de la base de datos
            $carrera = $row["carrera"];
            $materia = $row["materia"];
            $semestre = $row["semestre"];
            $unidad = $row["unidad"];
            $alumnosA = $row["alumnosA"];
            $alumnosR = $row["alumnosR"];

            // Calcular porcentajes
            $porcentajeAlumnosA = ($alumnosA / ($alumnosA + $alumnosR)) * 100;
            $porcentajeAlumnosR = ($alumnosR / ($alumnosA + $alumnosR)) * 100;

            // Combinar gráficas si la carrera tiene el mismo nombre
            if (!isset($chartData[$carrera][$materia])) {
              $chartData[$carrera][$materia] = array(
                'labels' => array(),
                'data' => array(),
              );
            }

            $chartData[$carrera][$materia]['labels'][] = 'Unidad ' . $unidad;

            $chartData[$carrera][$materia]['data'][] = array(
              'Aprobados' => $alumnosA,
              'Reprobados' => $alumnosR,
              'PorcentajeAprobados' => $porcentajeAlumnosA,
              'PorcentajeReprobados' => $porcentajeAlumnosR
            );
          }

          // Generar HTML de las gráficas
          foreach ($chartData as $carrera => $materias) {
            echo '<h1>' . $carrera . '</h1>';
            foreach ($materias as $materia => $data) {
              echo '<div class="chart-container">';
              echo '<canvas class="bar-chart" data-carrera="' . $carrera . '" data-materia="' . $materia . '" data-semestre="' . $semestre . '" data-labels=\''
                . json_encode($data['labels']) . '\' data-data=\''
                . json_encode($data['data']) . '\'></canvas>';
              echo '<button class="btn btn-primary download-button" data-carrera="' . $carrera . '" data-materia="' . $materia . '" data-semestre="' . $semestre . '" onclick="downloadChart(this)">Descargar Gráfica</button>';
              echo '<br><br><br><br></div>';
              //echo '<script>filtrarDatos();</script>';
            }
          }
        } else {
          echo "No se encontraron datos para los filtros seleccionados.";
        }

        // Cerrar conexión

      } else {
        // Manejar el error de preparación de la consulta
        echo "Error en la preparación de la consulta.";
      }
      $stmt->close();

      $conn->close();

      ?>
    </div>
  </main>

  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://rawgit.com/eKoopmans/html2pdf/master/dist/html2pdf.bundle.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Llama a la función que deseas ejecutar automáticamente
      filtrarDatos();
    });

    function filtrarDatos() {
      // Obtener valores seleccionados
      var carrera = document.getElementById("carrera1").value;
      var semestre = document.getElementById("semestre1").value;
      var unidad = document.getElementById("unidad1").value;
      // Realizar petición AJAX para obtener datos filtrados desde el servidor
      var xhr = new XMLHttpRequest();
      xhr.onreadystatechange = function() {
        if (this.readyState == 4) {
          console.log(this.responseText);
          if (this.status == 200) {
            // Llama a la función para crear gráficas después de que la solicitud AJAX se ha completado

            var charts = document.getElementsByClassName('bar-chart');
            Array.from(charts).forEach(function(chart) {
              var ctx = chart.getContext('2d');
              var carreraChart = chart.getAttribute('data-carrera');
              var materia = chart.getAttribute('data-materia');
              var semestreChart = chart.getAttribute('data-semestre');
              var labels = JSON.parse(chart.getAttribute('data-labels'));
              var data = JSON.parse(chart.getAttribute('data-data'));

              new Chart(ctx, {
                type: 'bar',
                data: {
                  labels: labels,
                  datasets: [{
                    label: 'Alumnos Aprobados',
                    data: data.map(item => item['PorcentajeAprobados']),
                    backgroundColor: 'rgba(0, 128, 0, 0.7)',
                    borderWidth: 1
                  }, {
                    label: 'Alumnos Reprobados',
                    data: data.map(item => item['PorcentajeReprobados']),
                    backgroundColor: 'rgba(255, 0, 0, 0.7)',
                    borderWidth: 1
                  }]
                },
                options: {
                  scales: {
                    y: {
                      beginAtZero: true,
                      max: 100
                    }
                  },
                  plugins: {
                    title: {
                      display: true,
                      text: carreraChart + ' - Materia: ' + materia + ' - Semestre: ' + semestreChart
                    }
                  }
                }
              });
            });
          }
        }
      };
      console.log("Carrera: " + carrera + ", Semestre: " + semestre + ", Unidad: " + unidad);
      // Configurar y enviar la solicitud AJAX
      xhr.open("GET", "NUEVO2.PHP?carrera=" + carrera + "&semestre=" + semestre + "&unidad=" + unidad, true);
      xhr.send();
    }
    // Función para crear las gráficas

    // Función para descargar la gráfica específica como PDF
    window.downloadChart = function(button) {
      console.log('Descargando gráfica...');
      var carrera = button.getAttribute('data-carrera');
      var materia = button.getAttribute('data-materia');
      var semestre = button.getAttribute('data-semestre');
      var chartCanvas = document.querySelector('.bar-chart[data-carrera="' + carrera + '"][data-materia="' + materia + '"][data-semestre="' + semestre + '"]');

      // Esperar 500 milisegundos antes de convertir a PDF
      setTimeout(function() {
        // Utilizar html2pdf para generar el PDF
        var pdfOptions = {
          margin: 10,
          filename: carrera + '_' + materia + '_Semestre_' + semestre + '_Chart.pdf',
          image: {
            type: 'jpeg',
            quality: 0.98
          },
          html2canvas: {
            scale: 2
          },
          jsPDF: {
            unit: 'mm',
            format: 'a4',
            orientation: 'landscape'
          },
        };

        html2pdf().from(chartCanvas).set(pdfOptions).save();
      }, 500);
    };
  </script>


</body>

</html>