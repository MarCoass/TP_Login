<?php
include_once ('conector/BaseDatos.php1');

class Rol{

    private $idrol;
    private $descripcion;
    private $mensaje;

    public function __construct()
    {
        $idrol = '';
        $descripcion = '';
    }

    public function cargar($id, $descripcion){
        $idrol = $id;
        $descripcion = $descripcion;
        
    }

    public function getIdrol(){
        return $this->idrol;
    }

    public function setIdrol($idrol){
        $this->idrol = $idrol;
    }

    public function getDescripcion(){
        return $this->descripcion;
    }

    public function setDescripcion($descripcion){
        $this->descripcion = $descripcion;
    }

    
    public function getMensaje(){
        return $this->mensaje;
    }

    public function setMensaje($mensaje){
        $this->mensaje = $mensaje;
    }


    public function __toString()
    {
        return "ID: " . $this->getIdrol() . "
        Descripcion: " . $this->getDescripcion() ;
    }

    //FUNCIONES DE BASE DE DATOS

    //BUSCAR
    public function buscar($idrol)
    {
        $base = new BaseDatos();
        $resp = false;
        $sql = "SELECT * FROM rol WHERE idrol = '" . $idrol . "'";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                if ($row2 = $base->Registro()) {
                    $this->setIdrol($row2['idrol']);
                    $this->setDescripcion($row2['descripcion']);
                    
                    $resp = true;
                }
            } else {
                $this->setMensaje($base->getError());
            }
        } else {
            $this->setMensaje($base->getError());
        }
        return $resp;
    }

    //LISTAR
    public function listar($condicion = '')
    {
        $array = null;
        $base = new BaseDatos();
        $sql =  "select * from rol";
        if ($condicion != '') {
            $sql = $sql . ' where ' . $condicion;
        }
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $array = array();
                while ($row2 = $base->Registro()) {
                    $objrol = new rol();
                    $objrol->buscar($row2['idrol']);
                    $array[] = $objrol;
                }
            } else {
                $this->setMensaje($base->getError());
            }
        } else {
            $this->setMensaje($base->getError());
        }
        return $array;
    }

    //INSERTAR
    public function insertar()
    {
        $base = new BaseDatos();
        $resp = false;
        //Asigno los datos a variables
        $idrol = $this->getIdrol();
        $descripcion = $this->getdescripcion();
        
        //Creo la consulta 
        $sql = "INSERT INTO rol (idrol, descripcion) VALUES ('{$idrol}', '{$descripcion}')";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setMensaje($base->getError());
            }
        } else {
            $this->setMensaje($base->getError());
        }
        return $resp;
    }

    //MODIFICAR
    public function modificar()
    {
        $base = new BaseDatos();
        $resp = false;
        $idrol = $this->getIdrol();
        $descripcion = $this->getdescripcion();
        
        $sql = "UPDATE rol SET descripcion = '{$descripcion}' WHERE idrol = '{$idrol}'";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setMensaje($base->getError());
            }
        } else {
            $this->setMensaje($base->getError());
        }
        return $resp;
    }

    //ELIMINAR
    public function eliminar()
    {
        $base = new BaseDatos();
        $rta = false;
        $consulta = "DELETE FROM rol WHERE idrol = " . $this->getIdrol();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($consulta)) {
                $rta = true;
            } else {
                $this->setMensaje($base->getError());
            }
        } else {
            $this->setMensaje($base->getError());
        }
        return $rta;
    }


}