<?php
include_once '../modelo/venta.php';
include_once '../modelo/Clientes.php';
$cliente = new Cliente();
session_start();
$id_usuario = $_SESSION["usuario"];
$venta = new Venta();
    /*============================
    BUSCAR TIPO
    =============================*/
    if ($_POST["funcion"]=='listar') {
        $venta -> buscar();
        $json = array();    
        foreach ($venta->objetos as $objeto) {
            // $json['data'][] = $objeto;   #Una forma  
            if (empty($objeto->id_cliente)) {
                $cliente_nombre = $objeto->cliente;
                $cliente_dni = $objeto->dni;
            }else{
                $cliente->buscar_dato_cliente($objeto->id_cliente);
                foreach ($cliente->objetos as $cli) {
                    $cliente_nombre = $cli->nombre.' '.$cli->apellidos;
                    $cliente_dni = $cli->dni;
                }
            }
            $json['data'][] = array(
                'id_venta'=>$objeto->id_venta,
                'fecha'=>$objeto->fecha,
                'cliente'=>$cliente_nombre,
                'dni'=>$cliente_dni,
                'total'=>'S/ '.$objeto->total,
                'vendedor'=>$objeto->vendedor,
            );
        }
        $jsonstring = json_encode($json);
        echo $jsonstring;
    }
    /*============================
    CONSULTAS
    =============================*/
    if ($_POST["funcion"]=='mostrar_consultas') {
        /*===========VENTA DEL DÍA POR VENDEDOR===========*/
        $venta -> venta_dia_vendedor($id_usuario);
        foreach ($venta->objetos as $objeto) {
            $venta_dia_vendedor =  number_format($objeto->venta_dia_vendedor, 2); 
            $venta_dia_vendedor=$venta_dia_vendedor;
        }
        /*===========VENTA DIARIA===========*/
        $venta -> venta_diaria();
        foreach ($venta->objetos as $objeto) {
            $venta_diaria = number_format($objeto->venta_diaria,2);
            $venta_diaria=$venta_diaria;
        }
        /*===========VENTA MENSUAL===========*/
        $venta -> venta_mensual();
        foreach ($venta->objetos as $objeto) {
            $venta_mensual = number_format($objeto->venta_mensual,2);
            $venta_mensual=$venta_mensual;
        }
        /*===========GANANCIA MENSUAL===========*/
        $venta -> monto_costo();
        $monto_costo = '';
        foreach ($venta->objetos as $objeto) {
            $monto_costo = number_format($objeto->monto_costo,2);
            $monto_costo=$monto_costo;
        }

        /*===========VENTA ANUAL===========*/
        $venta -> venta_anual();
        $json = array();
        foreach ($venta->objetos as $objeto) {
            $venta_anual = number_format($objeto->venta_anual,2);
            $json[] = array(
                'venta_dia_vendedor'=>$venta_dia_vendedor,
                'venta_diaria'=>$venta_diaria,
                'venta_mensual'=>$venta_mensual,
                'venta_anual'=>$venta_anual,
                'ganancia_mensual'=>$venta_mensual - $monto_costo
            );
        }
        $jsonstring = json_encode($json[0]);
        echo $jsonstring;
    }

    /*============================
    CONSULTAS VENTAS POR MES DEL AÑO
    =============================*/
    if ($_POST["funcion"]=='venta_mes') {
        $venta -> venta_mes();
        $json = array();
        foreach ($venta->objetos as $objeto) {
            $json[] = $objeto;
        }
        $jsonstring = json_encode($json);
        echo $jsonstring;
    }
    /*============================
    CONSULTAS 3 PRIMEROS VENDEDORES
    =============================*/
    if ($_POST["funcion"]=='vendedor_mes') {
        $venta -> vendedor_mes();
        $json = array();
        foreach ($venta->objetos as $objeto) {
            $json[] = $objeto;
        }
        $jsonstring = json_encode($json);
        echo $jsonstring;
        
    }
    /*============================
    CONSULTAS VENTAS DE CADA AÑO
    =============================*/
    if ($_POST["funcion"]=='ventas_anual') {
        $venta -> ventas_anual();
        $json = array();
        foreach ($venta->objetos as $objeto) {
            $json[] = $objeto;
        }
        $jsonstring = json_encode($json);
        echo $jsonstring;
    }
    /*============================
    CONSULTAS 5 PRODUCTOS DEL MES
    =============================*/
    if ($_POST["funcion"]=='producto_mas_vendido') {
        $venta -> producto_mas_vendido();
        $json = array();
        foreach ($venta->objetos as $objeto) {
            $json[] = $objeto;
        }
        $jsonstring = json_encode($json);
        echo $jsonstring;
    }
    /*============================
    CONSULTAS 3 PRIMEROS CLIENTES
    =============================*/
    if ($_POST["funcion"]=='cliente_mes') {
        $venta -> cliente_mes();
        $json = array();
        foreach ($venta->objetos as $objeto) {
            $json[] = $objeto;
        }
        $jsonstring = json_encode($json);
        echo $jsonstring;
        
    }