<?php
require 'Conexion.php';
class Estado{
    public $objetos;
    public function __construct(){
        $db = new Conexion();
        $this->acceso = $db->pdo;
    }
    /*===========================
    RELLENAR PRODUCTO 
    =============================*/
    function rellenar_estado_pago(){
        $sql = "SELECT * FROM estado_pago";
        $query=$this->acceso->prepare($sql);
        $query->execute();
        $this->objetos=$query->fetchAll();
        return $this->objetos;
    }
    /*===========================
    RELLENAR PRODUCTO 
    =============================*/
    function obtenerId_estado($nombre){
        $sql = "SELECT id FROM estado_pago WHERE nombre=:nombre";
        $query=$this->acceso->prepare($sql);
        $query->execute(array(':nombre'=>$nombre));
        $this->objetos=$query->fetchAll();
        return $this->objetos;
    }
}