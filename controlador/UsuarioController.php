<?php
include '../modelo/Usuario.php';
/*Instanciamos */
$usuario = new Usuario();
session_start();
$id_usuario =$_SESSION["usuario"];
$tipo_usuario =$_SESSION["us_tipo"];
/*===========================
MOSTRAR DATOS DEL USUARIO
=============================*/
/*Que función está realizando o está mandando */
if ($_POST['funcion'] == 'buscar_usuario') { /*Si esta petición que estamos haciendo se llama buscar_usuario */
    $json = array();
    $fecha_actual = new DateTime();/*Nos devuelve la fecha y tiempo actual de hoy */
    $usuario->obtener_datos($_POST["dato"]);
    foreach ($usuario->objetos as $objeto) {
        $nacimiento = new DateTime($objeto->edad); /*Convierte el string que viene de la bd en fecha */
        $edad = $nacimiento->diff($fecha_actual);/*diff(): compara la fecha actual con la fecha de nacimiento que viene de la bd y hace una pequeña resta... resta el año el mes la hora el día.. */
        $edad_years = $edad->y; /*de esta variable vamos a obtener la diferencia en años Y */

        $json[] = array(
            'nombre'=>$objeto->nombre_us,
            'apellidos'=>$objeto->apellidos_us,
            'edad'=>$edad_years,
            'dni'=>$objeto->dni_us,
            'tipo'=>$objeto->nombre_tipo,
            'telefono'=>$objeto->telefono_us,
            'residencia'=>$objeto->residencia_us,
            'correo'=>$objeto->corre_us,
            'sexo'=>$objeto->sexo_us,
            'adicional'=>$objeto->adicional_us,
            'avatar'=>'img/usuario/'.$objeto->avatar/*En la bd está guardado con el nombre */
        );
    }
    $jsonstring = json_encode($json[0]);
    /*
    json_encode: Nos devuelve un string de json, lo codifica y lo convierte en string
    $json[0]: el primero que encuentra 
    */
    echo $jsonstring;
}

/*===========================
CAMBIAR AVATAR
=============================*/
if ($_POST['funcion'] == 'cambiar_foto') { 

    $nombre = uniqid().'-'.$_FILES['photo']['name']; /*uniqid(): identificador único por si quieran guardaar unaimagen con el mismo nombre */
    
    $ruta = '../img/usuario/'.$nombre; /*La imagen que subimos está en el bufer, no está guardada en la carpeta fisicamente del servidor */
    move_uploaded_file($_FILES['photo']['tmp_name'],$ruta);/*Pasa del bufer a una ubicación del servidor*/
    $usuario->cambiar_photo($id_usuario,$nombre);
    foreach ($usuario->objetos as $objeto) {
        /*unlink(); borra una imagen si le damos un url*/
        if ($objeto->avatar != 'default.png') {
            unlink('../img/usuario/'.$objeto->avatar); /*Borramos el resultado  del antiguo avatar */
        }
    }
    $json = array();

    $json[] = array(
        'ruta' => $ruta,
        'alert' => 'edit'
    );
    $jsonstring = json_encode($json[0]);
    echo $jsonstring;
        
}

/*===========================
CAMBIAR CONTRASEÑA DEL USUARIO
=============================*/
if ($_POST['funcion'] == 'cambiarcontra') { 
    $id_usuario = $_POST["id_usuario"];
    $oldpass=$_POST['oldpass'];
    $newpass=$_POST['newpass'];
    $usuario->cambiar_contra($id_usuario,$oldpass,$newpass);
}

/*===========================
MOSTRAR DATOS PARA EDITAR EL USUARIO
=============================*/
if ($_POST['funcion'] == 'capturar_datos') { 
    $json = array();
    $id_usuario = $_POST["id_usuario"];
    $usuario->obtener_datos($id_usuario);
    foreach ($usuario->objetos as $objeto) {

        $json[] = array(
            'telefono'=>$objeto->telefono_us,
            'residencia'=>$objeto->residencia_us,
            'correo'=>$objeto->corre_us,
            'sexo'=>$objeto->sexo_us,
            'adicional'=>$objeto->adicional_us
        );
    }
    $jsonstring = json_encode($json[0]);/*Como es un solo resultado de nuestra consulta emviamos en el indice 0 */
    echo $jsonstring;
}

/*===========================
GUARDAR LOS DATOS EDITADOS DEL USUARIO
=============================*/
if ($_POST['funcion'] == 'editar_usuario') { 
    $id_usuario = $_POST["id_usuario"];
    $telefono=$_POST['telefono'];
    $residencia=$_POST['residencia'];
    $correo=$_POST['correo'];
    $sexo=$_POST['sexo'];
    $adicional=$_POST['adicional'];
    $usuario->editar($id_usuario,$telefono,$residencia,$correo,$sexo,$adicional);
}
/*===========================
BUSCAR EN LA TABLA DE GESTIÓN USUARIOS
=============================*/
if ($_POST['funcion'] == 'buscar_usuarios_adm') {
    $json = array();
    $fecha_actual = new DateTime();
    $usuario->buscar();
    foreach ($usuario->objetos as $objeto) {
        $nacimiento = new DateTime($objeto->edad); 
        $edad = $nacimiento->diff($fecha_actual);
        $edad_years = $edad->y; 

        $json[] = array(
            'id'=>$objeto->id_usuario,
            'nombre'=>$objeto->nombre_us,
            'apellidos'=>$objeto->apellidos_us,
            'edad'=>$edad_years,
            'dni'=>$objeto->dni_us,
            'tipo'=>$objeto->nombre_tipo,
            'telefono'=>$objeto->telefono_us,
            'residencia'=>$objeto->residencia_us,
            'correo'=>$objeto->corre_us,
            'sexo'=>$objeto->sexo_us,
            'adicional'=>$objeto->adicional_us,
            'avatar'=>$objeto->avatar,
            'tipo_usuario'=>$objeto->us_tipo
        );
    }
    $jsonstring = json_encode($json);/*Va ver muchos usuarios */
    echo $jsonstring;
}
/*===========================
CREAR USUARIO
=============================*/
if ($_POST["funcion"] == 'crear_usuario') {
    
    $nombre=$_POST["nombre"];
    $apellido=$_POST["apellido"];
    $edad=$_POST["edad"];
    $dni=$_POST["dni"];
    $pass=$_POST["pass"];
    $tipo=2;
    $avatar='default.png';

    $usuario -> crear($nombre,$apellido,$edad,$dni,$pass,$tipo,$avatar);
}
/*===========================
ASCENDER
=============================*/
if ($_POST["funcion"]=='ascender') {
    $pass = $_POST["pass"];
    $id_ascendido = $_POST["id_usuario"];
    $usuario -> ascender($pass,$id_ascendido,$id_usuario);
}
/*===========================
DESCENDER
=============================*/
if ($_POST["funcion"]=='descender') {
    $pass = $_POST["pass"];
    $id_descendido = $_POST["id_usuario"];
    $usuario -> descender($pass,$id_descendido,$id_usuario);
}
/*===========================
BORRAR USUARIO
=============================*/
if ($_POST["funcion"]=='borrar-usuario') {
    $pass = $_POST["pass"];
    $id_borrado = $_POST["id_usuario"];
    $avatar = $_POST["avatar"];
    $usuario -> borrar($pass,$id_borrado,$id_usuario,$avatar);
}
/*===========================
PERMISO DE USUARIO
=============================*/
if ($_POST["funcion"]=='tipo_usuario') {
    echo $tipo_usuario;
}

