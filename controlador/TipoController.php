<?php
include '../modelo/tipo.php';
$tipo = new Tipo();
    /*============================
    BUSCAR TIPO
    =============================*/
    if ($_POST["funcion"]=='buscar_tipo') {
        $json  = array();
        $tipo -> buscar();
        foreach ($tipo->objetos as $objeto) {
            $json[]= array(
                'id_tipo'=>$objeto->id_tip_prod,
                'nombre'=>$objeto->nombre
            );
        }
        $jsonstring = json_encode($json);

        echo $jsonstring;
    }
    /*============================
    REGISTRAR TIPO
    =============================*/
    if ($_POST["funcion"]=='crear_tipo') {
        $nombre = $_POST["nombre_tipo"];
        $tipo -> crear_tipo($nombre);
    }
    /*============================
    EDITAR TIPO
    =============================*/
    if ($_POST["funcion"]=='editar_tipo') {
        $nombre = $_POST["nombre_tipo"];
        $tipo_id = $_POST["tipo_id"];
        $tipo -> editar_tipo($nombre,$tipo_id);
    }

    /*============================
    ELIMINAR TIPO
    =============================*/
    if ($_POST["funcion"]=='eliminar_tip') {
        $id_tipo = $_POST["id_tip"];
        $tipo -> eliminar($id_tipo);
    }
    /*===========================
    RELLENAR CON DATOS EL SELECT 
    =============================*/
    if ($_POST["funcion"] == 'rellenar_tipo'){
        $tipo->rellenar_tipo();
        $json = array();
        foreach ($tipo->objetos as $objeto) {
            $json[] = array(
                'id_tipo'=>$objeto->id_tip_prod,
                'nombre'=>$objeto->nombre
            );
        }
        $jsonstring = json_encode($json);
        echo $jsonstring;
    }
    