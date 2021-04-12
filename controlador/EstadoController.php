<?php
include '../modelo/Estado.php';
$estado = new Estado();

    if ($_POST["funcion"] == 'rellenar_estado_pago') {
        $json = array();
        $estado -> rellenar_estado_pago();
        foreach ($estado->objetos as $objeto) {

            $json[] = array(
                'id' => $objeto->id,
                'nombre'=> $objeto->nombre
            );
        }
        $jsonstring = json_encode($json);
        echo $jsonstring;
    }
    if ($_POST["funcion"] == 'cambiar_estado_co') {
        $nombre = $_POST['estado'];
        $estado -> obtenerId_estado($nombre);
        foreach ($estado->objetos as $objeto) {

            $json[] = array(
                'id' => $objeto->id,
            );
        }
        $jsonstring = json_encode($json);
        echo $jsonstring;
    }

?>