<?php
include '../modelo/laboratorio.php';
$laboratorio = new Laboratorio();
    /*============================
    CREAR LABORATORIO
    =============================*/
    if ($_POST["funcion"] == 'crear') {
        $nombre = $_POST["nombre_laboratorio"];
        $avatar = 'lab_default.jpg';
        $laboratorio -> crear($nombre,$avatar);
    }
    /*============================
    EDITAR LABORATORIO
    =============================*/
    if ($_POST["funcion"]=='editar') {
        $nombre = $_POST["nombre_laboratorio"];
        $id_editado = $_POST["id_editado"];
        $laboratorio -> editar($id_editado,$nombre);
    }
    /*============================
    BUSCAR LABORATORIO
    =============================*/
    if ($_POST["funcion"] == 'buscar_datos') {
        $json = array();
        $laboratorio -> buscar();
        foreach ($laboratorio->objetos as $objeto) {
            $json[] = array(
                'id'=>$objeto->id_laboratorio,
                'nombre'=>$objeto->nombre,
                'avatar'=>$objeto->avatar
            );
        }
        $jsonstring = json_encode($json);
        echo $jsonstring;
    }
    /*============================
    CABIAR AVATAR
    =============================*/
    if ($_POST["funcion"] == 'cambiar_logo') {
        $id_logo = $_POST["id_logo"];
        $nombre = uniqid().'-'.$_FILES["photo"]["name"];
        $ruta = '../img/lab/'.$nombre;
        move_uploaded_file($_FILES["photo"]["tmp_name"],$ruta);
        $laboratorio->cambiar_logo($id_logo,$nombre);
        foreach ($laboratorio->objetos as $objeto) {
            if ($objeto->avatar != "lab_default.jpg") {
                unlink('../img/lab/'.$objeto->avatar);
            }
        }
        $json = array();
        $json[] = array(
            'ruta'=>$ruta,
            'alert'=>'edit'
        );
        $jsonstring = json_encode($json[0]);
        echo $jsonstring;

    }
    /*============================
    BORRAR LABORATORIO
    =============================*/
    if ($_POST["funcion"] == 'borrar') {
        $id = $_POST["id"];
        $avatar = $_POST["avatar"];
        $laboratorio->borrar($id,$avatar);
    }
    /*===========================
    RELLENAR CON DATOS EL SELECT 
    =============================*/
    if ($_POST["funcion"] == 'rellenar_laboratorio'){
        $laboratorio->rellenar_laboratorio();
        $json = array();
        foreach ($laboratorio->objetos as $objeto) {
            $json[] = array(
                'id_lab'=>$objeto->id_laboratorio,
                'nombre'=>$objeto->nombre
            );
        }
        $jsonstring = json_encode($json);
        echo $jsonstring;
        
    }






