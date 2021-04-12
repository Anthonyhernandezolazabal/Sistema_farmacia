<?php
include '../modelo/Usuario.php';
session_start();
$usuario = new Usuario();

/*===========================
LOGUEARSE
=============================*/
if ($_POST['funcion'] == 'validar_sesion') {

    $user= $_POST["dni"];
    $pass= $_POST["pass"];
    $json = array();
    if (!empty($usuario->Loguearse($user,$pass)=='logueado')) {
        $usuario -> obtener_dato_logueado($user);
        foreach ($usuario->objetos as $objeto) {

            $_SESSION['usuario']=$objeto->id_usuario;
            $_SESSION['us_tipo']=$objeto->us_tipo;
            $_SESSION['nombre']=$objeto->nombre_us;
            $_SESSION['apellido']=$objeto->apellidos_us;
            $_SESSION['iniciarSesion']='ok';

            $json[] = array(
                'datos'=>$objeto
            );
        }

    }else{

        $json[] = array(
            'datos'=>null
        );

    }

    $jsonstring = json_encode($json[0]);/*Va ver muchos usuarios */
    echo $jsonstring;
}