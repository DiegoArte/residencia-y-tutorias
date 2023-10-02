<?php

require 'db.php';
require 'Crud.php';

$db=conectar();
Crud::setDB($db);

?>