<?php
require_once 'Conexion.php';
class Tipo{
    public $objetos;
    public function __construct(){
        $db = new Conexion();
        $this->acceso = $db->pdo;
    }

    /*============================
    BUSCAR TIPO
    =============================*/
    function buscar(){
        if (!empty($_POST["consulta"])) {
            $consulta = $_POST["consulta"];
            $sql = "SELECT * FROM tipo_producto WHERE estado='A' AND  nombre LIKE :nombre";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(":nombre"=>"%$consulta%"));
            $this->objetos= $query->fetchall();
            return $this->objetos;
        }else{
            $sql = "SELECT * FROM tipo_producto WHERE estado='A' AND  nombre NOT LIKE '' ORDER BY id_tip_prod LIMIT 5";
            $query = $this->acceso->prepare($sql);
            $query->execute();
            $this->objetos= $query->fetchall();
            return $this->objetos;
        }
    }
    /*============================
    REGISTRAR TIPO
    =============================*/
    function crear_tipo($nombre){
        $sql = "SELECT * FROM tipo_producto WHERE nombre=:nombre";
        $query = $this->acceso->prepare($sql);
        $query -> execute(array(':nombre'=>$nombre));
        $this->objetos=$query->fetchall();
        if (!empty($this->objetos)) {

            foreach ($this->objetos as $tip) {
                $tip_id = $tip->id_tip_prod ;
                $tip_estado = $tip->estado;
            }

            if ($tip_estado == 'A') {

                echo 'noadd';

            }else{

                $sql="UPDATE tipo_producto SET estado='A' WHERE id_tip_prod=:id";
                $query = $this->acceso->prepare($sql);
                $query->execute(array(':id'=>$tip_id));
                echo 'add';
            }

        }else{
            $sql = "INSERT INTO tipo_producto(nombre) VALUES(:nombre)";
            $query = $this->acceso->prepare($sql);
            $query -> execute(array(':nombre'=>$nombre));
            echo 'add';
        }
    }
    /*============================
    EDITAR TIPO
    =============================*/
    function editar_tipo($nombre,$tipo_id){
        $sql = "UPDATE tipo_producto SET nombre=:nombre WHERE id_tip_prod= :id";
        $query = $this->acceso->prepare($sql);
        $query -> execute(array(':nombre'=>$nombre,':id'=>$tipo_id));
        echo 'edit';
    }

    /*============================
    ELIMINAR TIPO
    =============================*/
    function eliminar($id_tipo){

        $sql = "SELECT * FROM producto WHERE prod_tip_prod=:id";
        $query=$this->acceso->prepare($sql); 
        $query->execute(array(":id"=>$id_tipo));
        $tip=$query->fetchAll();
        if (!empty($tip)) {

            echo 'noremoved';

        }else{

            $sql = "UPDATE tipo_producto SET estado='I' WHERE id_tip_prod = :id";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':id'=>$id_tipo));
            if (!empty($query->execute(array(':id'=>$id_tipo)))) {
                echo 'removed';
            }else{
                echo 'noremoved';
            }
        }










        
    }
    /*===========================
    RELLENAR CON DATOS EL SELECT 
    =============================*/
    function rellenar_tipo(){
        $sql = "SELECT * FROM tipo_producto";
        $query=$this->acceso->prepare($sql);
        $query->execute();
        $this->objetos= $query->fetchall();
        return $this->objetos;
    }


}