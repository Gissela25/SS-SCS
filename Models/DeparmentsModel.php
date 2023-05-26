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

    public function getactive($id='')
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
        $query = "INSERT INTO departamentos(Id_Departamento, NombreD ) VALUES(  :Id_Departamento ,:NombreD )";
        return $this->set_query($query,$arreglo);
    }
    public function update($arreglo=array())
    {
        extract($arreglo);
        $query = "UPDATE departamentos SET NombreD=:Nombre WHERE Id_Departamento=:Id_Departamento;";
        return $this->set_query($query,$arreglo);
    }
    public function delete($id='')
    {
     //Creamos una consulta donde eliminamos un solo registro
         $query = "UPDATE departamentos SET Id_Estado='2' WHERE Id_Departamento=:Id_Departamento";
     //Utilizamos set_query para eliminar el registro (actualizar a deshabilitado)
         return $this->set_query($query,[":Id_Departamento"=>$id]);
    }
    //Funcion pora contar la cantidad de departamentos inactivos
    public function getInactive()
    {
         //Creamos una variable en donde almacenaremos la consulta que haremos, buscando todos los registro que su estado sea 2
         $query='';
             $query = "SELECT * FROM departamentos WHERE Id_Estado='2';";
         //Utilizamos el método get_query de la clase padre, la cual permite ejecutar consultas de selección
             return $this->get_query($query);
    }

    public function getCode()
    {
        $codigo = $this->generateCodeDeparments();
        return $codigo;
    }

    public function reactivate($id)
    {
          //Creamos una consulta donde eliminamos un solo registro
          $query = "UPDATE departamentos SET Id_Estado='1' WHERE Id_Departamento=:Id_Departamento";
          //Utilizamos set_query para reactivar el registro (actualizar a activo)
          return $this->set_query($query,[":Id_Departamento"=>$id]);
    }
}

?>