<?php

include_once "Car.php";

// crear un nuevo Car

// establecer fecha 
date_default_timezone_set('america/bogota');

$car = new Car();
$car->id = null;
$car->nombre = "118i F20 Sport Line";
$car->marca = "BMW";
$car->modelo = "5P MT";
$car->pais = "Alemania";
$car->fechaCreate = date("Y-m-d");
$car->fechaUpdate = date("Y-m-d");
$car->create();

echo (date("Y-m-d"));
?>