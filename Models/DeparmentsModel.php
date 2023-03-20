<?php

require_once 'ConnectionModel.php';

class DeparmentsModel extends ConnectionModel{
    public function get($id='')
    {
        $query='';
        if($id=='')
        {
            $query = "SELECT * FROM departamentos;";
            return $this->get_query($query);
        }
        else{
            $query = "SELECT * FROM departamentos WHERE Id_Departamento=:Id_Departamento";
            return $this->get_query($query,[":Id_Departamento"=>$id]);
        }
    }
    public function create($arreglo = array())
    {
        $query = "INSERT INTO departamentos(Id_Departamento, Nombre) VALUES( :Id_Departamento, :Nombre)";
        return $this->set_query($query,$arreglo);
    }
    public function update($arreglo=array())
    {

    }
    public function delete($id='')
    {

    }
    public function getCode()
    {
        $codigo = $this->generateCodeDeparments();
        return $codigo;
    }
}
?>