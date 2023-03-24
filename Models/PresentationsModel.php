<?php
require_once 'ConnectionModel.php';

class PresentationsModel extends ConnectionModel{

  

    public function get($id='')
    {
        $query='';
   
        if($id=='')
        {
       
            $query = "SELECT * FROM presentaciones;";

            return $this->get_query($query);
        }
        else{

            $query = "SELECT * FROM presentaciones WHERE Id_Presentacion=:Id_Presentacion";

            return $this->get_query($query,[":Id_Presentacion"=>$id]);
        }
    }

    public function create($arreglo = array())
    {
        $query = "INSERT INTO presentaciones(Id_Presentacion, NombreP ) VALUES(  :Id_Presentacion ,:NombreP )";
        return $this->set_query($query,$arreglo);
    }
    public function update($arreglo=array())
    {
        extract($arreglo);
        $query = "UPDATE presentaciones SET NombreP=:Nombre WHERE Id_Presentacion=:Id_Presentacion;";
        return $this->set_query($query,$arreglo);
    }
    public function delete($id='')
    {
        // //Creamos una consulta donde eliminamos un solo registro
        // $query = "UPDATE usuarios SET Id_Estado='2' WHERE Id_Usuario=:Id_Usuario";
        // //Utilizamos set_query para eliminar el registro (actualizar a deshabilitado)
        // return $this->set_query($query,[":Id_Usuario"=>$id]);
    }
    //Funcion pora contar la cantidad de usuarios inactivos
    public function getInactive()
    {
        // //Creamos una variable en donde almacenaremos la consulta que haremos, buscando todos los registro que su estado sea 2
        // $query='';
        //     $query = "SELECT * FROM usuarios WHERE Id_Estado='2';";
        //     //Utilizamos el método get_query de la clase padre, la cual permite ejecutar consultas de selección
        //     return $this->get_query($query);
    }

    public function getCode()
    {
        $codigo = $this->generateCodePresentations();
        return $codigo;
    }

    public function reactivate($id)
    {
        //  //Creamos una consulta donde eliminamos un solo registro
        //  $query = "UPDATE usuarios SET Id_Estado='1' WHERE Id_Usuario=:Id_Usuario";
        //  //Utilizamos set_query para reactivar el registro (actualizar a activo)
        //  return $this->set_query($query,[":Id_Usuario"=>$id]);
    }
}

?>