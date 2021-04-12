<?php
require_once 'Conexion.php';
class Compras{
    public $objetos;
    public function __construct(){
        $db = new Conexion();
        $this->acceso=$db->pdo;
    }

    function crear($codigo,$fecha_compra,$fecha_entrega,$total,$id_estado,$id_proveedor,$estado_p){
        $sql = "INSERT INTO compra(codigo, fecha_compra, fecha_entrega, total, id_estado_pago, id_proveedor,estado_pedido) VALUES(:codigo, :fecha_compra, :fecha_entrega, :total, :id_estado_pago, :id_proveedor,:estado_pedido) ";
        $query = $this->acceso->prepare($sql);
        $query -> execute(array(':codigo'=>$codigo,':fecha_compra'=>$fecha_compra,':fecha_entrega'=>$fecha_entrega,':total'=>$total,':id_estado_pago'=>$id_estado,':id_proveedor'=>$id_proveedor,':estado_pedido'=>$estado_p));    
    }
    
    function ultima_compra(){
        $sql = "SELECT MAX(id) as ultima_compra FROM compra";/*Dela tabla venta estamos recorriendo todo los registro y vamos a elegir el id máximo el último ID que se a creado y le estamos dando un alias de última venta */
        $query = $this->acceso->prepare($sql);
        $query->execute();
        $this->objetos= $query->fetchall();
        return $this->objetos;
    }
    
    function listar_compras(){
        $sql = "SELECT CONCAT(c.id,' | ',c.codigo) as codigo, c.estado_pedido as estado_pedido, fecha_compra,fecha_entrega,total,e.nombre as estado, p.nombre as proveedor FROM compra AS c
        JOIN estado_pago AS e on e.id= id_estado_pago
        JOIN proveedor AS p on p.id_proveedor = c.id_proveedor";
        $query = $this->acceso->prepare($sql);
        $query->execute();
        $this->objetos= $query->fetchall();
        return $this->objetos;
    }
    
    function editar_estado($id_compra,$id_estado){
        $sql="UPDATE compra SET id_estado_pago=:estado WHERE id=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id_compra,':estado'=>$id_estado));
    }
    
    function cambiar_Estado_compra($id,$id_estado){
        $sql="UPDATE compra SET estado_pedido=:estado WHERE id=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id,':estado'=>$id_estado));
    }
    function obtenerDatos($id_compra){
        $sql = "SELECT CONCAT(c.id,' | ',c.codigo) as codigo, fecha_compra,fecha_entrega,total,e.nombre as estado, p.nombre as proveedor,telefono,correo,direccion,p.avatar AS avatar FROM compra AS c
        JOIN estado_pago AS e on e.id= id_estado_pago AND C.id=:id
        JOIN proveedor AS p on p.id_proveedor = c.id_proveedor";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id_compra));      //AQUE ME QUEDE
        $this->objetos= $query->fetchall();
        return $this->objetos;
    }
    
    /*============================
    NOTIFICACIONES
    =============================*/
    function mostrar_ntf(){
        $sql = "SELECT * FROM compra WHERE estado_pedido = 'PE'";
        $query = $this->acceso->prepare($sql);
        $query->execute();      //AQUE ME QUEDE
        $this->objetos= $query->fetchall();
        return $this->objetos;
    }
}