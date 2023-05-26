<?php
require_once 'ConnectionModel.php';

class AreasModel extends ConnectionModel{

  

    public function get($id='')
    {
        $query='';
   
        if($id=='')
        {
       
            $query = "SELECT * FROM areas;";

            return $this->get_query($query);
        }
        else{

            $query = "SELECT * FROM areas WHERE Id_Area=:Id_Area";

            return $this->get_query($query,[":Id_Area"=>$id]);
        }
    }

    
    public function getactive($id='')
    {
        $query='';
   
        if($id=='')
        {
       
            $query = "SELECT * FROM areas WHERE Id_Estado=1;";

            return $this->get_query($query);
        }
        else{

            $query = "SELECT * FROM areas WHERE Id_Area=:Id_Area";

            return $this->get_query($query,[":Id_Area"=>$id]);
        }
    }

    public function create($arreglo = array())
    {
        $query = "INSERT INTO areas(Id_Area, Nombre ) VALUES(  :Id_Area ,:Nombre )";
        return $this->set_query($query,$arreglo);
    }
    public function update($arreglo=array())
    {
        extract($arreglo);
        $query = "UPDATE areas SET Nombre=:Nombre WHERE Id_Area=:Id_Area;";
        return $this->set_query($query,$arreglo);
    }
    public function delete($id='')
    {
         //Creamos una consulta donde eliminamos un solo registro
         $query = "UPDATE areas SET Id_Estado='2' WHERE Id_Area=:Id_Area";
         //Utilizamos set_query para eliminar el registro (actualizar a deshabilitado)
         return $this->set_query($query,[":Id_Area"=>$id]);
    }
    //Funcion pora contar la cantidad de areas inactivos
    public function getInactive()
    {
         //Creamos una variable en donde almacenaremos la consulta que haremos, buscando todos los registro que su estado sea 2
         $query='';
             $query = "SELECT * FROM areas WHERE Id_Estado='2';";
             //Utilizamos el método get_query de la clase padre, la cual permite ejecutar consultas de selección
             return $this->get_query($query);
    }

    public function getCode()
    {
        $codigo = $this->generateCodeAreas();
        return $codigo;
    }

    public function reactivate($id)
    {
          //Creamos una consulta donde eliminamos un solo registro
          $query = "UPDATE areas SET Id_Estado='1' WHERE Id_Area=:Id_Area";
          //Utilizamos set_query para reactivar el registro (actualizar a activo)
          return $this->set_query($query,[":Id_Area"=>$id]);
    }
}

?>