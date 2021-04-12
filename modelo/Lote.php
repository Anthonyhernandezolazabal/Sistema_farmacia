<?php
require_once 'Conexion.php';
class Lote{
    public $objetos;
    public function __construct(){
        $db = new Conexion();
        $this->acceso=$db->pdo;
    }
    /*===========================
    REGISTRAR LOTE 
    =============================*/
    function crear($id_producto,$proveedor,$stock,$vencimiento){
        $sql="INSERT INTO lote(stock, vencimiento, lote_id_prod, lote_id_prov) VALUES (:stock, :vencimiento, :lote_id_prod, :lote_id_prov)";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':stock'=>$stock,':vencimiento'=>$vencimiento,':lote_id_prod'=>$id_producto,':lote_id_prov'=>$proveedor));
        echo 'add';
    }
    /*===========================
    BUSCAR LOTE 
    =============================*/
    function buscar(){
        if (!empty($_POST["consulta"])) {
            $consulta = $_POST["consulta"];
            $sql = "SELECT l.id AS id_lote,CONCAT(l.id,' | ',l.codigo) AS codigo,cantidad_lote,vencimiento,concentracion,adicional, producto.nombre as prod_nom, laboratorio.nombre as lab_nom, tipo_producto.nombre as tip_nom, presentacion.nombre as pres_nom, proveedor.nombre as proveedor, producto.avatar as logo
            FROM lote AS l
            JOIN compra on l.id_compra=compra.id AND l.estado='A' AND compra.estado_pedido='E'
            JOIN proveedor ON proveedor.id_proveedor=compra.id_proveedor
            JOIN producto ON producto.id_producto=l.id_producto
            JOIN laboratorio ON prod_lab=id_laboratorio
            JOIN tipo_producto ON prod_tip_prod=id_tip_prod
            JOIN presentacion ON prod_present=id_presentacion AND producto.nombre LIKE :nombre ORDER BY producto.nombre LIMIT 25";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':nombre' =>"%$consulta%"));
            $this->objetos=$query->fetchAll();
            return $this->objetos;
        }else{
            $sql="SELECT l.id AS id_lote,CONCAT(l.id,' | ',l.codigo) AS codigo,cantidad_lote,vencimiento,concentracion,adicional, producto.nombre as prod_nom, laboratorio.nombre as lab_nom, tipo_producto.nombre as tip_nom, presentacion.nombre as pres_nom, proveedor.nombre as proveedor, producto.avatar as logo
            FROM lote AS l
            JOIN compra on l.id_compra=compra.id AND l.estado='A' AND compra.estado_pedido='E'
            JOIN proveedor ON proveedor.id_proveedor=compra.id_proveedor
            JOIN producto ON producto.id_producto=l.id_producto
            JOIN laboratorio ON prod_lab=id_laboratorio
            JOIN tipo_producto ON prod_tip_prod=id_tip_prod
            JOIN presentacion ON prod_present=id_presentacion AND producto.nombre NOT LIKE '' ORDER BY producto.nombre LIMIT 25";
            $query = $this->acceso->prepare($sql);
            $query->execute();
            $this->objetos=$query->fetchAll();
            return $this->objetos;
        }
    }
    /*===========================
    EDITAR LOTE 
    =============================*/
    function editar($id,$stock){
        $sql = "UPDATE lote SET cantidad_lote=:stock WHERE id=:id";
        $query=$this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id,':stock'=>$stock));
        echo 'edit';
    }
    /*===========================
    DEVOLVER LOTE 
    =============================*/
     # CON ELIMINACION FISICA
    // function devolver($id_lote,$cantidad,$vencimiento,$producto,$proveedor){
    //     // Verificamos si ya existe un id lote para que solo entre a sumar
    //     $sql="SELECT * FROM lote WHERE id_lote =:id_lote";
    //     $query = $this->acceso->prepare($sql);
    //     $query->execute(array(":id_lote"=>$id_lote));
    //     $lote=$query->fetchAll();
    //     if (!empty($lote)) {
    //         $sql = "UPDATE lote SET stock=stock+:cantidad WHERE id_lote=:id_lote";
    //         $query=$this->acceso->prepare($sql);
    //         $query->execute(array(':cantidad'=>$cantidad,':id_lote'=>$id_lote));
    //     }else{
    //         $sql="SELECT * FROM lote WHERE vencimiento =:vencimiento AND lote_id_prod=:producto AND lote_id_prov=:proveedor";
    //         $query = $this->acceso->prepare($sql);
    //         $query->execute(array(":vencimiento"=>$vencimiento,":producto"=>$producto,":proveedor"=>$proveedor));
    //         $lote_nuevo=$query->fetchAll();
    //         foreach ($lote_nuevo as $objeto) {
    //             $id_lote_nuevo = $objeto->id_lote;
    //         }
    //         // VERIFICAMOS SI HAY UN LOTE PARECIDO
    //         if (!empty($lote_nuevo)) {
    //             $sql = "UPDATE lote SET stock=stock+:cantidad WHERE id_lote=:id_lote";
    //             $query=$this->acceso->prepare($sql);
    //             $query->execute(array(':cantidad'=>$cantidad,':id_lote'=>$id_lote_nuevo));
    //         }else{
    //             $sql = "INSERT INTO lote(id_lote,stock,vencimiento,lote_id_prod,lote_id_prov) VALUES(:id_lote,:stock,:vencimiento,:producto,:proveedor)";
    //             $query=$this->acceso->prepare($sql);
    //             $query->execute(array(':id_lote'=>$id_lote,':stock'=>$cantidad,':vencimiento'=>$vencimiento,':producto'=>$producto,':proveedor'=>$proveedor));
    //          }
    //     }
    // }
     # CON ELIMINACION LÓGICA
    function devolver($id_lote,$cantidad,$vencimiento,$producto,$proveedor){
        // Verificamos si ya existe un id lote para que solo entre a sumar
        $sql="SELECT * FROM lote WHERE id =:id_lote";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(":id_lote"=>$id_lote));
        $lote=$query->fetchAll();

        $sql = "UPDATE lote SET cantidad_lote=cantidad_lote+:cantidad,estado='A' WHERE id=:id_lote";
        $query=$this->acceso->prepare($sql);
        $query->execute(array(':cantidad'=>$cantidad,':id_lote'=>$id_lote));
    }
    ////////////////////////////////////ACTUALIZACION/////////////////////////////////////
    /*===========================
    REGISTRAR LOTE 
    =============================*/
    function crear_lote($codigo,$cantidad,$vencimiento,$precio_compra,$id_compra,$id_producto){
        $sql="INSERT INTO lote(codigo, cantidad, cantidad_lote, vencimiento, precio_compra, id_compra, id_producto) VALUES (:codigo, :cantidad, :cantidad_lote, :vencimiento, :precio_compra, :id_compra, :id_producto)";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':codigo'=>$codigo,':cantidad'=>$cantidad,':cantidad_lote'=>$cantidad,':vencimiento'=>$vencimiento,':precio_compra'=>$precio_compra,':id_compra'=>$id_compra,':id_producto'=>$id_producto));
    }
    /*===========================
    VER LOTE 
    =============================*/
    function ver_cmp($id){
        $sql="SELECT l.codigo as codigo, l.cantidad as cantidad, vencimiento, precio_compra, p.nombre as producto, concentracion,adicional, la.nombre as laboratorio, t.nombre as tipo, pre.nombre as presentacion
        FROM lote AS l
        JOIN producto AS p ON l.id_producto=p.id_producto AND id_compra =:id
        JOIN laboratorio AS la ON prod_lab=id_laboratorio
        JOIN tipo_producto as t ON prod_tip_prod=id_tip_prod
        JOIN presentacion as pre ON prod_present=id_presentacion";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id));
        $this->objetos=$query->fetchAll();
        return $this->objetos;
    }
    /*===========================
    ELIMINAR LOTE 
    =============================*/
    function eliminar($id){
        $sql = "UPDATE lote SET estado='I' WHERE id=:id";
        $query=$this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id));
        if (!empty($query->execute(array(":id"=>$id)))) {
            echo 'borrado';
        }else{
            echo 'noborrado';
        }
    }
}