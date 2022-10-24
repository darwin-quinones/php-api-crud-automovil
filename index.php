<?php

include_once "Car.php";

// header- permiter recivir y enviar informacion 

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET,POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// establecer fecha 
date_default_timezone_set('america/bogota');

if (isset($_GET['consultar'])){
    $idCard = $_GET['consultar'];
    getCarById($idCard);

}else if(isset($_GET["borrar"])){
    $idCard = $_GET["borrar"];
    deleteCar($idCard);

}else if(isset($_GET["insertar"])){
    $data = json_decode(file_get_contents("php://input"));
    createCar($data);

}else if(isset($_GET["actualizar"])){
    $data = json_decode(file_get_contents("php://input"));
    updateCar($data);
}


function getCarById($idCard){
    $car = Car::getCarById($idCard);

    // si es diferencte a 1 trae datos
    if(is_null($car) != 1){
        $car = json_encode($car);
        echo $car;
        exit();
    }else{  echo json_encode(["No data found"=>0]); }

}

function deleteCar($idCard){
    $car = Car::getCarById($idCard);
    if(is_null($car) != 1){
        $car->delete();
        exit();
    }else{  echo json_encode(["No data found"=>0]); }
    
}

// crear un nuevo Car
function createCar($data){
   

    $car = new Car();

    $car->id = null;
    $car->nombre = $data->nombre;
    $car->marca = $data->marca;
    $car->modelo = $data->modelo;
    $car->pais = $data->pais;
    $car->fechaCreate = date("Y-m-d");
    $car->fechaUpdate = date("Y-m-d");
    $car->create();
    echo json_encode(["success"=>1]);
    exit();
}

// actualizar car
function updateCar($data){
    $idCar = $data->id;

    $car = Car::getCarById($idCar);

    $car->nombre = $data->nombre;
    $car->marca = $data->marca;
    $car->modelo = $data->modelo;
    $car->pais = $data->pais;
    $car->fechaUpdate = date("Y-m-d");
    $car->update();

}

$cars = Car::all();
if(is_null($cars) != 1){
    echo json_encode($cars);
    exit();
}else{  echo json_encode(["No data found"=>0]); }





// $car = new Car();
// $car->id = null;
// $car->nombre = "118i F20 Sport Line";
// $car->marca = "BMW";
// $car->modelo = "5P MT";
// $car->pais = "Alemania";
// $car->fechaCreate = date("Y-m-d");
// $car->fechaUpdate = date("Y-m-d");
// $car->create();
// echo (date("Y-m-d"));


// UPDATE
// $car = Car::getCarById(7);
// var_dump($car);

// $car->pais = "Colombia";
// $car->update();

// DELETE
// $car = Car::getCarById(8);
// $car->delete();

//READ

// $cars = Car::all();
// var_dump($cars);

?>