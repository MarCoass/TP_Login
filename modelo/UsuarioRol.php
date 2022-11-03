<?php
include_once ('conector/BaseDatos.php');

class UsuarioRol{

    private $idur;
    private $rol;
    private $usuario;
    private $mensaje;

    public function __construct()
    {
        $idur = '';
        $rol = '';
        $usuario = '';
    }

    public function cargar($idur, $rol, $usuario){
        $idur = $idur;
        $rol = $rol;
        $usuario = $usuario;
    }

    public function getIdur(){
        return $this->Idur;
    }

    public function setIdur($idur){
        $this->idur = $idur;
    }

    public function getUsuario(){
        return $this->usuario;
    }

    public function setUsuario($id){
        $this->id = $id;
    }

    public function getRol(){
        return $this->usuario;
    }

    public function setRol($id){
        $this->id = $id;
    }
    
    public function getMensaje(){
        return $this->mensaje;
    }

    public function setMensaje($mensaje){
        $this->mensaje = $mensaje;
    }


    public function __toString()
    {
        return "ID: " . $this->getIdur() . "
        Usuario: " . $this->getUsuario() . "
        Rol: " . $this->getRol() ;
    }

    //FUNCIONES DE BASE DE DATOS

    //BUSCAR
    public function buscar($idur)
    {
        $base = new BaseDatos();
        $resp = false;
        $sql = "SELECT * FROM usuariorol WHERE idur = '" . $idur . "'";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                if ($row2 = $base->Registro()) {
                    $this->setIdur($row2['idur']);

                    $rol = new Rol();
                    $rol->buscar($row2['rol']);
                    $this->setRol($rol);

                    $usuario = new Usuario();
                    $usuario->buscar($row2['usuario']);
                    $this->setRol($usuario);
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
        $sql =  "select * from usuariorol";
        if ($condicion != '') {
            $sql = $sql . ' where ' . $condicion;
        }
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $array = array();
                while ($row2 = $base->Registro()) {
                    $objUsuarioRol = new Usuariorol();
                    $objUsuarioRol->buscar($row2['idur']);
                    $array[] = $objUsuarioRol;
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
        $idur = $this->getIdur();
        $rol = $this->getRol();
        $usuario = $this->getUsuario();
        
        //Creo la consulta 
        $sql = "INSERT INTO usuariorol (idur, rol, usuario) VALUES ('{$idur}', '{$rol}', '{$usuario}')";
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
        $idur = $this->getIdur();
        $rol = $this->getRol();
        $usuario = $this->getUsuario();
        
        $sql = "UPDATE usuariorol SET usuario = '{$usuario}', rol = '{$rol}' WHERE idur = '{$idur}'";
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
        $consulta = "DELETE FROM usuariorol WHERE idur = " . $this->getIdur();
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