<?php
require_once 'Conexion.php';
class Cliente{
    public $objetos;
    public function __construct(){
        $db = new Conexion();
        $this->acceso=$db->pdo;
    }

    /*===========================
    BUSCAR VENTA
    =============================*/
    function buscar(){
        if (!empty($_POST["consulta"])) {
            $consulta = $_POST["consulta"];
            $sql = "SELECT * FROM clientes WHERE estado='A' AND nombre LIKE :nombre";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(":nombre"=>"%$consulta%"));
            $this->objetos= $query->fetchall();
            return $this->objetos;
        }else{
            $sql = "SELECT * FROM clientes WHERE estado='A' AND  nombre NOT LIKE '' ORDER BY id LIMIT 10";
            $query = $this->acceso->prepare($sql);
            $query->execute();
            $this->objetos= $query->fetchall();
            return $this->objetos;
        }
    }
    /*===========================
    REGISTRAR PROVEEDOR 
    =============================*/
    function crear($nombre,$apellidos,$dni,$telefono,$email,$nacimiento,$sexo,$adicional,$avatar){
        $sql = "SELECT id ,estado FROM clientes WHERE nombre=:nombre AND apellidos=:apellidos AND dni=:dni";
        $query = $this->acceso->prepare($sql);
        $query -> execute(array(':nombre'=>$nombre,':apellidos'=>$apellidos,':dni'=>$dni));
        $this->objetos=$query->fetchAll();
        if (!empty($this->objetos)) {

            foreach ($this->objetos as $cli) {
                $cli_id = $cli->id;
                $cli_estado = $cli->estado;
            }
            

            if ($cli_estado == 'A') {

                echo 'noadd'; //Esta registrado

            }else{

                $sql="UPDATE clientes SET estado='A', avatar=:avatar WHERE id=:id";
                $query = $this->acceso->prepare($sql);
                $query->execute(array(':id'=>$cli_id,':avatar'=>$avatar));
                echo 'modif_estado';
            }

        }else{

            $sql = 'SELECT estado FROM clientes WHERE dni = :dni';
            $query = $this->acceso->prepare($sql);
            $query -> execute(array(':dni'=>$dni));
            $verificar_dni=$query->fetchAll();
            if (!empty($verificar_dni)) {

                foreach ($verificar_dni as $cli_dni2) {
                    $clt_estado = $cli_dni2->estado;
                }

                if ($clt_estado == 'A') {

                    echo 'noadd'; //Esta registrado
    
                }else{
                
                    $sql="UPDATE clientes SET nombre=:nombre,apellidos=:apellidos,edad=:edad,telefono=:telefono,correo=:email,sexo=:sexo,adicional=:adicional, estado='A', avatar=:avatar WHERE dni=:dni";
                    $query = $this->acceso->prepare($sql);
                    $query -> execute(array(':nombre'=>$nombre,':apellidos'=>$apellidos,':dni'=>$dni,':edad'=>$nacimiento,':telefono'=>$telefono,':email'=>$email,':sexo'=>$sexo,':adicional'=>$adicional,':avatar'=>$avatar));    
                    echo 'modif';
                }

            }else{

                $sql = "INSERT INTO clientes(nombre, apellidos, dni, edad, telefono, correo, sexo, adicional, avatar) VALUES (:nombre, :apellidos, :dni, :edad, :telefono, :correo, :sexo, :adicional, :avatar)";
                $query = $this->acceso->prepare($sql);
                $query -> execute(array(':nombre'=>$nombre,':apellidos'=>$apellidos,':dni'=>$dni,':edad'=>$nacimiento,':telefono'=>$telefono,':correo'=>$email,':sexo'=>$sexo,':adicional'=>$adicional,':avatar'=>$avatar));    
                echo 'add';
            }
        }
    }
    
    /*===========================
    EDITAR CLIENTES 
    =============================*/
    function editar($telefono,$email,$adicional,$id){
        $sql = "SELECT id FROM clientes WHERE id=:id";
        $query = $this->acceso->prepare($sql);
        $query -> execute(array(':id'=>$id));
        $this->objetos=$query->fetchAll();

        if (empty($this->objetos)) {

            echo 'noedit';

        }else{
            $sql = "UPDATE clientes SET telefono=:telefono, correo=:correo, adicional=:adicional WHERE id=:id";
            $query = $this->acceso->prepare($sql);
            $query -> execute(array(':telefono'=>$telefono,':correo'=>$email,':adicional'=>$adicional,':id'=>$id));
            echo 'edit';
        }
    }
   
    /*===========================
    ELIMINAR CLIENTES 
    =============================*/
    function borrar($id){
        $sql = "UPDATE clientes SET estado='I' WHERE id=:id";
        $query=$this->acceso->prepare($sql);
        $query->execute(array(":id"=>$id));

        if (!empty($query->execute(array(":id"=>$id)))) {
            echo 'borrado';
        }else{
            echo 'noborrado';
        }
    }
    /*===========================
    RELLENAR CLIENTE 
    =============================*/
    function rellenar_cliente(){
        $sql = "SELECT * FROM clientes WHERE estado='A' order by nombre ASC";
        $query=$this->acceso->prepare($sql);
        $query->execute();
        $this->objetos=$query->fetchAll();
        return $this->objetos;
        
    }
    /*===========================
    BUSCAR CLIENTE DNI 
    =============================*/
    function buscar_dato_cliente_dni($dni){
        $sql = "SELECT * FROM clientes WHERE estado='A' AND dni=:dni";
        $query=$this->acceso->prepare($sql);
        $query->execute(array(":dni"=>$dni));
        $this->objetos=$query->fetchAll();
        return $this->objetos;
    }
    /*===========================
    BUSCAR CLIENTE ID
    =============================*/
    function buscar_dato_cliente($id){
        $sql = "SELECT * FROM clientes WHERE id=:id";
        $query=$this->acceso->prepare($sql);
        $query->execute(array(":id"=>$id));
        $this->objetos=$query->fetchAll();
        return $this->objetos;
    }
}