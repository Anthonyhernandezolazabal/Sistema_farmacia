<?php
include_once '../modelo/VentaProducto.php';
include_once '../modelo/DetalleVenta.php';
include_once '../modelo/venta.php';
include_once '../modelo/Lote.php';
$lote = new Lote();
$venta = new Venta();
$detalle_venta = new DetalleVenta();
$venta_producto = new VentaProducto();
session_start();
$id_usuario = $_SESSION['usuario'];
$tipo_usuario = $_SESSION['us_tipo'];
/*============================
BORRAR VENTA PRODUCTO
=============================*/
if ($_POST["funcion"] == 'borrar_venta') {
    $id_venta = $_POST["id"];
    if ($venta->verificar($id_venta,$id_usuario) == 1) { //Esa venta si me pertenece
        $venta_producto->borrar($id_venta);
        $detalle_venta->recuperar($id_venta);
        foreach ($detalle_venta->objetos as $det) {
            // VERIFICAR CADA REGISTRO
            $lote->devolver($det->id__det_lote,$det->det_cantidad,$det->det_vencimiento,$det->id__det_prod,$det->lote_id_prov);
            $detalle_venta->borrar($det->id_detalle);
        }
        // ELIMINAR LA VENTA
        $venta->borrar($id_venta);
    }else{

        if ($tipo_usuario == 3) { //Usuario ROOT

            $venta_producto->borrar($id_venta);
            $detalle_venta->recuperar($id_venta);
            foreach ($detalle_venta->objetos as $det) {
                // VERIFICAR CADA REGISTRO
                $lote->devolver($det->id__det_lote,$det->det_cantidad,$det->det_vencimiento,$det->id__det_prod,$det->lote_id_prov);
                $detalle_venta->borrar($det->id_detalle);
            }
            // ELIMINAR LA VENTA
            $venta->borrar($id_venta);

        }else if ($tipo_usuario == 1) { //Usuario ADMINISTRADOR

            $venta->recuperar_vendedor($id_venta);
            foreach ($venta->objetos as $objeto) {

                if ($objeto->us_tipo == 2) {

                    $venta_producto->borrar($id_venta);
                    $detalle_venta->recuperar($id_venta);
                    foreach ($detalle_venta->objetos as $det) {
                        // VERIFICAR CADA REGISTRO
                        $lote->devolver($det->id__det_lote,$det->det_cantidad,$det->det_vencimiento,$det->id__det_prod,$det->lote_id_prov);
                        $detalle_venta->borrar($det->id_detalle);
                    }
                    // ELIMINAR LA VENTA
                    $venta->borrar($id_venta);

                }else{

                    echo 'nodelete';
                    
                }
            }
            
        }else if ($tipo_usuario == 2) {

            echo 'nodelete';
            
        }


    }
}