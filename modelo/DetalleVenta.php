<?php
include_once 'Conexion.php';
class DetalleVenta{
    var $objetos;
    public function __construct(){
        $db = new Conexion(); 
        $this->acceso = $db->pdo;
    }
    /*===========================
    RECUPERAR DETALLE VENTA
    =============================*/
    function recuperar($id_venta){
        $sql = 'SELECT * FROM detalle_venta WHERE id_det_venta=:id_venta';
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id_venta'=>$id_venta));
        $this->objetos=$query->fetchAll();
        return $this->objetos;
    }
    /*===========================
    BORRAR DETALLE VENTA
    =============================*/
    function borrar($id_detalle){
        $sql = 'DELETE FROM detalle_venta WHERE id_detalle=:id_detalle';
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id_detalle'=>$id_detalle));
    }
    
}