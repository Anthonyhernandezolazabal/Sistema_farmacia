<?php
include '../modelo/Proveedor.php';
$proveedor = new Proveedor();
    /*===========================
    REGISTRAR PROVEEDOR 
    =============================*/
    if ($_POST["funcion"] == 'crear') {
        $nombre = $_POST["nombre"];
        $telefono = $_POST["telefono"];
        $correo = $_POST["correo"];
        $direccion = $_POST["direccion"];
        $avatar = 'prov_default.png';
        $proveedor -> crear($nombre,$telefono,$correo,$direccion,$avatar);
    }
    /*===========================
    EDITAR PROVEEDOR 
    =============================*/
    if ($_POST["funcion"] == 'editar') {
        $id = $_POST["id"];
        $nombre = $_POST["nombre"];
        $telefono = $_POST["telefono"];
        $correo = $_POST["correo"];
        $direccion = $_POST["direccion"];
        $proveedor -> editar($nombre,$telefono,$correo,$direccion,$id);
    }
    /*===========================
    BUSCAR PROVEEDOR 
    =============================*/
    if ($_POST["funcion"] == 'buscar') {
        $proveedor -> buscar();
        $json = array();
        foreach ($proveedor->objetos as $objeto) {
            
            $json[] = array(
                'id'=>$objeto->id_proveedor,
                'nombre'=>$objeto->nombre,
                'telefono'=>$objeto->telefono,
                'correo'=>$objeto->correo,
                'direccion'=>$objeto->direccion,
                'avatar'=>$objeto->avatar
            );
        }
        $jsonstring = json_encode($json);
        echo $jsonstring;

    }
    /*===========================
    CAMBIAR LOGO PROVEEDOR 
    =============================*/
    if ($_POST["funcion"] == 'cambiar_avatar') {
        $id = $_POST["id_logo_prov"];
        $nombre = uniqid().'-'.$_FILES["photo"]["name"];
        $ruta = '../img/prov/'.$nombre;
        move_uploaded_file($_FILES["photo"]["tmp_name"],$ruta);
        $proveedor->cambiar_avatar($id,$nombre);
        foreach ($proveedor->objetos as $objeto) {
            if ($objeto->avatar != "prov_default.png") {
                unlink('../img/prov/'.$objeto->avatar);
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
    /*===========================
    ELIMINAR PROVEEDOR 
    =============================*/
    if($_POST["funcion"]=='borrar'){
        $id = $_POST["id"];
        $avatar = $_POST["avatar"];
        $proveedor->borrar($id,$avatar);
    }
    /*===========================
    RELLENAR PROVEEDOR EN EL LOTE
    =============================*/
    if ($_POST["funcion"] == 'rellenar_proveedor') {
        $proveedor->rellenar_proveedor();
        $json = array();
        foreach ($proveedor->objetos as $objeto) {
            $json[]=array(
                'id'=>$objeto->id_proveedor,
                'nombre'=>$objeto->nombre
            );
        }
        $jsonstring = json_encode($json);
        echo $jsonstring;
    }
