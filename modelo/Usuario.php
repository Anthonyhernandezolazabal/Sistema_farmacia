<?php
include_once 'Conexion.php';
class Usuario{
    
    var $objetos;

    public function __construct(){
        $db = new Conexion(); /*crea una nueva conexion */
        $this->acceso = $db->pdo;/*asigna acceso , variable del propio modelo y le asignamos el pd */
    }

    /* ===== LOGUEARSE ===== */
    // function Loguearse($user,$pass){

    //     $sql="SELECT * FROM usuario INNER JOIN tipo_us on us_tipo=id_tipo_us WHERE dni_us=:dni AND contrasena_us=:pass";
    //     $query = $this->acceso->prepare($sql);
    //     $query->execute(array(':dni'=>$user,':pass'=>$pass));
    //     $this->objetos= $query->fetchall();
    //     return $this->objetos;
    // }
    function Loguearse($user,$pass){

        $sql="SELECT * FROM usuario INNER JOIN tipo_us on us_tipo=id_tipo_us WHERE dni_us=:dni";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':dni'=>$user));
        $objetos= $query->fetchall();

        if (!empty($objetos)) {
            foreach ($objetos as $objeto) {
                $contrasena_actual = $objeto->contrasena_us;
            }
            //Verificamos si esta encriptada
            if (strpos($contrasena_actual,'$2y$10$') === 0) {
                    
                if (password_verify($pass,$contrasena_actual)) {

                    return 'logueado';

                }

            }else{

                if ($pass==$contrasena_actual) {

                    return 'logueado';

                }

            }

        }
          
        
    }
    /*===========================
    OBTENER DATOS DE LOGUEO
    =============================*/
    function obtener_dato_logueado($dni){
        $sql="SELECT * FROM usuario INNER JOIN tipo_us on us_tipo=id_tipo_us WHERE dni_us=:dni";
        $query = $this->acceso->prepare($sql);
        $query -> execute(array(':dni'=>$dni));
        $this->objetos=$query->fetchAll();
        return $this->objetos;
    }
    /*===========================
    MOSTRAR DATOS DEL USUARIO
    =============================*/
    function obtener_datos($id){
        $sql="SELECT * FROM usuario INNER JOIN tipo_us on us_tipo=id_tipo_us WHERE id_usuario=:id";
        $query = $this->acceso->prepare($sql);
        $query -> execute(array(':id'=>$id));
        $this->objetos=$query->fetchAll();
        return $this->objetos;
    }
    /*===========================
    CAMBIAR AVATAR
    =============================*/
    function cambiar_photo($id_usuario,$nombre){
        $sql ="SELECT avatar FROM usuario WHERE id_usuario=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id_usuario));
        $this->objetos=$query->fetchAll();

        $sql ="UPDATE usuario SET avatar=:nombre WHERE id_usuario=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id_usuario,':nombre'=>$nombre));

        return $this->objetos;
        
    }
    /*===========================
    CAMBIAR CONTRASEÑA DEL USUARIO
    =============================*/
    // function cambiar_contra($id_usuario,$oldpass,$newpass){
    //     $sql ="SELECT * FROM usuario where id_usuario=:id AND contrasena_us=:oldpass ";
    //     $query = $this->acceso->prepare($sql);
    //     $query->execute(array(':id'=>$id_usuario,':oldpass'=>$oldpass));
    //     $this->objetos=$query->fetchAll();
    //     if (!empty($this->objetos)) { /*Si esque encuentra a ese usuario con esa contraseña */
    //         $sql ="UPDATE usuario SET contrasena_us=:newpass WHERE id_usuario=:id";
    //         $query = $this->acceso->prepare($sql);
    //         $query->execute(array(':id'=>$id_usuario,':newpass'=>$newpass));
    //         echo 'update';
    //     }else{
    //         echo 'noupdate';
    //     }
    // }
    function cambiar_contra($id_usuario,$oldpass,$newpass){
        $sql ="SELECT * FROM usuario where id_usuario=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id_usuario));
        $this->objetos=$query->fetchAll();

        foreach ($this->objetos as $objeto) {
            $contrasena_actual = $objeto->contrasena_us;
        }

        //Verificamos si esta encriptada
        if (strpos($contrasena_actual,'$2y$10$') === 0) {
            
            if (password_verify($oldpass,$contrasena_actual)) {
                $pass = password_hash($newpass,PASSWORD_BCRYPT,['cost'=>10]);
                $sql ="UPDATE usuario SET contrasena_us=:newpass WHERE id_usuario=:id";
                $query = $this->acceso->prepare($sql);
                $query->execute(array(':id'=>$id_usuario,':newpass'=>$pass));
                echo 'update';
            }else{
                echo 'noupdate';
            }

        }else{

            if ($oldpass==$contrasena_actual) {
                $pass = password_hash($newpass,PASSWORD_BCRYPT,['cost'=>10]);
                $sql ="UPDATE usuario SET contrasena_us=:newpass WHERE id_usuario=:id";
                $query = $this->acceso->prepare($sql);
                $query->execute(array(':id'=>$id_usuario,':newpass'=>$pass));
                echo 'update';
            }else{
                echo 'noupdate';
            }

        }

    }
    /*===========================
    GUARDAR LOS DATOS EDITADOS DEL USUARIO
    =============================*/
    function editar($id_usuario,$telefono,$residencia,$correo,$sexo,$adicional){
        $sql ="UPDATE usuario SET telefono_us=:telefono,residencia_us=:residencia,corre_us=:corre,sexo_us=:sexo,adicional_us=:adicional WHERE id_usuario=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id_usuario,':telefono'=>$telefono,':residencia'=>$residencia,':corre'=>$correo,':sexo'=>$sexo,':adicional'=>$adicional));
        echo 'editado';
    }

    /*===========================
    BUSCAR EN LA TABLA DE GESTIÓN USUARIOS
    =============================*/
    function buscar(){
        if(!empty($_POST["consulta"])){
            $consulta = $_POST["consulta"];
            $sql = "SELECT * FROM usuario INNER JOIN tipo_us ON us_tipo=id_tipo_us WHERE nombre_us LIKE :consulta";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':consulta'=>"%$consulta%"));
            $this->objetos=$query->fetchAll();
            return $this->objetos;
        }else{
            $sql = "SELECT * FROM usuario INNER JOIN tipo_us ON us_tipo=id_tipo_us WHERE nombre_us NOT LIKE '' ORDER BY id_usuario LIMIT 25"; /*para que me muestre a todo los primeros 25 usuarios */
            $query = $this->acceso->prepare($sql);
            $query->execute();
            $this->objetos=$query->fetchAll();
            return $this->objetos;
        }
    }

    /*===========================
    CREAR USUARIO
    =============================*/
    function crear($nombre,$apellido,$edad,$dni,$pass,$tipo,$avatar){
        $sql = "SELECT id_usuario FROM usuario WHERE dni_us=:dni";
        $query = $this->acceso->prepare($sql);
        $query -> execute(array(":dni"=>$dni));
        $this->objetos=$query->fetchAll();
        if (!empty($this->objetos)) {
            
            echo 'noadd';
        }else{

            $sql='INSERT INTO usuario(nombre_us, apellidos_us, edad, dni_us, contrasena_us, avatar, us_tipo) VALUES (:nombre,:apellidos,:edad,:dni,:pass,:avatar,:tipo)';
            $query = $this->acceso->prepare($sql);
            $query -> execute(array(":nombre"=>$nombre,":apellidos"=>$apellido,":edad"=>$edad,":dni"=>$dni,":pass"=>$pass,":avatar"=>$avatar,":tipo"=>$tipo));
            echo 'add';
        }
    }
    /*===========================
    ASCENDER
    =============================*/
    function ascender($pass,$id_ascendido,$id_usuario){

        $sql = "SELECT * FROM usuario WHERE id_usuario=:id_usuario";
        $query = $this->acceso->prepare($sql);
        $query -> execute(array(":id_usuario"=>$id_usuario));
        $this->objetos=$query->fetchAll();
        foreach ($this->objetos as $objeto) {
            $contrasena_actual = $objeto->contrasena_us;
        }

        //Verificamos si esta encriptada
        if (strpos($contrasena_actual,'$2y$10$') === 0) {
            
            if (password_verify($pass,$contrasena_actual)) {

                $tipo=1;
                $sql = "UPDATE usuario SET us_tipo=:tipo WHERE id_usuario=:id";
                $query = $this->acceso->prepare($sql);
                $query -> execute(array(":tipo"=>$tipo,':id'=>$id_ascendido));
                echo 'ascendido';

            }else{

                echo 'noascendido';
    
            }

        }else{

            if ($pass==$contrasena_actual) {

                $tipo=1;
                $sql = "UPDATE usuario SET us_tipo=:tipo WHERE id_usuario=:id";
                $query = $this->acceso->prepare($sql);
                $query -> execute(array(":tipo"=>$tipo,':id'=>$id_ascendido));
                echo 'ascendido';

            }else{

                echo 'noascendido';
    
            }

        }

    } 
    /*===========================
    DESCENDER
    =============================*/
    function descender($pass,$id_descendido,$id_usuario){

        $sql = "SELECT * FROM usuario WHERE id_usuario=:id_usuario";
        $query = $this->acceso->prepare($sql);
        $query -> execute(array(":id_usuario"=>$id_usuario));
        $this->objetos=$query->fetchAll();
        foreach ($this->objetos as $objeto) {
            $contrasena_actual = $objeto->contrasena_us;
        }

        //Verificamos si esta encriptada
        if (strpos($contrasena_actual,'$2y$10$') === 0) {
            
            if (password_verify($pass,$contrasena_actual)) {

                $tipo=2;
                $sql = "UPDATE usuario SET us_tipo=:tipo WHERE id_usuario=:id";
                $query = $this->acceso->prepare($sql);
                $query -> execute(array(":tipo"=>$tipo,':id'=>$id_descendido));
                echo 'descendido';

            }else{

                echo 'nodescendido';
    
            }

        }else{

            if ($pass==$contrasena_actual) {

                $tipo=2;
                $sql = "UPDATE usuario SET us_tipo=:tipo WHERE id_usuario=:id";
                $query = $this->acceso->prepare($sql);
                $query -> execute(array(":tipo"=>$tipo,':id'=>$id_descendido));
                echo 'descendido';

            }else{

                echo 'nodescendido';
    
            }

        }

    }
   
    /*===========================
    BORRAR USUARIO
    =============================*/
    function borrar($pass,$id_borrado,$id_usuario,$avatar){
        $sql = "SELECT * FROM usuario WHERE id_usuario=:id_usuario";
        $query = $this->acceso->prepare($sql);
        $query -> execute(array(":id_usuario"=>$id_usuario));
        $this->objetos=$query->fetchAll();
        foreach ($this->objetos as $objeto) {
            $contrasena_actual = $objeto->contrasena_us;
        }

        //Verificamos si esta encriptada
        if (strpos($contrasena_actual,'$2y$10$') === 0) {
            
            if (password_verify($pass,$contrasena_actual)) {

                $sql = "DELETE FROM usuario WHERE id_usuario=:id";
                $query = $this->acceso->prepare($sql);
                $query -> execute(array(':id'=>$id_borrado));
                echo 'borrado';
                if ($avatar != 'default.png') {
                    unlink('../img/usuario/'.$avatar);
                }

            }else{

                echo 'noborrado';
    
            }

        }else{

            if ($pass==$contrasena_actual) {

                $sql = "DELETE FROM usuario WHERE id_usuario=:id";
                $query = $this->acceso->prepare($sql);
                $query -> execute(array(':id'=>$id_borrado));
                echo 'borrado';
                if ($avatar != 'default.png') {
                    unlink('../img/usuario/'.$avatar);
                }

            }else{

                echo 'noborrado';
    
            }

        }

    }
    /*===========================
    RECUPERAR CONTRASEÑA
    =============================*/
    function verificar($email,$dni){
        $sql ="SELECT * FROM usuario WHERE corre_us=:email AND dni_us=:dni";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':email'=>$email,':dni'=>$dni));
        $this->objetos=$query->fetchAll();
        if (!empty($this->objetos)) {
            /* VERIFICAR QUE NO HAYA DOS USUARIOS CON EL MISMO DNI Y CORREO */
            if ($query->rowCount()) { //Cantidad de registro que nos esta enviando
                echo 'encontrado';
            }else{
                echo 'noencontrado';
            }
        }else{
            echo 'noencontrado';
        }
    }
    /*===========================
    ENVIAR CODIGO CONTRASEÑA
    =============================*/
    function reemplazar($codigo,$email,$dni){
        $sql ="UPDATE usuario SET contrasena_us=:codigo WHERE corre_us=:email AND dni_us=:dni";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':email'=>$email,':dni'=>$dni,':codigo'=>$codigo));
    }
}