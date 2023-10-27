<?php

function conectarBaseDeDatos() {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "tutorias_residencia";

    // Crea una conexión
    $conn = new mysqli($servername, $username, $password, $database);
    
    // Verifica la conexión
    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    return $conn;
}

function actualizarTabla($conn, $tabla, $id, $campos) {
    $actualizacion = [];
    foreach ($campos as $campo => $valor) {
        $actualizacion[] = "$campo = '$valor'";
    }
    $setClause = implode(', ', $actualizacion);

    $sql = "UPDATE $tabla SET $setClause WHERE id = $id";

    if ($conn->query($sql) === true) {
        //return "Datos actualizados exitosamente.";
    } else {
        return "Error: " . $sql . "<br>" . $conn->error;
    }
}

function agregarRegistro($conn, $tabla, $campos) {
    $columnas = [];
    $valores = [];

    foreach ($campos as $campo => $valor) {
        $columnas[] = $campo;
        $valores[] = "'$valor'";
    }

    $columnas = implode(', ', $columnas);
    $valores = implode(', ', $valores);

    $sql = "INSERT INTO $tabla ($columnas) VALUES ($valores)";

    if ($conn->query($sql) === true) {
        return "Registro agregado exitosamente.";
    } else {
        return "Error: " . $sql . "<br>" . $conn->error;
    }
}
