<?php
include_once 'Conexion.php';
class Venta{
    var $objetos;
    public function __construct(){
        $db = new Conexion(); 
        $this->acceso = $db->pdo;
    }
    /*===========================
    REGISTRAR VENTA
    =============================*/
    function crear($cliente,$total,$fecha,$vendedor){
        $sql = "INSERT INTO venta(fecha, total, vendedor, id_cliente) VALUES (:fecha, :total, :vendedor, :cliente)";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':fecha'=>$fecha,':cliente'=>$cliente,':total'=>$total,':vendedor'=>$vendedor));
    }
    /*===========================
    REGISTRO DE LA ÚLTIMA VENTA
    =============================*/
    function ultima_venta(){
        $sql = "SELECT MAX(id_venta) as ultima_venta FROM venta";/*Dela tabla venta estamos recorriendo todo los registro y vamos a elegir el id máximo el último ID que se a creado y le estamos dando un alias de última venta */
        $query = $this->acceso->prepare($sql);
        $query->execute();
        $this->objetos= $query->fetchall();
        return $this->objetos;
    }
    /*===========================
    BORRAR VENTA
    =============================*/
    function borrar($id_venta){
        $sql = 'DELETE FROM venta WHERE id_venta=:id_venta';
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id_venta'=>$id_venta));
        echo 'delete';
    }
    /*===========================
    BUSCAR VENTA
    =============================*/
    function buscar(){
        $sql = "SELECT id_venta,fecha,cliente,dni,total, CONCAT(usuario.nombre_us,' ',usuario.apellidos_us) as vendedor,id_cliente FROM venta join usuario on vendedor=id_usuario";
        $query = $this->acceso->prepare($sql);
        $query->execute();
        $this->objetos= $query->fetchall();
        return $this->objetos;
    }
    /*===========================
    VENTA DEL DÍA POR VENDEDOR
    =============================*/
    function venta_dia_vendedor($id_usuario){
        $sql = "SELECT SUM(total) as venta_dia_vendedor FROM venta WHERE vendedor=:id_usuario AND date(fecha)=date(curdate())";/*curdate()=captura la fecha actual */
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id_usuario'=>$id_usuario));
        $this->objetos= $query->fetchall();
        return $this->objetos;
    }
    /*===========================
    VENTA DIARIA
    =============================*/
    function venta_diaria(){
        $sql = "SELECT SUM(total) as venta_diaria FROM venta WHERE date(fecha)=date(curdate())";/*curdate()=captura la fecha actual */
        $query = $this->acceso->prepare($sql);
        $query->execute();
        $this->objetos= $query->fetchall();
        return $this->objetos;
    }
    /*===========================
    VENTA MENSUAL
    =============================*/
    function venta_mensual(){
        $sql = "SELECT SUM(total) as venta_mensual FROM venta WHERE year(fecha)=year(curdate()) AND month(fecha)=month(curdate())";/*Voy a tomar el año y el mes de la fecha*/
        $query = $this->acceso->prepare($sql);
        $query->execute();
        $this->objetos= $query->fetchall();
        return $this->objetos;
    }
    /*===========================
    MONTO COSTO
    =============================*/
    function monto_costo(){
        $sql = "SELECT SUM(det_cantidad*precio_compra) AS monto_costo FROM detalle_venta
        JOIN venta ON id_det_venta=id_venta AND year(fecha) = year(curdate()) AND month(fecha) = month(curdate())
        JOIN lote ON id__det_lote = lote.id";
        $query = $this->acceso->prepare($sql);
        $query->execute();
        $this->objetos= $query->fetchall();
        return $this->objetos;
    }
    /*===========================
    VENTA ANUAL
    =============================*/
    function venta_anual(){
        $sql = "SELECT SUM(total) as venta_anual FROM venta WHERE year(fecha)=year(curdate())";
        $query = $this->acceso->prepare($sql);
        $query->execute();
        $this->objetos= $query->fetchall();
        return $this->objetos;
    }
    /*============================
    BORRAR VENTA PRODUCTO
    =============================*/
    function verificar($id_venta,$id_usuario){
        $sql = "SELECT * FROM venta WHERE vendedor=:id_usuario AND id_venta=:id_venta";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id_usuario'=>$id_usuario,':id_venta'=>$id_venta));
        $this->objetos= $query->fetchall();
        if (!empty($this->objetos)) {
            return 1; //Me pertenece a mi usuario
        }else{
            return 0;
        }
    }
    /*============================
    RECUPERAR VENDEDOR
    =============================*/
    function recuperar_vendedor($id_venta){
        $sql = "SELECT us_tipo  FROM venta JOIN usuario ON id_usuario=vendedor WHERE id_venta=:id_venta";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id_venta'=>$id_venta));
        $this->objetos= $query->fetchall();
        return $this->objetos;
    }
    /*===========================
    VER  VENTA REGISTRADA
    =============================*/
    function buscar_id($id_venta){
        $sql = "SELECT id_venta,fecha,cliente,dni,total, CONCAT(usuario.nombre_us,' ',usuario.apellidos_us) as vendedor, id_cliente FROM venta join usuario on vendedor=id_usuario AND id_venta=:id_venta";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id_venta'=>$id_venta));
        $this->objetos= $query->fetchall();
        return $this->objetos;
    }
    /*============================
    CONSULTAS VENTAS POR MES DEL AÑO
    =============================*/
    function venta_mes(){
        $sql = "SELECT SUM(total) as cantidad, month(fecha) as mes FROM venta WHERE year(fecha) = year(curdate()) GROUP BY month(fecha)";
        $query = $this->acceso->prepare($sql);
        $query->execute();
        $this->objetos= $query->fetchall();
        return $this->objetos;
    }
    /*============================
    CONSULTAS 3 PRIMEROS VENDEDORES  
    =============================*/
    function vendedor_mes(){
        $sql = "SELECT CONCAT(usuario.nombre_us,' ',usuario.apellidos_us) as vendedor_nombre, SUM(total) as cantidad FROM venta JOIN usuario ON id_usuario=vendedor WHERE month(fecha) = month(curdate()) AND year(fecha)=year(curdate()) GROUP BY vendedor ORDER BY cantidad DESC LIMIT 3 ";
        $query = $this->acceso->prepare($sql);
        $query->execute();
        $this->objetos= $query->fetchall();
        return $this->objetos;
    }

    /*============================
    CONSULTAS VENTAS DE CADA AÑO
    =============================*/
    function ventas_anual(){
        $sql = "SELECT SUM(total) as cantidad, month(fecha) as mes FROM venta WHERE year(fecha) = year(date_add(curdate(),INTERVAL -1 YEAR)) GROUP BY month(fecha) ";
        $query = $this->acceso->prepare($sql);
        $query->execute();
        $this->objetos= $query->fetchall();
        return $this->objetos;
    }
    /*============================
    CONSULTAS 5 PRODUCTOS DEL MES
    =============================*/
    function producto_mas_vendido(){
        $sql = "SELECT nombre,concentracion,adicional,SUM(cantidad) AS total FROM venta
        JOIN venta_producto ON id_venta=venta_id_venta
        JOIN producto ON id_producto=producto_id_producto
        WHERE year(fecha)=year(curdate()) AND month(fecha) = month(curdate())
        GROUP BY producto_id_producto ORDER BY total DESC LIMIT 5";
        $query = $this->acceso->prepare($sql);
        $query->execute();
        $this->objetos= $query->fetchall();
        return $this->objetos;
    }
    /*============================
    CONSULTAS 3 PRIMEROS CLIENTES  
    =============================*/
    function cliente_mes(){
        $sql = "SELECT CONCAT(clientes.nombre,' ',clientes.apellidos) as cliente_nombre, SUM(total) as cantidad 
        FROM venta 
        JOIN clientes ON id_cliente=id 
        WHERE month(fecha) = month(curdate()) 
        AND year(fecha)=year(curdate()) 
        GROUP BY id_cliente 
        ORDER BY cantidad
        DESC LIMIT 3 ";
        $query = $this->acceso->prepare($sql);
        $query->execute();
        $this->objetos= $query->fetchall();
        return $this->objetos;
    }
}