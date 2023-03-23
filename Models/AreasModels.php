<?php

 require_once 'ConnectionModel.php';

 class AreasModels extends ConnectionModel{
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
         public function create($arreglo = array())
         {
             $query = "INSERT INTO areas(Id_Area, Nombre) VALUES( :Id_Area, :Nombre)";
             return $this->set_query($query,$arreglo);
         }
         public function update($arreglo=array())
         {
    
         }
         public function delete($id='')
         {
         }
        }
        ?>
