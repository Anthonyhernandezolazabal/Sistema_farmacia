<?php
include '../modelo/Lote.php';
$lote = new Lote();
    /*===========================
    REGISTRAR LOTE 
    =============================*/
    if ($_POST["funcion"]=='crear') {
        $id_producto= $_POST["id_producto"];
        $proveedor= $_POST["proveedor"];
        $stock= $_POST["stock"];
        $vencimiento= $_POST["vencimiento"];
        $lote->crear($id_producto,$proveedor,$stock,$vencimiento);
    }
    /*===========================
    ELIMINAR LOTE 
    =============================*/
    if ($_POST["funcion"] == 'eliminar') {
        $id = $_POST["id"];
        $lote -> eliminar($id);
    }

    ////////////////////////////////ACTUALIZACION///////////////////////////////
    if ($_POST["funcion"] == 'ver_cmp') {
        $id = $_POST["id"];
        $lote -> ver_cmp($id);
        foreach ($lote->objetos as $objeto) {
            $json[] = array(
                'codigo'=>$objeto->codigo,
                'cantidad'=>$objeto->cantidad,
                'vencimiento'=>$objeto->vencimiento,
                'precio_compra'=>$objeto->precio_compra,
                'producto'=>$objeto->producto.' | '.$objeto->concentracion.' | '.$objeto->adicional,
                'laboratorio'=>$objeto->laboratorio,
                'tipo'=>$objeto->tipo,
                'presentacion'=>$objeto->presentacion
            );
        }
        $jsonstring = json_encode($json);
        echo $jsonstring;
    }
    /*===========================
    BUSCAR LOTES EN RIESGOS
    =============================*/
    if ($_POST["funcion"]=='buscar_lote_riesgos') {
        $lote -> buscar();
        $json = array();
        date_default_timezone_set('America/Lima');
        $fecha = date('Y-m-d H:i:s');
        $fecha_actual = new DateTime($fecha);
        foreach ($lote->objetos as $objeto) {
            $vencimiento = new DateTime($objeto->vencimiento);
            $diferencia = $vencimiento->diff($fecha_actual);
            $anio = $diferencia->y;
            $mes = $diferencia->m;
            $dia = $diferencia->d;
            $verificado = $diferencia->invert;
            $estado = 'light';
            if ($verificado == 0) {
                $estado = 'danger';
                $mes = $mes * (-1);
                $dia = $dia * (-1);
            }else{
                if ($mes > 3) {
                    $estado = 'light';
                }
                if($mes <= 3 && $anio==0){
                    $estado = 'warning';
                }
            }
            if ($estado=='danger' || $estado=='warning') {
                
                $json[]= array(
                    'id_lote'=>$objeto->id_lote,
                    'stock'=>$objeto->cantidad_lote,
                    'vencimiento'=>$objeto->vencimiento,
                    'concentracion'=>$objeto->concentracion,
                    'adicional'=>$objeto->adicional,
                    'nombre'=>$objeto->prod_nom,
                    'laboratorio'=>$objeto->lab_nom,
                    'tipo'=>$objeto->tip_nom,
                    'presentacion'=>$objeto->pres_nom,
                    'proveedor'=>$objeto->proveedor,
                    'avatar'=>$objeto->logo,
                    'mes'=>$mes,
                    'dia'=>$dia,
                    'estado'=>$estado,
                );
            }
        }
        $jsonstring = json_encode($json);
        echo $jsonstring;
    }
    /*===========================
    BUSCAR LOTE 
    =============================*/
    if ($_POST["funcion"]=='buscar_lote') {
        $lote -> buscar();
        $json = array();
        date_default_timezone_set('America/Lima');
        $fecha = date('Y-m-d H:i:s');
        $fecha_actual = new DateTime($fecha);
        foreach ($lote->objetos as $objeto) {
            $vencimiento = new DateTime($objeto->vencimiento);
            $diferencia = $vencimiento->diff($fecha_actual);
            $anio = $diferencia->y;
            $mes = $diferencia->m;
            $dia = $diferencia->d;
            $verificado = $diferencia->invert;
            $estado = 'light';
            if ($verificado == 0) { //Fecha vencida
                $estado = 'danger';
                $mes = $mes * (-1);
                $dia = $dia * (-1);
            }else{ //Fecha actual
                if ($mes > 3) {
                    $estado = 'light';
                }
                if($mes <= 3 && $anio==0){
                    $estado = 'warning';
                }
            }
            $json[]= array(
                'codigo'=>$objeto->codigo,
                'id_lote'=>$objeto->id_lote,
                'stock'=>$objeto->cantidad_lote,
                'vencimiento'=>$objeto->vencimiento,
                'concentracion'=>$objeto->concentracion,
                'adicional'=>$objeto->adicional,
                'nombre'=>$objeto->prod_nom,
                'laboratorio'=>$objeto->lab_nom,
                'tipo'=>$objeto->tip_nom,
                'presentacion'=>$objeto->pres_nom,
                'proveedor'=>$objeto->proveedor,
                'avatar'=>$objeto->logo,
                'mes'=>$mes,
                'dia'=>$dia,
                'anio'=>$anio,
                'estado'=>$estado,
            );
        }
        $jsonstring = json_encode($json);
        echo $jsonstring;
    }
    /*===========================
    EDITAR LOTE 
    =============================*/
    if ($_POST["funcion"] == 'editar') {
        $id = $_POST["id"];
        $stock = $_POST["stock"];
        $lote -> editar($id,$stock);
    }