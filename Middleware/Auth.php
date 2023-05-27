<?php
    class Auth{
        //Verificando si existe una sesión.
        public static function checkAuth()
        {
            if(!isset($_SESSION['dataBuffer']))
            {
                $path = PATH;
                header("Location: ".$path."Index");
            }
        }

        public static function checkUser()
        {
            $path = PATH;
            if($_SESSION['dataBuffer']['Tipo_Usuario'] == 1)
            {
                header("Location: ".$path."articles");
            }
        }

    }
?>