<?php
session_start();
$carrera = $_GET['carrera'] ?? "";
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://rawgit.com/eKoopmans/html2pdf/master/dist/html2pdf.bundle.js"></script>


  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="indices.css">

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

  <title>Informe de Índices</title>
</head>

<body>
  <header class="fixed w-100">
    <a href="/Tabla_mostrar.php" class="back-arrow rounded-pill d-flex justify-content-start">
      <img src="../img/back.svg" alt="" height="50">
      <span class="regresar d-none text-white m-auto">Regresar</span>
    </a>
    <div class="usuarioOp d-flex justify-content-end">
      <img src="profile.png" alt="">
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
    <div class="container" style="margin-top: 10%;">
      <h1>Informe de Índices</h1>
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

      // Consulta SQL para obtener los datos
      $sql = "SELECT carrera, materia, semestre, grupo, unidad, alumnosA, alumnosR FROM indices";

      $result = $conn->query($sql);

      // Comprobar si hay resultados y mostrar las gráficas por carrera y materia
      if ($result->num_rows > 0) {
        $chartData = array();

        while ($row = $result->fetch_assoc()) {
          // Ejemplo de variables con datos de la base de datos
          $carrera = $row["carrera"];
          $materia = $row["materia"];
          $semestre = $row["semestre"];
          $grupo = $row["grupo"];
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

        // Mostrar las gráficas
        foreach ($chartData as $carrera => $materias) {
          echo '<h2>' . $carrera . '</h2>';
          foreach ($materias as $materia => $data) {
            echo '<div class="chart-container">';
            echo '<canvas class="bar-chart" data-carrera="' . $carrera . '" data-materia="' . $materia . '" data-semestre="' . $semestre . '"data-grupo"' . $grupo . '" data-labels=\''
              . json_encode($data['labels']) . '\' data-data=\''
              . json_encode($data['data']) . '\'></canvas>';
            // Add download button for each chart
            echo '<button class="btn btn-primary download-button" data-carrera="' . $carrera . '" data-materia="' . $materia . '" data-semestre="' . $semestre . '"data-grupo"' . $grupo . '" onclick="downloadChart(this)">Descargar Gráfica</button>';
            echo '<br><br><br><br></div>';
          }
        }
      } else {
        echo "No se encontraron datos en la tabla 'indices'.";
      }

      // Cerrar conexión
      $conn->close();
      ?>


    </div>
  </main>

  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://rawgit.com/eKoopmans/html2pdf/master/dist/html2pdf.bundle.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.js"></script>

  <script>
    window.onload = function() {
      // Configuración de las gráficas de barras
      var charts = document.getElementsByClassName('bar-chart');

      Array.from(charts).forEach(function(chart) {
        var ctx = chart.getContext('2d');
        var carrera = chart.getAttribute('data-carrera');
        var materia = chart.getAttribute('data-materia');
        var semestre = chart.getAttribute('data-semestre');
        var grupo = chart.getAttribute('data-grupo');
        var labels = JSON.parse(chart.getAttribute('data-labels'));
        var data = JSON.parse(chart.getAttribute('data-data'));

        new Chart(ctx, {
          type: 'bar',
          data: {
            labels: labels,
            datasets: [{
              label: 'Alumnos Aprobados',
              data: data.map(item => item['PorcentajeAprobados']),
              backgroundColor: 'rgba(0, 128, 0, 0.7)', // Verde con opacidad
              borderWidth: 1
            }, {
              label: 'Alumnos Reprobados',
              data: data.map(item => item['PorcentajeReprobados']),
              backgroundColor: 'rgba(255, 0, 0, 0.7)', // Rojo con opacidad
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
                text: carrera + ' - Materia: ' + materia + ' - Semestre: ' + semestre + '- Grupo:' + grupo
              }
            }
          }
        });
      });

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
    };
  </script>



</body>

</html>