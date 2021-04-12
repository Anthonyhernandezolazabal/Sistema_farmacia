<?php
require_once 'Conexion.php';
class Proveedor{
    public $objetos;
    public function __construct(){
        $db = new Conexion();
        $this->acceso = $db->pdo;
    }
    /*===========================
    REGISTRAR PROVEEDOR 
    =============================*/
    function crear($nombre,$telefono,$correo,$direccion,$avatar){
        $sql = "SELECT id_proveedor,estado FROM proveedor WHERE nombre=:nombre AND telefono=:telefono AND correo=:correo AND direccion=:direccion";
        $query = $this->acceso->prepare($sql);
        $query -> execute(array(':nombre'=>$nombre,':telefono'=>$telefono,':correo'=>$correo,':direccion'=>$direccion));
        $this->objetos=$query->fetchAll();
        if (!empty($this->objetos)) {

            foreach ($this->objetos as $prov) {
                $prov_id = $prov->id_proveedor;
                $prov_estado = $prov->estado;
            }

            if ($prov_estado == 'A') {

                echo 'noadd';

            }else{

                $sql="UPDATE proveedor SET estado='A', avatar='prov_default.png' WHERE id_proveedor=:id";
                $query = $this->acceso->prepare($sql);
                $query->execute(array(':id'=>$prov_id));
                echo 'add';
            }

        }else{
            $sql = "INSERT INTO proveedor(nombre, telefono, correo, direccion, avatar) VALUES (:nombre, :telefono, :correo, :direccion, :avatar)";
            $query = $this->acceso->prepare($sql);
            $query -> execute(array(':nombre'=>$nombre,':telefono'=>$telefono,':correo'=>$correo,':direccion'=>$direccion,':avatar'=>$avatar));    
            echo 'add';
        }
    }
    /*===========================
    EDITAR PROVEEDOR 
    =============================*/
    function editar($nombre,$telefono,$correo,$direccion,$id){
        $sql = "SELECT id_proveedor FROM proveedor WHERE id_proveedor!=:id AND nombre=:nombre";
        $query = $this->acceso->prepare($sql);
        $query -> execute(array(':nombre'=>$nombre,':id'=>$id));
        $this->objetos=$query->fetchAll();
        if (!empty($this->objetos)) {
            echo 'noedit';
        }else{
            $sql = "UPDATE proveedor SET nombre=:nombre, telefono=:telefono, correo=:correo, direccion=:direccion WHERE id_proveedor=:id";
            $query = $this->acceso->prepare($sql);
            $query -> execute(array(':nombre'=>$nombre,':telefono'=>$telefono,':correo'=>$correo,':direccion'=>$direccion,':id'=>$id));
            echo 'edit';
        }
    }
    /*===========================
    BUSCAR PROVEEDOR 
    =============================*/
    function buscar(){
        if (!empty($_POST["consulta"])) {
            $consulta = $_POST["consulta"];
            $sql = "SELECT * FROM proveedor WHERE estado='A' AND nombre LIKE :consulta ";
            $query = $this->acceso->prepare($sql);
            $query -> execute(array(':consulta'=>"%$consulta%"));
            $this->objetos=$query->fetchAll();
            return $this->objetos;
        }else{
            $sql = "SELECT * FROM proveedor WHERE estado='A' AND nombre NOT LIKE '' ORDER BY id_proveedor DESC LIMIT 25";
            $query = $this->acceso->prepare($sql);
            $query -> execute();
            $this->objetos=$query->fetchAll();
            return $this->objetos;
        }
    }
    /*===========================
    CAMBIAR LOGO PROVEEDOR 
    =============================*/
    function cambiar_avatar($id,$nombre){
        $sql = "SELECT avatar FROM proveedor WHERE id_proveedor=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(":id"=>$id));
        $this->objetos= $query->fetchall();

        $sql = "UPDATE proveedor SET avatar=:nombre WHERE id_proveedor=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id,':nombre'=>$nombre));
        return $this->objetos;
    }
    /*===========================
    ELIMINAR PROVEEDOR 
    =============================*/
    function borrar($id,$avatar){
            #ELIMINACION FISICA        
        // $sql = "SELECT * FROM lote WHERE lote_id_prov=:id";
        // $query=$this->acceso->prepare($sql);
        // $query->execute(array(":id"=>$id));
        // $lote=$query->fetchAll();
        // if (!empty($lote)) {

        //     echo 'noborrado';
        // }else{

        //     $sql = "UPDATE proveedor SET estado='I',avatar='prov_default.png' WHERE id_proveedor = :id";
        //     $query=$this->acceso->prepare($sql);
        //     $query->execute(array(":id"=>$id));
        //     if (!empty($query->execute(array(":id"=>$id)))) { /*quiere decir que va a mostrar un mensaje que ya borró en la bd */
        //         echo 'borrado';
        //         if ($avatar != 'prov_default.png') {
        //             unlink('../img/prov/'.$avatar);
        //         }
        //     }else{
        //         echo 'noborrado';
        //     }

        // }

        #ELIMINACION LOGICA

        $sql = "UPDATE proveedor SET estado='I',avatar='prov_default.png' WHERE id_proveedor = :id";
        $query=$this->acceso->prepare($sql);
        $query->execute(array(":id"=>$id));
        if (!empty($query->execute(array(":id"=>$id)))) { /*quiere decir que va a mostrar un mensaje que ya borró en la bd */
            echo 'borrado';
            if ($avatar != 'prov_default.png') {
                unlink('../img/prov/'.$avatar);
            }
        }else{
            echo 'noborrado';
        }
        
    }
    /*===========================
    RELLENAR PROVEEDOR EN EL LOTE
    =============================*/
    function rellenar_proveedor(){
        $sql = 'SELECT * FROM proveedor WHERE estado="A" ORDER BY nombre ASC';
        $query=$this->acceso->prepare($sql);
        $query->execute();
        $this->objetos= $query->fetchall();
        return $this->objetos;
    }
}