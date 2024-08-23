<?php 

function connectDB() : mysqli
{
    $db = mysqli_connect('localhost', 'root','','blog_notas');

    if(!$db){
    echo "Error";
    exit;
    }

    return $db;
}