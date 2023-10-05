<?php

function conectar() :mysqli {
    $db=new mysqli('localhost', 'root', '', 'tutorias_residencia');

    if(!$db){
        echo 'No se conecto';
        exit;
    }

    return $db;
}