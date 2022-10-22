
<?php

include_once "Conexion.php";

class Car extends Conexion{

    // atributos. abstraction
    public $id;
    public $nombre;
    public $modelo;
    public $marca;
    public $pais;
    public $fechaCreate; 
    public $fechaUpdate;

    
    // CRUD

    // Create 
    public function create(){
        $this->conectar();
        $pre = mysqli_prepare($this->con, "INSERT INTO CAR (id, nombre, modelo, marca, pais, fechaCreate, fechaUpdate) VALUES(?,?,?,?,?,?,?)");
        $pre->bind_param("issssss", $this->id, $this->nombre, $this->modelo, $this->marca, $this->pais, $this->fechaCreate, $this->fechaUpdate);
        $pre->execute();
    }



    // Read   
    public static function all() {
        $conexion = new Conexion();
        $conexion->conectar();
        $pre = mysqli_prepare($conexion->con, "SELECT * FROM CAR");
        $pre->execute();
        $result = $pre->get_result();

        $cars = [];
        // llenar el cars
        while ($car = $result->fetch_object(Car::class)){
            array_push($cars, $car);
        }
        return $cars;
    }

    // Update
    public function update(){
        $this->conectar();
        $pre = mysqli_prepare($this->con, "UPDATE CAR SET pais=? WHERE id=?");
        $pre->bind_param("si", $this->pais, $this->id);
        $pre->execute();
    }

    // Delite
    public function delete(){
        $this->conectar();
        $pre = mysqli_prepare($this->con, "DELETE FROM CAR WHERE id=?");
        $pre->bind_param("i", $this->id);
        $pre->execute();
    }


    public static function getCarById($id){
        // instancia conexion explicitamente

        $conexion = new Conexion();
        $conexion->conectar();
        $pre = mysqli_prepare($conexion->con, "SELECT * FROM CAR WHERE id = ?");
        $pre->bind_param("i", $id);
        $pre->execute();
        $result = $pre->get_result(); // se obtiene el resultado

        return $result->fetch_object(Car::class); // se retorna el objeto
    }
}