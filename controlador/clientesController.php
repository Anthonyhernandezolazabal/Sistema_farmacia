<?php
include '../modelo/Clientes.php';
$clientes = new Cliente();

    /*============================
    LISTA CLIENTES
    =============================*/
    if ($_POST['funcion'] == 'listar_clientes') {
        $json = array();
        $fecha_actual = new DateTime();
        $clientes->buscar();
        foreach ($clientes->objetos as $objeto) {
            $nacimiento = new DateTime($objeto->edad); 
            $edad = $nacimiento->diff($fecha_actual);
            $edad_years = $edad->y; 
    
            $json[] = array(
                'id'=>$objeto->id,
                'nombre'=>$objeto->nombre,
                'apellidos'=>$objeto->apellidos,
                'dni'=>$objeto->dni,
                'edad'=>$edad_years,
                'telefono'=>$objeto->telefono,
                'correo'=>$objeto->correo,
                'sexo'=>$objeto->sexo,
                'adicional'=>$objeto->adicional,
                'avatar'=>$objeto->avatar,
                'registrado'=>$objeto->registrado
            );
        }
        $jsonstring = json_encode($json);/*Va ver muchos usuarios */
        echo $jsonstring;
    }
    /*===========================
    REGISTRAR CLIENTES 
    =============================*/
    if ($_POST["funcion"] == 'registrar_nuevo_cliente') {
        $nombre= $_POST["nombre"];
        $apellidos= $_POST["apellidos"];
        $dni= $_POST["dni"];
        $telefono= $_POST["telefono"];
        $email= $_POST["email"];
        $nacimiento= $_POST["nacimiento"];
        $sexo= $_POST["sexo"];
        $adicional= $_POST["adicional"];
        $avatar = 'userdefault.png';
        $clientes -> crear($nombre,$apellidos,$dni,$telefono,$email,$nacimiento,$sexo,$adicional,$avatar);
    }
    /*===========================
    EDITAR CLIENTES 
    =============================*/
    if ($_POST["funcion"] == 'editar_nuevo_cliente') {
        $telefono= $_POST["telefono"];
        $email= $_POST["email"];
        $adicional= $_POST["adicional"];
        $id= $_POST["id"];
        $clientes -> editar($telefono,$email,$adicional,$id);
    }
    /*===========================
    ELIMINAR CLIENTE 
    =============================*/
    if($_POST["funcion"]=='borrar_cliente'){
        $id = $_POST["id"];
        $clientes->borrar($id);
    }
    /*===========================
    RELLENAR CLIENTE 
    =============================*/
    if($_POST["funcion"]=='rellenar_cliente'){
        $clientes->rellenar_cliente();
        $json = array();
        foreach ($clientes->objetos as $objeto) {
            
            $json[]=array(
                'id'=>$objeto->id,
                'nombre'=>$objeto->nombre.' '.$objeto->apellidos
            );
        }
        $jsonstring = json_encode($json);/*Va ver muchos usuarios */
        echo $jsonstring;
    }


    if($_POST["funcion"]=='buscar_dato_cliente_dni'){
        $dni = $_POST['dni'];
        $clientes->buscar_dato_cliente_dni($dni);
        $json = array();

        if (!empty($clientes->objetos)) {

            foreach ($clientes->objetos as $objeto) {
                
                $json[] = array(
                    'datos'=>$objeto,
                    'id'=>$objeto->id,
                    'nombre'=>$objeto->nombre.' '.$objeto->apellidos
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

