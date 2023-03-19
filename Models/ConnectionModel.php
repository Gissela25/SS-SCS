<?php
abstract class ConnectionModel
{

    private $db_host = "localhost";
    private $db_user = "root";
    private $db_pass = "";
    private $db_name = "ss-scs";
    protected $conn;

    public function __construct()
    {

    }

    protected function db_open()
    {
        try
        {
            $this->conn = new PDO("mysql: host=$this->db_host;dbname=$this->db_name;charset=utf8", $this->db_user, $this->db_pass);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

    }

    protected function db_close()
    {
        $this->conn = null;
    }

    //Actualización
    protected function set_query($query, $params = array())
    {
        try {
            $this->db_open();
            $stmt = $this->conn->prepare($query);
            $stmt->execute($params);
            $rowsAffected = $stmt->rowCount();
            $this->db_close();
            return $rowsAffected;
            //>0 exito = 0 error <0 ya está
        } catch (Exception $e) {
            return 0;
        }

    }
    //Metodo de ejecutar consulta de seleccion
    protected function get_query($query, $params = array())
    {
        $rows = [];
        $this->db_open();
        $stmt = $this->conn->prepare($query);
        $stmt->execute($params);
        while ($rows[] = $stmt->fetch(PDO::FETCH_ASSOC));
        $this->db_close();
        array_pop($rows);
        return $rows;
    }

    public function generateCodeUsers(){
        $generated_code = '';
        do {
            //Generamos un código aleatorio de 5 dígitos
            $code = rand(10000, 99999);
            //Añadimos la letra U al inicio
            $generated_code = 'U' . $code;
            //Verificamos si el código ya existe en la base de datos
            $query = "SELECT COUNT(*) FROM usuarios WHERE Id_Usuario = ?";
            $result = $this->get_query($query, [$generated_code]);
        } while ($result[0]["COUNT(*)"] > 0); //Mientras el código exista, seguimos generando uno nuevo
        return $generated_code;
    }

    abstract public function get();
    abstract public function create();
    abstract public function delete();
    abstract public function update();
}