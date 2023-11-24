<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Informe de Índices</title>
  <style>
    body {
      font-family: Arial, sans-serif;
    }
    .chart-container {
      width: 80%;
      margin: auto;
    }
  </style>
</head>
<body>
  <h1>Informe de Índices</h1>

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
    $sql = "SELECT carrera, materia, semestre, unidad, alumnosA, alumnosR FROM indices";

    $result = $conn->query($sql);

    // Comprobar si hay resultados y mostrar las gráficas por carrera y materia
    if ($result->num_rows > 0) {
      $chartData = array();

      while ($row = $result->fetch_assoc()) {
        // Ejemplo de variables con datos de la base de datos
        $carrera = $row["carrera"];
        $materia = $row["materia"];
        $semestre= $row["semestre"];
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
          echo '<canvas class="bar-chart" data-carrera="' . $carrera . '" data-materia="' . $materia . '" data-semestre="' . $semestre .'" data-labels=\''
            . json_encode($data['labels']) . '\' data-data=\''
            . json_encode($data['data']) . '\'></canvas>';
          echo '</div>';
        }
      }
    } else {
      echo "No se encontraron datos en la tabla 'indices'.";
    }

    // Cerrar conexión
    $conn->close();
  ?>

  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
    // Configuración de las gráficas de barras
    var charts = document.getElementsByClassName('bar-chart');

    Array.from(charts).forEach(function(chart) {
      var ctx = chart.getContext('2d');
      var carrera = chart.getAttribute('data-carrera');
      var materia = chart.getAttribute('data-materia');
      var semestre= chart.getAttribute('data-semestre');
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
              text:  carrera + ' - Materia: ' + materia + ' - Semestre: ' + semestre
            }
          }
        }
      });
    });
  </script>
  <a href="Tabla_mostrar.php">Regresar</a>
</body>
</html>
