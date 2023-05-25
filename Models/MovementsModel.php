<?php

// Incluimos el archivo ConnectionModel para poder hereradar sus métodos
require_once 'ConnectionModel.php';

//Creamos una clase y la nombramos utilizando la notación Camello -> NameModel.php
class MovementsModel extends ConnectionModel{

    //Anexamos las funciones get(), create(), update() y delete() que son las heredadas de ConnectionModel, aunque podemos añadir funciones más específicas 

    public function get($id='')
    {
        //Creamos una variable en donde almacenaremos la consulta que haremos
        $query='';
        //Comprobaremos si la variable id que traifa get() este vacíía o no
        if($id=='')
        {
            //Si está vacía retornaremos todos los datos. Aquí si es necesario se pueden hcaer consultas con INNER JOIN
            $query = "SELECT  existencias.Id_Existencia, existencias.Saldo, articulos.Id_Articulo, articulos.NombreA, presentaciones.NombreP, areas.Nombre, departamentos.NombreD FROM existencias
            JOIN articulos ON existencias.Id_Articulo = articulos.Id_Articulo 
            JOIN presentaciones ON articulos.Id_Presentacion = presentaciones.Id_Presentacion 
            JOIN areas ON articulos.Id_Area = areas.Id_Area 
            JOIN departamentos ON articulos.Id_Departamento = departamentos.Id_Departamento
            WHERE articulos.Id_Estado  = '1' AND  existencias.Saldo > '0';";
            //Utilizamos el método get_query de la clase padre, la cual permite ejecutar consultas de selección
            return $this->get_query($query);
        }
        else{
            //En caso de que la variable no esté vacía, cremos la consulta utilizando WHERE para indicar el registro que traeremos
            $query = "SELECT  existencias.Id_Existencia, existencias.Saldo, articulos.Id_Articulo, articulos.NombreA, presentaciones.NombreP, areas.Nombre, departamentos.NombreD FROM existencias
            JOIN articulos ON existencias.Id_Articulo = articulos.Id_Articulo 
            JOIN presentaciones ON articulos.Id_Presentacion = presentaciones.Id_Presentacion 
            JOIN areas ON articulos.Id_Area = areas.Id_Area 
            JOIN departamentos ON articulos.Id_Departamento = departamentos.Id_Departamento
            WHERE articulos.Id_Estado  = '1' AND articulos.Id_Articulo=:Id_Articulo;";
            //Retornamos el registro
            return $this->get_query($query,[":Id_Articulo"=>$id]);
        }
    }

    public function ModifyItemToWithDraw($movimiento=array()){
        extract($movimiento);
        $query = "UPDATE movimientos_temp SET Cantidad=:Cantidad WHERE Id_Articulo=:Id_Articulo;";
        return $this->set_query($query,$movimiento);
    }

    public function getMovementsTemp($id='')
    {
        $query='';
        $query = "SELECT * FROM movimientos_temp 
        JOIN articulos ON movimientos_temp.Id_Articulo = articulos.Id_Articulo
        JOIN presentaciones ON articulos.Id_Presentacion = presentaciones.Id_Presentacion 
        JOIN areas ON articulos.Id_Area = areas.Id_Area 
        JOIN departamentos ON articulos.Id_Departamento = departamentos.Id_Departamento
        WHERE Id_Session=:Id_Session AND Cantidad > '0'";
        return $this->get_query($query,[":Id_Session"=>$id]);
    }

    public function searchMovements(){
        $query = "SELECT * FROM movimientos
        JOIN articulos ON movimientos.Id_Articulo = articulos.Id_Articulo";
        return $this->get_query($query);
    }

    public function verifyItem($item = array()){
        extract($item);
        $query = "SELECT * FROM movimientos_temp WHERE Id_Articulo=:Id_Articulo
        AND Id_Session=:Id_Session";
        return $this->get_query($query,$item);
    }

    public function createOrModifyWithDrawal($withDrawal=array(), $op=''){
        extract($withDrawal);
        if($op=="firts"){
            $query = "INSERT INTO movimientos_temp( Id_Session, Id_Articulo, Id_Usuario, Id_Existencia, Cantidad ) VALUES( :Id_Session, :Id_Articulo, :Id_Usuario, :Id_Existencia, :Cantidad  )";
            return $this->set_query($query,$withDrawal);
        }
        else if($op=="notFirst"){
            $query = "UPDATE movimientos_temp SET Cantidad=:Cantidad WHERE Id_Articulo=:Id_Articulo 
            AND Id_Session=:Id_Session;";
            return $this->set_query($query,$withDrawal);
        }
    }

    public function createWithDrawal($withDrawal=array()){
        extract($withDrawal);
        $query = "INSERT INTO movimientos_temp( Id_Session, Id_Articulo, Id_Usuario, Cantidad, Id_Existencia ) VALUES( :Id_Session, :Id_Articulo, :Id_Usuario, :Cantidad, :Id_Existencia  )";
        return $this->set_query($query,$withDrawal);
    }

    //Declaramos un arreglo en donde vendrán las variables que guardaremos
    public function create($arreglo = array(), $arreglo2 = array())
    {
       
        //Creamos la consulta para ingresar los datos
        $query = "INSERT INTO articulos(Id_Articulo, NombreA , Id_Presentacion, Id_Departamento, Id_Area ) VALUES(  :Id_Articulo, :NombreA, :Id_Presentacion, :Id_Departamento  ,:Id_Area )";
        //Utilzamos el método set_query para realizar un registro
        $result = $this->set_query($query,$arreglo);

        if($result){
            $equery = "INSERT INTO existencias (Id_Existencia, Id_Articulo, F_LastUpdate) VALUES ( :Id_Existencia, :Id_Articulo, :F_LastUpdate )";

            $result2 = $this->set_query($equery,$arreglo2);

            if($result2){

                return true;

            }else{

                return false;

            }
        }
        else{
            return false;
        }

    }
    
    public function update($arreglo=array())
    {
        extract($arreglo);
        // Actualizamos y colocamos las variables que realmente se actualizarán
        $query = "UPDATE articulos SET NombreA=:NombreA, Id_Presentacion=:Id_Presentacion, Id_Departamento=:Id_Departamento WHERE Id_Articulo=:Id_Articulo;";
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
        $codigo = $this->generateCodeArticules();
        return $codigo;
    }

    public function getCode2()
    {
        $codigo = $this->generateCodeExistencias();
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