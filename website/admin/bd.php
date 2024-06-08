<?php
$servidor="localhost";
$baseDeDatos="website";
$usuario="root";
$contraseña="1020";

try{
    $conexion=new PDO("mysql:host=$servidor;dbname=$baseDeDatos",$usuario,$contraseña);
        echo " ";
}catch(Exception $error){
    echo $error->getMessage();
}
?>