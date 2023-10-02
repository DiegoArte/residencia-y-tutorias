<?php

function conectar() :mysqli {
    $db=new mysqli('localhost', 'root', 'changeme', 'pruebas_residenciaytuto');

    if(!$db){
        echo 'No se conecto';
        exit;
    }

    return $db;
}