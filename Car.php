
<?php

include_once "Conexion.php";

class Car extends Conexion{

    // atributos
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
    // Update
    // Delite
}