<?php
include '../modelo/venta.php';
include_once '../modelo/Conexion.php';/*SE VUELVE HACER LA CONEXIÓN PDO PARA PODER REALIZAR LA TRANSACCIÓN */
$venta = new Venta();
session_start();
$vendedor = $_SESSION['usuario'];
    /*===========================
    REGISTRAR VENTA
    =============================*/
    if ($_POST["funcion"] =='registrar_compra') {
        $total = $_POST["total"];
        $cliente = $_POST["cliente"];
        $productos = json_decode($_POST["json"]);
        // echo print_r ($productos);
        /*=== OBTENER LA FECHA  Y HORA EXACTA ===*/
        date_default_timezone_set('America/Lima');
        $fecha = date('Y-m-d H:i:s');
        $venta->crear($cliente,$total,$fecha,$vendedor);
        /*=== OBTENER EL ID DE LA ÚLTIMA VENTA ===*/
        $venta->ultima_venta();
        foreach ($venta->objetos as $objeto) {
            $id_venta = $objeto->ultima_venta;
            // echo $id_venta;
        }
        /*======= TRANSACCIÓN ========*/
        /*Para realizar la transacción se debe usar try catch */
        try {
            $db = new Conexion();
            $conexion = $db->pdo;
            $conexion->beginTransaction();
            /*Recorrer todo los productos y saber la cantidad quee quiere cada uno de los productos */
            foreach ($productos as $prod) {
                $cantidad = $prod->cantidad;
                while ($cantidad!=0) {
                    $sql = "SELECT * FROM lote WHERE vencimiento = (SELECT MIN(vencimiento) FROM lote WHERE id_producto=:id AND estado='A') AND id_producto=:id";
                    $query = $conexion->prepare($sql);
                    $query->execute(array(':id'=>$prod->id));
                    $lote=$query->fetchall();
                    foreach ($lote as $lote) {
                        $sql = "SELECT compra.id_proveedor AS proveedor FROM lote
                        JOIN compra ON lote.id_compra= compra.id AND lote.id=:id";
                        $query = $conexion->prepare($sql);
                        $query->execute(array(':id'=>$lote->id));
                        $prov=$query->fetchall();
                        $proveedor = $prov[0]->proveedor; #Solo nos selecciona un solo dato
                        /*Reducir el lote */
                        if ($cantidad<$lote->cantidad_lote) {/*Cuando la cantidad es menor al stock del lote*/
                            $sql = "INSERT INTO detalle_venta(det_cantidad, det_vencimiento, id__det_lote, id__det_prod, lote_id_prov, id_det_venta) VALUES('$cantidad','$lote->vencimiento','$lote->id','$prod->id','$proveedor','$id_venta')";
                            $conexion->exec($sql);
                            $conexion->exec("UPDATE lote SET cantidad_lote = cantidad_lote-'$cantidad' WHERE id='$lote->id'");/*Para ejecutar las transacciones */
                            $cantidad=0;
                        }
                        if ($cantidad==$lote->cantidad_lote) {/*Cuando la cantidad es igual al stock del lote*/
                            $sql = "INSERT INTO detalle_venta(det_cantidad, det_vencimiento, id__det_lote, id__det_prod, lote_id_prov, id_det_venta) VALUES('$cantidad','$lote->vencimiento','$lote->id','$prod->id','$proveedor','$id_venta')";
                            $conexion->exec($sql);
                            $conexion->exec("UPDATE lote SET estado='I', cantidad_lote=0 WHERE id='$lote->id'");
                            $cantidad=0;
                        }
                        if ($cantidad>$lote->cantidad_lote) {
                            $sql = "INSERT INTO detalle_venta(det_cantidad, det_vencimiento, id__det_lote, id__det_prod, lote_id_prov, id_det_venta) VALUES('$lote->cantidad_lote','$lote->vencimiento','$lote->id','$prod->id','$proveedor','$id_venta')";
                            $conexion->exec($sql);
                            $conexion->exec("UPDATE lote SET estado='I', cantidad_lote=0 WHERE id='$lote->id'");
                            $cantidad=$cantidad-$lote->cantidad_lote;
                        }
                    }
                }
                $subtotal = $prod->cantidad * $prod->precio;
                $conexion->exec("INSERT INTO venta_producto(precio,cantidad,subtotal,producto_id_producto,venta_id_venta)values('$prod->precio','$prod->cantidad','$subtotal','$prod->id','$id_venta')");
            }
            $conexion->commit();
        } 
        catch (Exception $error) {
            $conexion->rollBack();/*Cuando algo sale mal va anular todo lo que se hace en el try */
            $venta->borrar($id_venta);/*Si hay un conflicto pero la venta ya se creó, tenemos que elimnarla */
            echo $error->getMessage(); /*Voy a optener el mensaje de error */
        }
    }