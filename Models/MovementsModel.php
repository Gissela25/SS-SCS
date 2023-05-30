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
            $query = "SELECT  existencias.Id_Existencia, existencias.Saldo, articulos.Id_Articulo, articulos.Codigo, articulos.NombreA, presentaciones.NombreP, areas.Nombre, 
            departamentos.NombreD, existencias.NoComprobante FROM existencias
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
            $query = "SELECT  existencias.Id_Existencia, existencias.Saldo, articulos.Id_Articulo, articulos.NombreA, presentaciones.NombreP, areas.Nombre, departamentos.NombreD
            , articulos.Codigo, existencias.NoComprobante FROM existencias
            JOIN articulos ON existencias.Id_Articulo = articulos.Id_Articulo 
            JOIN presentaciones ON articulos.Id_Presentacion = presentaciones.Id_Presentacion 
            JOIN areas ON articulos.Id_Area = areas.Id_Area 
            JOIN departamentos ON articulos.Id_Departamento = departamentos.Id_Departamento
            WHERE articulos.Id_Estado  = '1' AND articulos.Id_Articulo=:Id_Articulo;";
            //Retornamos el registro
            return $this->get_query($query,[":Id_Articulo"=>$id]);
        }
    }

    public function getWithdrawalArticlesReport($id='')
    {
        $query='';
   
        if($id=='')
        {
       
            $query = "SELECT * FROM movimientos;";

            return $this->get_query($query);
        }
        else{

            $query = "SELECT movimientos.Id_Correlativo, articulos.Codigo, movimientos.Salida, articulos.NombreA, presentaciones.NombreP FROM movimientos JOIN articulos ON movimientos.Id_Articulo = articulos.Id_Articulo JOIN presentaciones ON articulos.Id_Presentacion = presentaciones.Id_Presentacion WHERE Id_Correlativo=:Id_Correlativo;";

            return $this->get_query($query,[":Id_Correlativo"=>$id]);
        }
    }

    public function getArticlesByArea($id='')
    {
        $query='';
        if($id!='')
        {
            $query = "SELECT  existencias.Id_Existencia, existencias.Saldo, articulos.Id_Articulo, articulos.Codigo, articulos.NombreA, presentaciones.NombreP, areas.Nombre, 
            departamentos.NombreD, existencias.NoComprobante FROM existencias
            JOIN articulos ON existencias.Id_Articulo = articulos.Id_Articulo 
            JOIN presentaciones ON articulos.Id_Presentacion = presentaciones.Id_Presentacion 
            JOIN areas ON articulos.Id_Area = areas.Id_Area 
            JOIN departamentos ON articulos.Id_Departamento = departamentos.Id_Departamento
            WHERE articulos.Id_Estado  = '1' AND  existencias.Saldo > '0'
            AND articulos.Id_Area=:Id_Area;";
            return $this->get_query($query,[":Id_Area"=>$id]);
        }
    }


    public function getMovements($id='')
    {
        //Creamos una variable en donde almacenaremos la consulta que haremos
        $query='';
        //Comprobaremos si la variable id que traifa get() este vacíía o no
        if($id=='')
        {
            //Si está vacía retornaremos todos los datos. Aquí si es necesario se pueden hcaer consultas con INNER JOIN
            $query = "SELECT articulos.Id_Articulo, articulos.NombreA, presentaciones.NombreP, departamentos.NombreD, articulos.Codigo, existencias.NoComprobante , articulos.Codigo FROM movimientos JOIN articulos ON movimientos.Id_Articulo = articulos.Id_Articulo JOIN existencias ON movimientos.Id_Existencia = existencias.Id_Existencia JOIN presentaciones ON articulos.Id_Presentacion = presentaciones.Id_Presentacion JOIN departamentos ON articulos.Id_Departamento = departamentos.Id_Departamento GROUP BY articulos.Id_Articulo";
            //Utilizamos el método get_query de la clase padre, la cual permite ejecutar consultas de selección
            return $this->get_query($query);
        }
        else{
            //En caso de que la variable no esté vacía, cremos la consulta utilizando WHERE para indicar el registro que traeremos
            $query = "SELECT articulos.Id_Articulo, articulos.NombreA, existencias.NoComprobante, existencias.SaldoInicial, presentaciones.NombreP, correlativos.Id_Correlativo, movimientos.*,
            usuarios.Nombre, usuarios.Apellido, articulos.Codigo FROM movimientos 
            JOIN articulos ON movimientos.Id_Articulo = articulos.Id_Articulo 
            JOIN existencias ON movimientos.Id_Existencia = existencias.Id_Existencia 
            JOIN presentaciones ON articulos.Id_Presentacion = presentaciones.Id_Presentacion 
            JOIN correlativos ON movimientos.Id_Correlativo = correlativos.Id_Correlativo
            JOIN usuarios ON correlativos.Id_Usuario = usuarios.Id_Usuario
            WHERE articulos.Id_Articulo=:Id_Articulo ORDER BY movimientos.F_Movimiento DESC;;";
            //Retornamos el registro
            return $this->get_query($query,[":Id_Articulo"=>$id]);
        }
    }

    public function getMovementsEntryByArea($id = '')
    {
        //Creamos una variable en donde almacenaremos la consulta que haremos
        $query='';
        //Comprobaremos si la variable id que traifa get() este vacía o no
        if($id=='')
        {
            //Si está vacía retornaremos todos los datos. Aquí si es necesario se pueden hacer consultas con INNER JOIN
            $query = "SELECT movimientos.Id_Correlativo, movimientos.F_Movimiento, areas.Id_Area, movimientos.Id_Articulo, articulos.NombreA, movimientos.Entrada, movimientos.SaldoResultante, movimientos.Correctivo, articulos.Codigo, presentaciones.NombreP, usuarios.Nombre, usuarios.Apellido FROM movimientos JOIN articulos ON movimientos.Id_Articulo = articulos.Id_Articulo JOIN areas ON areas.Id_Area = articulos.Id_Area JOIN correlativos ON correlativos.Id_Correlativo = movimientos.Id_Correlativo JOIN usuarios ON usuarios.Id_Usuario = correlativos.Id_Usuario JOIN presentaciones ON presentaciones.Id_Presentacion = articulos.Id_Presentacion WHERE movimientos.F_Movimiento = :F_Movimiento AND movimientos.Entrada > 0 AND areas.Id_Area = :Id_Area;";
            //Utilizamos el método get_query de la clase padre, la cual permite ejecutar consultas de selección
            return $this->get_query($query, [":F_Movimiento" => $_SESSION['F_Movimiento'], ":Id_Area" => $_SESSION['area']]);
        }
        else{
            //En caso de que la variable no esté vacía, creamos la consulta utilizando WHERE para indicar el registro que traeremos
            $query = "SELECT movimientos.Id_Correlativo, movimientos.F_Movimiento, areas.Id_Area, movimientos.Id_Articulo, articulos.NombreA, movimientos.Entrada, movimientos.SaldoResultante, movimientos.Correctivo, articulos.Codigo, presentaciones.NombreP, usuarios.Nombre, usuarios.Apellido FROM movimientos JOIN articulos ON movimientos.Id_Articulo = articulos.Id_Articulo JOIN areas ON areas.Id_Area = articulos.Id_Area JOIN correlativos ON correlativos.Id_Correlativo = movimientos.Id_Correlativo JOIN usuarios ON usuarios.Id_Usuario = correlativos.Id_Usuario JOIN presentaciones ON presentaciones.Id_Presentacion = articulos.Id_Presentacion WHERE movimientos.F_Movimiento = :F_Movimiento AND movimientos.Entrada > 0 AND areas.Id_Area = :Id_Area;";
            //Retornamos el registro
            return $this->get_query($query, [":F_Movimiento" => $id, ":Id_Area" => $_SESSION['area']]);
        }
    }
    
    
    

    public function getMovementsByDeparment($id='')
    {
        //Creamos una variable en donde almacenaremos la consulta que haremos
        $query='';
        //Comprobaremos si la variable id que traifa get() este vacíía o no
        if($id=='')
        {
            //Si está vacía retornaremos todos los datos. Aquí si es necesario se pueden hcaer consultas con INNER JOIN
            $query = "SELECT departamentos.Id_Departamento, departamentos.NombreD, articulos.Codigo, articulos.NombreA, presentaciones.NombreP, usuarios.Nombre, usuarios.Apellido, movimientos.Id_Correlativo, existencias.NoComprobante, movimientos.F_Movimiento, movimientos.Entrada, movimientos.Correctivo, movimientos.Salida, movimientos.SaldoResultante, existencias.SaldoInicial FROM movimientos JOIN articulos ON movimientos.Id_Articulo = articulos.Id_Articulo JOIN departamentos ON departamentos.Id_Departamento = articulos.Id_Departamento JOIN presentaciones ON articulos.Id_Presentacion = presentaciones.Id_Presentacion JOIN correlativos ON correlativos.Id_Correlativo = movimientos.Id_Correlativo JOIN usuarios ON usuarios.Id_Usuario = correlativos.Id_Usuario JOIN existencias ON existencias.Id_Existencia = movimientos.Id_Existencia WHERE departamentos.Id_Departamento = :Id_Departamento;";
            //Utilizamos el método get_query de la clase padre, la cual permite ejecutar consultas de selección
            return $this->get_query($query);
        }
        else{
            //En caso de que la variable no esté vacía, cremos la consulta utilizando WHERE para indicar el registro que traeremos
            $query = "SELECT departamentos.Id_Departamento, departamentos.NombreD, articulos.Codigo, articulos.NombreA, presentaciones.NombreP, usuarios.Nombre, usuarios.Apellido, movimientos.Id_Correlativo, existencias.NoComprobante, movimientos.F_Movimiento, movimientos.Entrada, movimientos.Correctivo, movimientos.Salida, movimientos.SaldoResultante, existencias.SaldoInicial FROM movimientos JOIN articulos ON movimientos.Id_Articulo = articulos.Id_Articulo JOIN departamentos ON departamentos.Id_Departamento = articulos.Id_Departamento JOIN presentaciones ON articulos.Id_Presentacion = presentaciones.Id_Presentacion JOIN correlativos ON correlativos.Id_Correlativo = movimientos.Id_Correlativo JOIN usuarios ON usuarios.Id_Usuario = correlativos.Id_Usuario JOIN existencias ON existencias.Id_Existencia = movimientos.Id_Existencia WHERE departamentos.Id_Departamento = :Id_Departamento;";
            //Retornamos el registro
            return $this->get_query($query,[":Id_Departamento"=>$id]);
        }
    }

    public function getMovementsByArea($id='')
    {
        //Creamos una variable en donde almacenaremos la consulta que haremos
        $query='';
        //Comprobaremos si la variable id que traifa get() este vacíía o no
        if($id!='')
        {
            //Si está vacía retornaremos todos los datos. Aquí si es necesario se pueden hcaer consultas con INNER JOIN
            $query = "SELECT articulos.Id_Articulo, articulos.NombreA, presentaciones.NombreP, departamentos.NombreD, articulos.Codigo
            , articulos.Codigo FROM movimientos 
            JOIN articulos ON movimientos.Id_Articulo = articulos.Id_Articulo 
            JOIN existencias ON movimientos.Id_Existencia = existencias.Id_Existencia 
            JOIN presentaciones ON articulos.Id_Presentacion = presentaciones.Id_Presentacion 
            JOIN departamentos ON articulos.Id_Departamento = departamentos.Id_Departamento    
            WHERE articulos.Id_Area=:Id_Area
            GROUP BY articulos.Id_Articulo ;";
            //Utilizamos el método get_query de la clase padre, la cual permite ejecutar consultas de selección
            return $this->get_query($query,[":Id_Area"=>$id]);
        }
    }

    public function getMovementsDeparmentByArea($id='')
    {
        //Creamos una variable en donde almacenaremos la consulta que haremos
        $query='';
        //Comprobaremos si la variable id que traifa get() este vacíía o no
        if($id!='')
        {
            //Si está vacía retornaremos todos los datos. Aquí si es necesario se pueden hcaer consultas con INNER JOIN
            $query = "SELECT articulos.Id_Articulo, departamentos.Id_Departamento, departamentos.NombreD, articulos.Codigo, articulos.NombreA FROM articulos JOIN departamentos ON articulos.Id_Departamento = departamentos.Id_Departamento JOIN movimientos ON articulos.Id_Articulo = movimientos.Id_Articulo WHERE articulos.Id_Area = :Id_Area AND (movimientos.Entrada <> 0 OR movimientos.Salida <> 0) GROUP BY departamentos.Id_Departamento;";
            //Utilizamos el método get_query de la clase padre, la cual permite ejecutar consultas de selección
            return $this->get_query($query,[":Id_Area"=>$id]);
        }
    }

    public function getEntryByDate($id='')
    {
        //Creamos una variable en donde almacenaremos la consulta que haremos
        $query='';
        //Comprobaremos si la variable id que traifa get() este vacíía o no
        if($id!='')
        {
            //Si está vacía retornaremos todos los datos. Aquí si es necesario se pueden hcaer consultas con INNER JOIN
            $query = "SELECT movimientos.Id_Correlativo, movimientos.F_Movimiento, SUM(movimientos.Entrada) AS TotalEntradas FROM movimientos JOIN articulos ON movimientos.Id_Articulo = articulos.Id_Articulo JOIN areas ON areas.Id_Area = articulos.Id_Area WHERE articulos.Id_Area = :Id_Area GROUP BY movimientos.F_Movimiento HAVING SUM(movimientos.Entrada) > 0 ORDER BY movimientos.F_Movimiento;";
            //Utilizamos el método get_query de la clase padre, la cual permite ejecutar consultas de selección
            return $this->get_query($query,[":Id_Area"=>$id]);
        }
    }

    public function getTemporaryWithDrawalData($id = ''){
        if($id!='')
        {
            $query = "SELECT movimientos_temp.Id_Articulo, movimientos_temp.Id_Existencia, 
            movimientos_temp.Cantidad as 'Salida', 
            (existencias.Saldo - movimientos_temp.Cantidad) as 'SaldoResultante'
            FROM movimientos_temp
            JOIN existencias ON movimientos_temp.Id_Existencia = existencias.Id_Existencia
            WHERE movimientos_temp.Id_Session=:Id_Session;";
            
            return $this->get_query($query,[":Id_Session"=>$id]);
        }
    }
    
    public function createCorrelative($correlative = array())
    {
        $query = "INSERT INTO correlativos(Id_Correlativo, Id_Usuario) VALUES(:Id_Correlativo, :Id_Usuario)";
        return $this->set_query($query,$correlative);
    }

    public function deleteAllTemporaryWithDrawalData($id = ''){
        $query = "DELETE FROM movimientos_temp WHERE Id_Session=:Id_Session";
        return $this->set_query($query,[":Id_Session"=>$id]);
    }

    public function deleteSpecificTemporaryWithDrawalData($session){
        $query = "DELETE FROM movimientos_temp WHERE Id_Articulo=:Id_Articulo
        AND Id_Session=:Id_Session";
        return $this->set_query($query,$session);
    }

    public function getNewBalance($id){
        if($id!='')
        {
        $query = "SELECT movimientos.Id_Existencia, movimientos.Id_Articulo, movimientos.SaldoResultante FROM movimientos
        WHERE movimientos.Id_Correlativo=:Id_Correlativo;";
         return $this->get_query($query,[":Id_Correlativo"=>$id]);
        }
    }

    public function completeWithDrawals($withDrawal = array()){
        extract($withDrawal);
        $query = "INSERT INTO movimientos( Id_Correlativo, Id_Articulo, Id_Existencia,Salida, SaldoResultante, F_Movimiento ) 
        VALUES( :Id_Correlativo, :Id_Articulo, :Id_Existencia, :Salida, :SaldoResultante , :F_Movimiento );";
        return $this->set_query($query,$withDrawal);
    }

    public function updateBalances($balances = array()){
        $query = "UPDATE existencias SET Saldo=:Saldo WHERE Id_Articulo=:Id_Articulo
        AND Id_Existencia=:Id_Existencia;";
        return $this->set_query($query,$balances);
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
         JOIN existencias ON movimientos_temp.Id_Existencia = existencias.Id_Existencia
        JOIN articulos ON movimientos_temp.Id_Articulo = articulos.Id_Articulo
        JOIN presentaciones ON articulos.Id_Presentacion = presentaciones.Id_Presentacion 
        JOIN areas ON articulos.Id_Area = areas.Id_Area 
        JOIN departamentos ON articulos.Id_Departamento = departamentos.Id_Departamento
        WHERE Id_Session=:Id_Session AND Cantidad > '0'";
        return $this->get_query($query,[":Id_Session"=>$id]);
    }

    public function checkWithDrawalAmount($id = ''){
        $query = " SELECT (existencias.Saldo - movimientos_temp.Cantidad) as 'SaldoResultante', articulos.NombreA,  existencias.Saldo
        FROM movimientos_temp
        JOIN existencias ON movimientos_temp.Id_Existencia = existencias.Id_Existencia
        JOIN articulos ON movimientos_temp.Id_Articulo = articulos.Id_Articulo";
        return $this->get_query($query);
    }

    public function searchMovements(){
        $query = "SELECT  articulos.Id_Articulo, articulos.NombreA, movimientos.Id_Correlativo, movimientos.F_Movimiento
        ,movimientos.Entrada, movimientos.Correctivo, movimientos.Salida, movimientos.SaldoResultante, articulos.Codigo FROM movimientos
        JOIN articulos ON movimientos.Id_Articulo = articulos.Id_Articulo
        JOIN existencias ON movimientos.Id_Existencia = existencias.Id_Existencia
        ORDER BY movimientos.F_Movimiento DESC;";
        return $this->get_query($query);
    }

    public function searchMovementsByArea($id=''){
        $query = "SELECT  articulos.Id_Articulo, articulos.NombreA, movimientos.Id_Correlativo, movimientos.F_Movimiento
        ,movimientos.Entrada, movimientos.Correctivo, movimientos.Salida, movimientos.SaldoResultante, articulos.Codigo FROM movimientos
        JOIN articulos ON movimientos.Id_Articulo = articulos.Id_Articulo
        JOIN existencias ON movimientos.Id_Existencia = existencias.Id_Existencia
        WHERE articulos.Id_Area=:Id_Area
        ORDER BY movimientos.F_Movimiento DESC;";
        return $this->get_query($query,[":Id_Area"=>$id] );
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

    public function generateCorrelative(){
        return $this->generateCodeCorrelative();
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