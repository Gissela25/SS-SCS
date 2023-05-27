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

    //Funcion de generar codigos, aplicable y modificable para las otras tablas
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


    public function generateCodeUsersDate($nameComplete = '', $lastnameComplete = '') {
        $generated_code = '';
        do {
            // Generamos un número aleatorio de dos cifras
            $numero_aleatorio = rand(10, 99);
    
            // Obtenemos la primera letra del nombre y apellido
            $nombre = strtoupper(substr($nameComplete, 0, 1));
            $apellido = strtoupper(substr($lastnameComplete, 0, 1));
            $year = date('y');
            // Concatenamos las primeras letras, el número aleatorio y el código
            $generated_code = $nombre . $apellido . $year.$numero_aleatorio;
    
            // Verificamos si el código ya existe en la base de datos
            $query = "SELECT COUNT(*) FROM usuarios WHERE Id_Usuario = ?";
            $result = $this->get_query($query, [$generated_code]);
        } while ($result[0]["COUNT(*)"] > 0); // Mientras el código exista, seguimos generando uno nuevo
    
        return $generated_code;
    }
    

    //Generar codigo para Departamentos
    public function generateCodeDeparments(){
        $generated_code = '';
        do {
            $code = rand(10000, 99999);
            $generated_code = 'D' . $code;
            $query = "SELECT COUNT(*) FROM departamentos WHERE Id_Departamento = ?";
            $result = $this->get_query($query, [$generated_code]);
        } while ($result[0]["COUNT(*)"] > 0);
        return $generated_code;
    }

    //Generar codigo para Presentacion
    public function generateCodePresentations(){
        $generated_code = '';
        do {
            $code = rand(100, 999);
            $generated_code = 'P' . $code;
            $query = "SELECT COUNT(*) FROM presentaciones WHERE Id_Presentacion = ?";
            $result = $this->get_query($query, [$generated_code]);
        } while ($result[0]["COUNT(*)"] > 0);
        return $generated_code;
    }

    //Generar codigo para Area
    public function generateCodeAreas(){
        $generated_code = '';
        do {
            $code = rand(10000, 99999);
            $generated_code = 'A' . $code;
            $query = "SELECT COUNT(*) FROM areas WHERE Id_Area = ?";
            $result = $this->get_query($query, [$generated_code]);
        } while ($result[0]["COUNT(*)"] > 0);
        return $generated_code;
    }

    public function generateCodeArticules(){
        $generated_code = '';
        do {
            $code = rand(10000000000000, 99999999999999);
            $generated_code = 'I' . $code;
            $query = "SELECT COUNT(*) FROM articulos WHERE Id_Articulo = ?";
            $result = $this->get_query($query, [$generated_code]);
        } while ($result[0]["COUNT(*)"] > 0);
        return $generated_code;
    }

    public function generateCodeExistencias(){
        $generated_code = '';
        do {
            $code = rand(10000000000000, 99999999999999);
            $generated_code = 'E' . $code;
            $query = "SELECT COUNT(*) FROM existencias WHERE Id_Existencia = ?";
            $result = $this->get_query($query, [$generated_code]);
        } while ($result[0]["COUNT(*)"] > 0);
        return $generated_code;
    }

    public function generateCodeCorrelative(){
        $generated_code = '';
        $date = date('Ymd'); // Obtiene la fecha actual en el formato "ymd"
        do {
            $random_digits = mt_rand(1000, 9999); // Genera 4 números aleatorios
            $generated_code = $date . $random_digits;
            $query = "SELECT COUNT(*) FROM correlativos WHERE Id_Correlativo = ?";
            $result = $this->get_query($query, [$generated_code]);
        } while ($result[0]["COUNT(*)"] > 0);
        return $generated_code;
    }
    

    
    

    abstract public function get();
    abstract public function create();
    abstract public function delete();
    abstract public function update();
}