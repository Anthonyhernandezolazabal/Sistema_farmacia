<?php
include_once '../modelo/VentaProducto.php';
$venta_producto = new VentaProducto();
if ($_POST["funcion"] =='ver') {
$id= $_POST["id"];
$json = array();
$venta_producto -> ver($id);
foreach ($venta_producto->objetos as $objeto) {
    $json[] = $objeto;
}
$jsonstring = json_encode($json);
echo $jsonstring;
} 