<?php

// Incluimos el archivo ConnectionModel para poder hereradar sus métodos
require_once 'ConnectionModel.php';

//Creamos una clase y la nombramos utilizando la notación Camello -> NameModel.php
class StocksModel extends ConnectionModel{

    //Anexamos las funciones get(), create(), update() y delete() que son las heredadas de ConnectionModel, aunque podemos añadir funciones más específicas 

    public function get($id='')
    {
        //Creamos una variable en donde almacenaremos la consulta que haremos
        $query='';
        //Comprobaremos si la variable id que traifa get() este vacíía o no
        if($id=='')
        {
            //Si está vacía retornaremos todos los datos. Aquí si es necesario se pueden hcaer consultas con INNER JOIN
            $query = "SELECT existencias.Id_Existencia, articulos.Id_Articulo, articulos.Codigo, articulos.NombreA, existencias.Saldo, existencias.F_LastUpdate 
            FROM existencias JOIN articulos ON existencias.Id_Articulo = articulos.Id_Articulo
            WHERE Id_Estado ='1';";
            //Utilizamos el método get_query de la clase padre, la cual permite ejecutar consultas de selección
            return $this->get_query($query);
        }
        else{
            //En caso de que la variable no esté vacía, cremos la consulta utilizando WHERE para indicar el registro que traeremos
            $query = "SELECT * FROM existencias 
             JOIN articulos ON existencias.Id_Articulo = articulos.Id_Articulo
             WHERE Id_Existencia=:Id_Existencia";
            //Retornamos el registro
            return $this->get_query($query,[":Id_Existencia"=>$id]);
        }
    }

    public function getArticlesByArea($idArea = '')
    {
        $query='';
        if($idArea!='')
        {
        $query = "SELECT existencias.Id_Existencia, articulos.Id_Articulo, articulos.Codigo, articulos.NombreA, existencias.Saldo, existencias.F_LastUpdate, articulos.Id_Area 
        FROM existencias JOIN articulos ON existencias.Id_Articulo = articulos.Id_Articulo
        WHERE Id_Estado ='1' AND articulos.Id_Area=:Id_Area;";
        return $this->get_query($query,[":Id_Area"=>$idArea]);
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
        $codigo = $this->generateCodeCorrelative();
        return $codigo;
    }

    public function UpdateBalance($existencia = array(),$correlative = array(), $movimiento = array()){
        extract($existencia);
        extract($correlative);
        extract($movimiento);

        $query = "UPDATE existencias SET NoComprobante=:NoComprobante, Saldo=:Saldo, F_LastUpdate=:F_LastUpdate WHERE Id_Existencia =:Id_Existencia ;";
        $firsResult = $this->set_query($query,$existencia);
        if($firsResult){
            $query = "INSERT INTO correlativos(Id_Correlativo, Id_Usuario) VALUES(:Id_Correlativo, :Id_Usuario)";
            $secondResult =  $this->set_query($query,$correlative);
            if($secondResult){
                $query = "INSERT INTO movimientos(Id_Correlativo, Id_Articulo, Id_Existencia, Correctivo, SaldoResultante, F_Movimiento)
                 VALUES(:Id_Correlativo, :Id_Articulo, :Id_Existencia, :Correctivo, :SaldoResultante, :F_Movimiento)";
                $thirdResult =  $this->set_query($query,$movimiento);
                if($thirdResult){
                    return true;
                }
                else{
                    return false;
                }
            }
            else{
                return false;
            }
        }
        else{
            return false;
        }
    }

    public function AddBeginningBalance($existencia = array(),$correlative = array(), $movimiento = array()){
        extract($existencia);
        extract($correlative);
        extract($movimiento);
        // Actualizamos y colocamos las variables que realmente se actualizarán
        $query = "UPDATE existencias SET NoComprobante=:NoComprobante, Saldo=:Saldo, SaldoInicial=:SaldoInicial, F_LastUpdate=:F_LastUpdate,  EsSaldoInicial=:EsSaldoInicial 
        WHERE Id_Existencia =:Id_Existencia ;";
        $firsResult =  $this->set_query($query,$existencia);
        if($firsResult){
            $query = "INSERT INTO correlativos(Id_Correlativo, Id_Usuario) VALUES(:Id_Correlativo, :Id_Usuario)";
            $secondResult =  $this->set_query($query,$correlative);
            if($secondResult){
                $query = "INSERT INTO movimientos(Id_Correlativo, Id_Articulo, Id_Existencia, Entrada, SaldoResultante, F_Movimiento)
                 VALUES(:Id_Correlativo, :Id_Articulo, :Id_Existencia, :Entrada, :SaldoResultante, :F_Movimiento)";
                $thirdResult =  $this->set_query($query,$movimiento);
                if($thirdResult){
                    return true;
                }
                else{
                    return false;
                }
            }
            else{
                return false;
            }
        }
        else{
            return false;
        }
    }

    public function AddBalance($existencia = array(),$correlative = array(), $movimiento = array()){
        extract($existencia);
        extract($correlative);
        extract($movimiento);
        // Actualizamos y colocamos las variables que realmente se actualizarán
        $query = "UPDATE existencias SET NoComprobante=:NoComprobante ,Saldo=:Saldo, F_LastUpdate=:F_LastUpdate WHERE Id_Existencia =:Id_Existencia ;";
        $firsResult =  $this->set_query($query,$existencia);
        if($firsResult){
            $query = "INSERT INTO correlativos(Id_Correlativo, Id_Usuario) VALUES(:Id_Correlativo, :Id_Usuario)";
            $secondResult =  $this->set_query($query,$correlative);
            if($secondResult){
                $query = "INSERT INTO movimientos(Id_Correlativo, Id_Articulo, Id_Existencia, Entrada, SaldoResultante, F_Movimiento)
                 VALUES(:Id_Correlativo, :Id_Articulo, :Id_Existencia, :Entrada, :SaldoResultante, :F_Movimiento)";
                $thirdResult =  $this->set_query($query,$movimiento);
                if($thirdResult){
                    return true;
                }
                else{
                    return false;
                }
            }
            else{
                return false;
            }
        }
        else{
            return false;
        }
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