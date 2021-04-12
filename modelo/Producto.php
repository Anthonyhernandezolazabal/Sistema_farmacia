<?php
require_once 'Conexion.php';
class Producto{
    public $objetos;
    public function __construct(){
        $db = new Conexion();
        $this->acceso = $db->pdo;
    }
    /*===========================
    REGISTRAR PRODUCTO 
    =============================*/
    function crear($nombre,$concentracion,$adicional,$precio,$laboratorio,$tipo,$presentacion,$avatar){
        $sql = "SELECT id_producto,estado  FROM producto WHERE nombre=:nombre AND concentracion=:concentracion AND adicional=:adicional AND prod_lab=:lab AND prod_tip_prod=:tip AND prod_present=:pres";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':nombre'=>$nombre,':concentracion'=>$concentracion,':adicional'=>$adicional,':lab'=>$laboratorio,':tip'=>$tipo,':pres'=>$presentacion));
        $this->objetos =$query->fetchAll();
        if (!empty($this->objetos)) {

            foreach ($this->objetos as $prod) {
                $prod_id_producto = $prod->id_producto;
                $prod_estado = $prod->estado;
            }

            if ($prod_estado == 'A') {

                echo 'noadd';

            }else{

                $sql="UPDATE producto SET estado='A' WHERE id_producto=:id";
                $query = $this->acceso->prepare($sql);
                $query->execute(array(':id'=>$prod_id_producto));
                echo 'add';
            }

        }else{

            $sql="INSERT INTO producto(nombre,concentracion,adicional,precio,avatar,prod_lab,prod_tip_prod,prod_present) VALUES (:nombre,:concentracion,:adicional,:precio,:avatar,:prod_lab,:prod_tip_prod,:prod_present)";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':nombre'=>$nombre,':concentracion'=>$concentracion,':adicional'=>$adicional,':precio'=>$precio,':avatar'=>$avatar,':prod_lab'=>$laboratorio,':prod_tip_prod'=>$tipo,':prod_present'=>$presentacion));
            echo 'add';
            
        }
    }
    /*===========================
    EDITAR PRODUCTO 
    =============================*/
    function editar($id,$nombre,$concentracion,$adicional,$precio,$laboratorio,$tipo,$presentacion){
        $sql = "SELECT id_producto FROM producto WHERE id_producto!=:id AND nombre=:nombre AND concentracion=:concentracion AND adicional=:adicional AND prod_lab=:lab AND prod_tip_prod=:tip AND prod_present=:pres";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id,':nombre'=>$nombre,':concentracion'=>$concentracion,':adicional'=>$adicional,':lab'=>$laboratorio,':tip'=>$tipo,':pres'=>$presentacion));
        $this->objetos =$query->fetchAll();
        if (!empty($this->objetos)) {
            echo 'noedit';
        }else{
            $sql="UPDATE producto set nombre=:nombre,concentracion=:concentracion,adicional=:adicional,precio=:precio,prod_lab=:prod_lab,prod_tip_prod=:prod_tip_prod,prod_present=:prod_present WHERE id_producto=:id";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':nombre'=>$nombre,':concentracion'=>$concentracion,':adicional'=>$adicional,':precio'=>$precio,':prod_lab'=>$laboratorio,':prod_tip_prod'=>$tipo,':prod_present'=>$presentacion,':id'=>$id));
            echo 'edit';
        }
    }
    /*===========================
    BUSCAR PRODUCTO 
    =============================*/
    function buscar(){
        if (!empty($_POST["consulta"])) {
            // $consulta = $_POST["consulta"];
            // $sql= "SELECT producto.id_producto as id_producto, compra.estado_pedido as estado_pedido, producto.nombre as nombre, concentracion, adicional,precio,laboratorio.nombre as laboratorio,tipo_producto.nombre as tipo, presentacion.nombre as presentacion,producto.avatar as avatar, prod_lab, prod_tip_prod,prod_present FROM producto
            // JOIN lote ON lote.id_producto = producto.id_producto
            // JOIN compra ON lote.id_compra = compra.id
            // JOIN laboratorio ON prod_lab=id_laboratorio AND producto.estado='A'
            // JOIN tipo_producto ON prod_tip_prod=id_tip_prod
            // JOIN presentacion ON prod_present=id_presentacion WHERE producto.estado='A' AND producto.nombre LIKE :consulta ORDER BY producto.nombre DESC LIMIT 6";
            // $query= $this->acceso->prepare($sql);
            // $query->execute(array(":consulta"=>"%$consulta%"));
            // $this->objetos=$query->fetchAll();
            // return $this->objetos;
            $consulta = $_POST["consulta"];
            $sql= "SELECT id_producto, producto.nombre as nombre, concentracion, adicional,precio,laboratorio.nombre as laboratorio,tipo_producto.nombre as tipo, presentacion.nombre as presentacion,producto.avatar as avatar, prod_lab, prod_tip_prod,prod_present FROM producto
            JOIN laboratorio ON prod_lab=id_laboratorio AND producto.estado='A'
            JOIN tipo_producto ON prod_tip_prod=id_tip_prod
            JOIN presentacion ON prod_present=id_presentacion WHERE producto.estado='A' and producto.nombre LIKE :consulta ORDER BY producto.nombre DESC LIMIT 25";
            $query= $this->acceso->prepare($sql);
            $query->execute(array(":consulta"=>"%$consulta%"));
            $this->objetos=$query->fetchAll();
            return $this->objetos;
            
        }else{
            // $sql= "SELECT producto.id_producto as id_producto, compra.estado_pedido as estado_pedido, producto.nombre as nombre, concentracion, adicional,precio,laboratorio.nombre as laboratorio,tipo_producto.nombre as tipo, presentacion.nombre as presentacion,producto.avatar as avatar, prod_lab, prod_tip_prod,prod_present FROM producto
            // JOIN lote ON lote.id_producto = producto.id_producto
            // JOIN compra ON lote.id_compra = compra.id
            // JOIN laboratorio ON prod_lab=id_laboratorio AND producto.estado='A'
            // JOIN tipo_producto ON prod_tip_prod=id_tip_prod
            // JOIN presentacion ON prod_present=id_presentacion WHERE producto.estado='A' AND producto.nombre NOT LIKE '' ORDER BY producto.nombre DESC LIMIT 6";
            // $query= $this->acceso->prepare($sql);
            // $query->execute();
            // $this->objetos=$query->fetchAll();
            // return $this->objetos;    
            
            $sql= "SELECT id_producto, producto.nombre as nombre, concentracion, adicional,precio,laboratorio.nombre as laboratorio,tipo_producto.nombre as tipo, presentacion.nombre as presentacion,producto.avatar as avatar, prod_lab, prod_tip_prod,prod_present FROM producto
            JOIN laboratorio ON prod_lab=id_laboratorio AND producto.estado='A'
            JOIN tipo_producto ON prod_tip_prod=id_tip_prod
            JOIN presentacion ON prod_present=id_presentacion WHERE producto.estado='A' and producto.nombre NOT LIKE '' ORDER BY producto.nombre DESC LIMIT 25";
            $query= $this->acceso->prepare($sql);
            $query->execute();
            $this->objetos=$query->fetchAll();
            return $this->objetos;    
        }
    }
    /*===========================
    BUSCAR PRODUCTO EN CATALAGO
    =============================*/
    function buscar_catalago(){
        if (!empty($_POST["consulta"])) {
            $consulta = $_POST["consulta"];
            $sql= "SELECT id_producto, producto.nombre as nombre, concentracion, adicional,precio,laboratorio.nombre as laboratorio,tipo_producto.nombre as tipo, presentacion.nombre as presentacion,producto.avatar as avatar, prod_lab, prod_tip_prod,prod_present FROM producto
            JOIN laboratorio ON prod_lab=id_laboratorio AND producto.estado='A'
            JOIN tipo_producto ON prod_tip_prod=id_tip_prod
            JOIN presentacion ON prod_present=id_presentacion WHERE producto.estado='A' and producto.nombre LIKE :consulta ORDER BY producto.nombre DESC LIMIT 25";
            $query= $this->acceso->prepare($sql);
            $query->execute(array(":consulta"=>"%$consulta%"));
            $this->objetos=$query->fetchAll();
            return $this->objetos;
        }else{
            $sql= "SELECT id_producto, producto.nombre as nombre, concentracion, adicional,precio,laboratorio.nombre as laboratorio,tipo_producto.nombre as tipo, presentacion.nombre as presentacion,producto.avatar as avatar, prod_lab, prod_tip_prod,prod_present FROM producto
            JOIN laboratorio ON prod_lab=id_laboratorio AND producto.estado='A'
            JOIN tipo_producto ON prod_tip_prod=id_tip_prod
            JOIN presentacion ON prod_present=id_presentacion WHERE producto.estado='A' and producto.nombre NOT LIKE '' ORDER BY producto.nombre DESC LIMIT 25";
            $query= $this->acceso->prepare($sql);
            $query->execute();
            $this->objetos=$query->fetchAll();
            return $this->objetos;    
        }
    }
    /*===========================
    EDITAR AVATAR PRODUCTO 
    =============================*/
    function cambiar_avatar($id,$nombre){
        $sql = "SELECT avatar FROM producto WHERE id_producto=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(":id"=>$id));
        $this->objetos= $query->fetchall();

        $sql = "UPDATE producto SET avatar=:nombre WHERE id_producto=:id";
        $query=$this->acceso->prepare($sql);
        $query->execute(array(":id"=>$id,":nombre"=>$nombre));
        return $this->objetos;
    }
    /*===========================
    ELIMINAR PRODUCTO 
    =============================*/
    function eliminar_producto($id,$avatar){
        $avatar_def = 'anonymous.png';
        $sql = "SELECT * FROM lote WHERE lote_id_prod=:id";
        $query=$this->acceso->prepare($sql); 
        $query->execute(array(":id"=>$id));
        $lote=$query->fetchAll();
        if (!empty($lote)) {
            echo 'noborrado';
        }else{
            $sql = "UPDATE producto SET estado='I', avatar=:avatar WHERE id_producto = :id";
            $query=$this->acceso->prepare($sql);
            $query->execute(array(":id"=>$id,":avatar"=>$avatar_def));
            
            if ($avatar != 'anonymous.png') {
                unlink('../img/prod/'.$avatar);
            }

            echo 'borrado';
        }
        
    }
    /*===========================
    STOCK EN TOTAL
    =============================*/
    function stock_producto($id_producto){
        // $sql="SELECT SUM(cantidad_lote) as total,compra.estado_pedido as estado_pedido FROM lote 
        // JOIN compra ON lote.id_compra=compra.id
        // WHERE id_producto=:id AND estado='A'";
        // $query=$this->acceso->prepare($sql);
        // $query->execute(array(':id'=>$id_producto));
        // $this->objetos=$query->fetchAll();
        // return $this->objetos;
        $sql="SELECT lote.cantidad_lote, compra.estado_pedido as estado_pedido FROM lote 
        JOIN compra ON lote.id_compra=compra.id AND estado_pedido = 'E'
        WHERE id_producto=:id";
        $query=$this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id_producto));
        $this->objetos=$query->fetchAll();
        if (!empty($this->objetos)) {
            $sql="SELECT SUM(cantidad_lote) as total,compra.estado_pedido as estado_pedido FROM lote 
            JOIN compra ON lote.id_compra=compra.id  AND estado_pedido = 'E'
            WHERE id_producto=:id AND estado='A'";
            $query=$this->acceso->prepare($sql);
            $query->execute(array(':id'=>$id_producto));
            $this->objetos=$query->fetchAll();
            return $this->objetos;
        }
    }

    /*===========================
    BUSCAR PRODUCTO POR ID
    =============================*/
    function buscar_id($id){
        $sql= "SELECT id_producto, producto.nombre as nombre, concentracion, adicional,precio,laboratorio.nombre as laboratorio,tipo_producto.nombre as tipo, presentacion.nombre as presentacion,producto.avatar as avatar, prod_lab, prod_tip_prod,prod_present FROM producto
        JOIN laboratorio ON prod_lab=id_laboratorio
        JOIN tipo_producto ON prod_tip_prod=id_tip_prod
        JOIN presentacion ON prod_present=id_presentacion WHERE id_producto=:id";
        $query= $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id));
        $this->objetos=$query->fetchAll();
        return $this->objetos; 
    }
    /*===========================
    BUSCAR PRODUCTO POR ID
    =============================*/
    function reporte_productos(){
        $sql= "SELECT id_producto, producto.nombre as nombre, concentracion, adicional,precio,laboratorio.nombre as laboratorio,tipo_producto.nombre as tipo, presentacion.nombre as presentacion,producto.avatar as avatar, prod_lab, prod_tip_prod,prod_present FROM producto
        JOIN laboratorio ON prod_lab=id_laboratorio
        JOIN tipo_producto ON prod_tip_prod=id_tip_prod
        JOIN presentacion ON prod_present=id_presentacion and producto.nombre NOT LIKE '' ORDER BY producto.nombre";
        $query= $this->acceso->prepare($sql);
        $query->execute();
        $this->objetos=$query->fetchAll();
        return $this->objetos;    
    }
    /*===========================
    RELLENAR PRODUCTO 
    =============================*/
    function rellenar_producto(){
        $sql = "SELECT id_producto, producto.nombre as nombre, concentracion, adicional,precio,laboratorio.nombre as laboratorio,tipo_producto.nombre as tipo, presentacion.nombre as presentacion,producto.avatar as avatar, prod_lab, prod_tip_prod,prod_present FROM producto
        JOIN laboratorio ON prod_lab=id_laboratorio
        JOIN tipo_producto ON prod_tip_prod=id_tip_prod
        JOIN presentacion ON prod_present=id_presentacion AND producto.estado='A'
        ORDER BY nombre ASC";
        $query=$this->acceso->prepare($sql);
        $query->execute();
        $this->objetos=$query->fetchAll();
        return $this->objetos;
        
    }
}