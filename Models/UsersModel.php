<?php

// Incluimos el archivo ConnectionModel para poder hereradar sus métodos
require_once 'ConnectionModel.php';

//Creamos una clase y la nombramos utilizando la notación Camello -> NameModel.php
class UsersModel extends ConnectionModel{

    //Anexamos las funciones get(), create(), update() y delete() que son las heredadas de ConnectionModel, aunque podemos añadir funciones más específicas 

    public function get($id='')
    {
        //Creamos una variable en donde almacenaremos la consulta que haremos
        $query='';
        //Comprobaremos si la variable id que traifa get() este vacíía o no
        if($id=='')
        {
            //Si está vacía retornaremos todos los datos. Aquí si es necesario se pueden hcaer consultas con INNER JOIN
            $query = "SELECT * FROM usuarios;";
            //Utilizamos el método get_query de la clase padre, la cual permite ejecutar consultas de selección
            return $this->get_query($query);
        }
        else{
            //En caso de que la variable no esté vacía, cremos la consulta utilizando WHERE para indicar el registro que traeremos
            $query = "SELECT * FROM usuarios WHERE Id_Usuario=:Id_Usuario";
            //Retornamos el registro
            return $this->get_query($query,[":Id_Usuario"=>$id]);
        }
    }
    //Declaramos un arreglo en donde vendrán las variables que guardaremos
    public function create($arreglo = array())
    {
       
        //Creamos la consulta para ingresar los datos
        $query = "INSERT INTO usuarios(Id_Usuario, Nombre , Apellido, Correo, Clave ) VALUES(  :Id_Usuario, :Nombre, :Apellido, :Correo  ,:Clave )";
        //Utilzamos el método set_query para realizar un registro
        return $this->set_query($query,$arreglo);
    }
    public function update($arreglo=array())
    {
        extract($arreglo);
        // Actualizamos y colocamos las variables que realmente se actualizarán
        $query = "UPDATE usuarios SET Nombre=:Nombre, Apellido=:Apellido, Correo=:Correo WHERE Id_Usuario=:Id_Usuario;";
        return $this->set_query($query,$arreglo);
    }
    public function delete($id='')
    {
        //Creamos una consulta donde eliminamos un solo registro
        $query = "UPDATE usuarios SET Id_Estado='2' WHERE Id_Usuario=:Id_Usuario";
        //Utilizamos set_query para eliminar el registro (actualizar a deshabilitado)
        return $this->set_query($query,[":Id_Usuario"=>$id]);
    }
    //Funcion pora contar la cantidad de usuarios inactivos
    public function getInactive()
    {
        //Creamos una variable en donde almacenaremos la consulta que haremos, buscando todos los registro que su estado sea 2
        $query='';
            $query = "SELECT * FROM usuarios WHERE Id_Estado='2';";
            //Utilizamos el método get_query de la clase padre, la cual permite ejecutar consultas de selección
            return $this->get_query($query);
    }

    public function getCode()
    {
        $codigo = $this->generateCodeUsers();
        return $codigo;
    }

    public function reactivate($id)
    {
         //Creamos una consulta donde eliminamos un solo registro
         $query = "UPDATE usuarios SET Id_Estado='1' WHERE Id_Usuario=:Id_Usuario";
         //Utilizamos set_query para reactivar el registro (actualizar a activo)
         return $this->set_query($query,[":Id_Usuario"=>$id]);
    }
}

?>