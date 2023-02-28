<?php 

function conectarDB() : mysqli
{
    $db = mysqli_connect('localhost', 'root','','ejercicio1');

    if(!$db){
    echo "Error";
    exit;
    }

    return $db;
}