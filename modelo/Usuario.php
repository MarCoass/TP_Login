<?php
include_once ('conector/BaseDatos.php1');

class Usuario{

    private $idusuario;
    private $usnombre;
    private $uspass;
    private $usmail;
    private $usdeshabilitado;
    private $mensaje;

    public function __construct()
    {
        $idusuario = '';
        $usnombre = '';
        $uspass = '';
        $usmail = '';
        $usdeshabilitado = '';
    }

    public function cargar($id, $nombre, $pass, $mail, $deshabilidado){
        $idusuario = $id;
        $usnombre = $nombre;
        $uspass = $pass;
        $usmail = $mail;
        $usdeshabilitado = $deshabilidado;
    }

    public function getIdusuario(){
        return $this->idusuario;
    }

    public function setIdusuario($idusuario){
        $this->idusuario = $idusuario;
    }

    public function getUsnombre(){
        return $this->usnombre;
    }

    public function setUsnombre($usnombre){
        $this->usnombre = $usnombre;
    }

    public function getUspass(){
        return $this->uspass;
    }

    public function setUspass($uspass){
        $this->uspass = $uspass;
    }

    public function getUsmail(){
        return $this->usmail;
    }

    public function setUsmail($usmail){
        $this->usmail = $usmail;
    }

    public function getUsdeshabilitado(){
        return $this->usdeshabilitado;
    }

    public function setUsdeshabilitado($usdeshabilitado){
        $this->usdeshabilitado = $usdeshabilitado;
    }

    public function getMensaje(){
        return $this->mensaje;
    }

    public function setMensaje($mensaje){
        $this->mensaje = $mensaje;
    }

    public function __toString()
    {
        return "ID: " . $this->getIdusuario() . "
        Nombre: " . $this->getUsnombre() ."
        Pass: " . $this->getUspass() . "
        Mail: " . $this->getUsmail() . "
        Deshabilitado: " . $this->getUsdeshabilitado();
    }

    //FUNCIONES DE BASE DE DATOS

    //BUSCAR
    public function buscar($idusuario)
    {
        $base = new BaseDatos();
        $resp = false;
        $sql = "SELECT * FROM usuario WHERE idusuario = '" . $idusuario . "'";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                if ($row2 = $base->Registro()) {
                    $this->setIdusuario($row2['idusuario']);
                    $this->setUsnombre($row2['usnombre']);
                    $this->setUspass($row2['uspass']);
                    $this->setUsmail($row2['usmail']);
                    $this->setUsdeshabilitado($row2['stock']);
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
        $sql =  "select * from usuario";
        if ($condicion != '') {
            $sql = $sql . ' where ' . $condicion;
        }
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $array = array();
                while ($row2 = $base->Registro()) {
                    $objusuario = new usuario();
                    $objusuario->buscar($row2['idusuario']);
                    $array[] = $objusuario;
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
        $idusuario = $this->getIdusuario();
        $usnombre = $this->getUsnombre();
        $uspass = $this->getUspass();
        $usmail = $this->getUsmail();
        $usdeshabilitado = $this->getUsdeshabilitado();
        
        //Creo la consulta 
        $sql = "INSERT INTO usuario (idusuario, usnombre, uspass, usmail, usdeshabilitado) VALUES ('{$idusuario}', '{$usnombre}', '{$uspass}' , '{$usmail}' , '{$usdeshabilitado}'')";
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
        $idusuario = $this->getIdusuario();
        $usnombre = $this->getUsnombre();
        $uspass = $this->getUspass();
        $usmail = $this->getUsmail();
        $usdeshabilitado = $this->getUsdeshabilitado();
        $sql = "UPDATE usuario SET usnombre = '{$usnombre}', uspass = '{$uspass}', usmail = '{$usmail} , usdeshabilitado = '{$usdeshabilitado} WHERE idusuario = '{$idusuario}'";
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
        $consulta = "DELETE FROM usuario WHERE idusuario = " . $this->getIdusuario();
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