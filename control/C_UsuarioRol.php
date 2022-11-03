<?php
include_once '../Modelo/UsuarioRol.php';

class C_UsuarioRol
{

    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto
     * @param array $param
     * @return Rol
     */
    private function cargarObjeto($param)
    {
        $obj = null;
        if (array_key_exists('idur', $param)) {
            $obj = new Rol();
            $obj->cargar(
                $param['idur'],
                $param['usuario'],
                $param['rol']
            );
        }
        return $obj;
    }

    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de 
     * las variables instancias del objeto que son claves
     * @param array $param
     * @return Rol
     */
    private function cargarObjetoConClave($param)
    {
        $obj = null;
        if (isset($param['idur'])) {
            $obj = new UsuarioRol();
            $obj->cargar($param['idur'], null, null);
        }
        return $obj;
    }

    /**
     * Corrobora que dentro del arreglo asociativo estan seteados los campos claves
     * @param array $param
     * @return boolean
     */

    private function seteadosCamposClaves($param)
    {
        $resp = false;
        if (isset($param['idur']))
            $resp = true;
        return $resp;
    }

    /**
     * Inserta un objeto
     * @param array $param
     */
    public function alta($param)
    {
        $resp = false;
        $obj = $this->cargarObjeto($param);
        if ($obj != null and $obj->insertar()) {
            $resp = true;
        }
        return $resp;
    }

    /**
     * permite eliminar un objeto 
     * @param array $param
     * @return boolean
     */
    public function baja($param)
    {
        $resp = false;
        if ($this->seteadosCamposClaves($param)) {
            $obj = $this->cargarObjetoConClave($param);
            if ($obj != null and $obj->eliminar()) {
                $resp = true;
            }
        }
        return $resp;
    }

    /**
     * permite modificar un objeto
     * @param array $param
     * @return boolean
     */
    public function modificacion($param){
        $resp = false;
        if ($this->seteadosCamposClaves($param)){
            $obj= $this->cargarObjeto($param);
            if($obj!=null && $obj->modificar()){
                $resp = true;
            }
        }
        return $resp;
    }

    /**
     * permite buscar un objeto
     * @param array $param
     * @return array
     */
    public function buscar($param){
        $where = " true "; 
        if ($param<>NULL){
            $where .= '';
            if  (isset($param['idur']))
                $where.=" and idur ='".$param['idur']."'"; 
            if  (isset($param['usuario']))
                    $where.=" and usuario ='".$param['usuario']."'";
            if  (isset($param['rol']))
                    $where.=" and rol ='".$param['rol']."'";
        }
        $obj = new Rol();
        $arreglo =  $obj->listar($where);  
        
        return $arreglo;
    }

}