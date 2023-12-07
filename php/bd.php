<?php
require __DIR__.'/vendor/autoload.php'; // Si estás utilizando Composer

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

try{
  $servidor = $_ENV['SERVER'];
  $baseDeDatos = $_ENV['BD'];
  $usuario = $_ENV['USER'];
  $password = $_ENV['PASS'];

  $conexion = new PDO("mysql:host=$servidor;dbname=$baseDeDatos",$usuario,$password);
  // echo "Conexion exitosa";
}catch(Exception $error){
  // header('Location: ../404.php');
  print_r($error);
}
?>