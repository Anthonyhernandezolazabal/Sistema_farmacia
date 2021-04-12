<?php
include 'Conexion.php';
class Laboratorio{

    var $objetos;

    public function __construct(){ /*Para que al momento de instanciar la clase laboratorio automaticamente llame a la conexion pdo */
        $db = new Conexion();
        $this->acceso=$db->pdo;/*Con esto cada vez que nosotros instanciamos un objeto de la clase laboratorio automaticamente ya obtenemos la conexion pdo*/
    }
    /*============================
    CREAR LABORATORIO
    =============================*/
    function crear($nombre,$avatar){
        $sql = "SELECT id_laboratorio,estado FROM laboratorio WHERE nombre =:nombre";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(":nombre"=>$nombre));
        $this->objetos= $query->fetchall();
        /*Comprobar si hay otro laboratorio con el mismo nombre */
        if (!empty($this->objetos)) {


            foreach ($this->objetos as $lab) {
                $lab_id = $lab->id_laboratorio;
                $lab_estado = $lab->estado;
            }

            if ($lab_estado == 'A') {

                echo 'noadd';

            }else{

                $sql="UPDATE laboratorio SET estado='A' WHERE id_laboratorio=:id";
                $query = $this->acceso->prepare($sql);
                $query->execute(array(':id'=>$lab_id));
                echo 'add';
            }

        }else{
                $sql = "INSERT INTO laboratorio(nombre, avatar) VALUES (:nombre,:avatar)";
                $query = $this->acceso->prepare($sql);
                $query->execute(array(":nombre"=>$nombre,":avatar"=>$avatar));
                echo 'add';
        }      
    }
    /*============================
    EDITAR LABORATORIO
    =============================*/
    function editar($id_editado,$nombre){
        $sql = "UPDATE laboratorio SET nombre=:nombre WHERE id_laboratorio=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(":id"=>$id_editado,":nombre"=>$nombre));
        echo 'edit';
    }
    /*============================
    BUSCAR LABORATORIO
    =============================*/
    function buscar(){
        if (!empty($_POST["consulta"])) {
            $consulta = $_POST["consulta"];
            $sql = "SELECT * FROM laboratorio WHERE estado='A' AND nombre LIKE :nombre";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(":nombre"=>"%$consulta%"));
            $this->objetos= $query->fetchall();
            return $this->objetos;
        }else{
            $sql = "SELECT * FROM laboratorio WHERE estado='A' AND  nombre NOT LIKE '' ORDER BY id_laboratorio LIMIT 5";
            $query = $this->acceso->prepare($sql);
            $query->execute();
            $this->objetos= $query->fetchall();
            return $this->objetos;
        }
    }
    /*============================
    CABIAR AVATAR
    =============================*/
    function cambiar_logo($id_logo,$nombre){
        $sql = "SELECT avatar FROM laboratorio WHERE id_laboratorio=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(":id"=>$id_logo));
        $this->objetos= $query->fetchall();
        
        $sql = "UPDATE laboratorio SET avatar=:nombre WHERE id_laboratorio=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(":id"=>$id_logo,":nombre"=>$nombre));
        return $this->objetos;
    }
    /*============================
    BORRAR LABORATORIO
    =============================*/
    function borrar($id,$avatar){

        $avatar_def = 'lab_default.jpg';
        $sql = "SELECT * FROM producto WHERE prod_lab=:id";
        $query=$this->acceso->prepare($sql); 
        $query->execute(array(":id"=>$id));
        $prod=$query->fetchAll();
        if (!empty($prod)) {

            echo 'noborrado';

        }else{

            $sql = 'UPDATE laboratorio SET estado="I", avatar=:avatar WHERE id_laboratorio=:id';
            $query = $this->acceso->prepare($sql);
            $query->execute(array(":id"=>$id,":avatar"=>$avatar_def));

            if (!empty($query->execute(array(":id"=>$id,":avatar"=>$avatar_def)))) {

                echo 'borrado';

            
                if ($avatar !='lab_default.jpg') {
                    unlink('../img/lab/'.$avatar);
                }

            }else{

                echo 'noborrado';
                
            }

        }

        
    }
    /*===========================
    RELLENAR CON DATOS EL SELECT 
    =============================*/
    function rellenar_laboratorio(){
        $sql = "SELECT * FROM laboratorio";
        $query=$this->acceso->prepare($sql);
        $query->execute();
        $this->objetos= $query->fetchall();
        return $this->objetos;
    }


}