<?php
function conecta()
{
    global $conexion;
    
    $conexion= mysqli_connect("localhost","root","");
        if(!$conexion)
        {
            echo "No se puede establecer una conexion";
        }
        else
        {
            echo "Conexion Existosa Registro completado!!! ";
        }
}
