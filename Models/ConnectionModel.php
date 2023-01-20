<?php
abstract class ConexionModel{

        private $db_host="localhost";
        private $db_user="root";
        private $db_pass="";
        private $db_name="ss-scs";
        protected $conn;

        function __construct()
        {
            
        }


        protected function db_open()
        {
            try
            {
                $this->conn= new PDO("mysql: host=$this->db_host;dbname=$this->db_name;charset=utf8" ,$this->db_user,$this->db_pass);
            }
            catch(PDOException $e)
            {
                echo $e->getMessage();
            }
          
        }

        protected function db_close()
        {
            $this->conn=null;
        }

        //Actualización
        protected function set_query($query,$params=array()){
            try{
                $this->db_open();
                $stmt= $this->conn->prepare($query);
                $stmt->execute($params);
                $rowsAffected = $stmt->rowCount();
                $this->db_close();
                return $rowsAffected;
                //>0 exito = 0 error <0 ya está
            }
            catch(Exception $e){
                return 0;
            }
          

        }
        //Metodo de ejecutar consulta de seleccion
        protected function get_query($query,$params=array())
        {
            $rows= [];
            $this->db_open();
            $stmt = $this->conn->prepare($query);
            $stmt->execute($params);
            while($rows[]=$stmt->fetch(PDO::FETCH_ASSOC));
            $this->db_close();
            array_pop($rows);
            return $rows;
        }

        abstract function get();
        abstract function create();
        abstract function delete();
        abstract function update();
}
?>