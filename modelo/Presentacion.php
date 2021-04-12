<?php
require_once 'Conexion.php';

class Presentacion{
    public $objetos;
    
    public function __construct(){
        $db = new Conexion();
        $this->acceso=$db->pdo;
    }
    /*============================
    BUSCAR PRESENTACION
    =============================*/
    function buscar(){
        if (!empty($_POST["consulta"])) {
            $consulta = $_POST["consulta"];
            $sql = "SELECT * FROM presentacion WHERE estado='A' AND  nombre LIKE :nombre";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(":nombre"=>"%$consulta%"));
            $this->objetos= $query->fetchall();
            return $this->objetos;
        }else{
            $sql = "SELECT * FROM presentacion WHERE estado='A' AND  nombre NOT LIKE '' ORDER BY id_presentacion   LIMIT 5";
            $query = $this->acceso->prepare($sql);
            $query->execute();
            $this->objetos= $query->fetchall();
            return $this->objetos;
        }
    }
    /*============================
    REGISTRAR PRESENTACION
    =============================*/
    function crear_presentacion($nombre){
        $sql = "SELECT * FROM presentacion WHERE nombre=:nombre";
        $query = $this->acceso->prepare($sql);
        $query -> execute(array(':nombre'=>$nombre));
        $this->objetos=$query->fetchall();
        if (!empty($this->objetos)) {

            foreach ($this->objetos as $pres) {
                $pres_id = $pres->id_presentacion ;
                $pres_estado = $pres->estado;
            }

            if ($pres_estado == 'A') {

                echo 'noadd';

            }else{

                $sql="UPDATE presentacion SET estado='A' WHERE id_presentacion=:id";
                $query = $this->acceso->prepare($sql);
                $query->execute(array(':id'=>$pres_id));
                echo 'add';
            }

        }else{
            $sql = "INSERT INTO presentacion(nombre) VALUES(:nombre)";
            $query = $this->acceso->prepare($sql);
            $query -> execute(array(':nombre'=>$nombre));
            echo 'add';
        }
    }
    /*============================
    EDITAR PRESENTACION
    =============================*/
    function editar_pres($nombre,$id_pres){
        $sql = "UPDATE presentacion SET nombre=:nombre WHERE id_presentacion=:id";
        $query = $this->acceso->prepare($sql);
        $query -> execute(array(':nombre'=>$nombre,':id'=>$id_pres));
        echo 'edit';
    }
    /*============================
    ELIMINAR PRESENTACION
    =============================*/
    function eliminar($id_pres){
        
        $sql = "SELECT * FROM producto WHERE prod_present=:id";
        $query=$this->acceso->prepare($sql); 
        $query->execute(array(":id"=>$id_pres));
        $pre=$query->fetchAll();
        if (!empty($pre)) {

            echo 'noremoved';

        }else{

            $sql = "UPDATE presentacion SET estado='I' WHERE id_presentacion = :id";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':id'=>$id_pres));

            if (!empty($query->execute(array(':id'=>$id_pres)))) {

                echo 'removed';

            }else{

                echo 'noremoved';

            }
        }











    }
    /*===========================
    RELLENAR CON DATOS EL SELECT 
    =============================*/
    function rellenar_presentacion(){
        $sql = "SELECT * FROM presentacion";
        $query=$this->acceso->prepare($sql);
        $query->execute();
        $this->objetos= $query->fetchall();
        return $this->objetos;
    }
}