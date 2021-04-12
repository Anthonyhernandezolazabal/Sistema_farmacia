<?php
include '../modelo/Presentacion.php';
$presentacion = new Presentacion();
    /*============================
    BUSCAR PRESENTACION
    =============================*/
    if ($_POST["funcion"] == 'buscar_presentacion') {
        $json = array();
        $presentacion -> buscar();
        foreach ($presentacion->objetos as $objeto) {

            $json[] = array(
                'id_pres' => $objeto->id_presentacion,
                'nombre'=> $objeto->nombre
            );
        }
        $jsonstring = json_encode($json);
        echo $jsonstring;
    }
    /*============================
    REGISTRAR PRESENTACION
    =============================*/
    if ($_POST["funcion"]=='crear_pres') {
        $nombre = $_POST["nombre_pres"];
        $presentacion -> crear_presentacion($nombre);
    }
    /*============================
    EDITAR PRESENTACION
    =============================*/
    if ($_POST["funcion"]=='editar_pres') {
        $nombre = $_POST["nombre_pres"];
        $id_pres = $_POST["id_pres"];
        $presentacion -> editar_pres($nombre,$id_pres);
    }
    /*============================
    ELIMINAR PRESENTACION
    =============================*/
    if ($_POST["funcion"]=='eliminar_pres') {
        $id_pres = $_POST["id_Pres"];
        $presentacion -> eliminar($id_pres);
    }
    /*===========================
    RELLENAR CON DATOS EL SELECT 
    =============================*/
    if ($_POST["funcion"] == 'rellenar_presentacion'){
        $presentacion->rellenar_presentacion();
        $json = array();
        foreach ($presentacion->objetos as $objeto) {
            $json[] = array(
                'id_pres'=>$objeto->id_presentacion,
                'nombre'=>$objeto->nombre
            );
        }
        $jsonstring = json_encode($json);
        echo $jsonstring;
    }