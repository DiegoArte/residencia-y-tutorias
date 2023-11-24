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

    <form id="filtro-form">
      <label for="carrera1">Carrera:</label>
      <select name="carrera1" id="carrera1">
        <option value="">Todas las carreras</option>
        <?php
          while ($carrera_row = $carreras_result->fetch_assoc()) {
            echo '<option value="' . $carrera_row['carrera'] . '">' . $carrera_row['carrera'] . '</option>';
          }
        ?>
      </select>

      <label for="semestre1">Semestre:</label>
      <select name="semestre1" id="semestre1">
        <option value="">Todos los semestres</option>
        <?php
          while ($semestre_row = $semestres_result->fetch_assoc()) {
            echo '<option value="' . $semestre_row['semestre'] . '">' . $semestre_row['semestre'] . '</option>';
          }
        ?>
      </select>

      <label for="unidad1">Unidad:</label>
      <select name="unidad1" id="unidad1">
        <option value="">Todas las unidades</option>
        <?php
          while ($unidad_row = $unidades_result->fetch_assoc()) {
            echo '<option value="' . $unidad_row['unidad'] . '">' . $unidad_row['unidad'] . '</option>';
          }
        ?>
      </select>

      <button type="button" onclick="filtrarDatos()">Filtrar</button>
    </form>



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
        $carrera1 = isset($_GET['carrera1']) ? $_GET['carrera1'] : null;
        $semestre1 = isset($_GET['semestre1']) ? $_GET['semestre1'] : null;
        $unidad1 = isset($_GET['unidad1']) ? $_GET['unidad1'] : null;

        // Consulta SQL para obtener los datos filtrados
        $sql = "SELECT carrera, materia, semestre, unidad, alumnosA, alumnosR FROM indices 
                WHERE carrera = '$carrera1' AND semestre = '$semestre1' AND unidad = '$unidad1'";
        var_dump($carrera1, $semestre1, $unidad1);

        $stmt = $conn->prepare($sql);

        // Verificar si la preparación de la consulta fue exitosa
        if ($stmt) {
            // Asignar valores y tipos de datos
            $stmt->bind_param("sdd", $carrera1, $semestre1, $unidad1);

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
                    echo '<h2>' . $carrera . '</h2>';
                    foreach ($materias as $materia => $data) {
                        echo '<div class="chart-container">';
                        echo '<canvas class="bar-chart" data-carrera="' . $carrera . '" data-materia="' . $materia . '" data-semestre="' . $semestre . '" data-labels=\''
                            . json_encode($data['labels']) . '\' data-data=\''
                            . json_encode($data['data']) . '\'></canvas>';
                        echo '</div>';
                    }
                }
            } else {
                echo "No se encontraron datos para los filtros seleccionados.";
            }

            // Cerrar conexión
            $stmt->close();
        } else {
            // Manejar el error de preparación de la consulta
            echo "Error en la preparación de la consulta.";
        }

        $conn->close();
    ?>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        function filtrarDatos() {
            // Obtener valores seleccionados
            var carrera = document.getElementById("carrera").value;
            var semestre = document.getElementById("semestre").value;
            var unidad = document.getElementById("unidad").value;

            // Realizar petición AJAX para obtener datos filtrados desde el servidor
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    // Actualizar el contenido de #graficas con las nuevas gráficas
                    document.getElementById("graficas").innerHTML = this.responseText;

                    // Configuración de las nuevas gráficas
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
                                        text: carrera + ' - Materia: ' + materia + ' - Semestre: ' + semestre
                                    }
                                }
                            }
                        });
                    });
                }
            };
            console.log("Carrera: " + carrera + ", Semestre: " + semestre + ", Unidad: " + unidad);

            xhr.open("GET", "datos_filtrados.php?carrera=" + carrera + "&semestre=" + semestre + "&unidad=" + unidad, true);
            xhr.send();
        }
    </script>
    <a href="Tabla_mostrar.php">Regresar</a>
</body>
</html>
