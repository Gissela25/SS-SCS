<?php
    function isEmpty($var)
    {
        return empty(trim($var));
    }
    function isOnlyText($var)
    {
        return preg_match('/^(([a-zA-ZÁÉÍÓÚÑáéíóúñ]+)[ ]?([a-zA-ZÁÉÍÓÚÑáéíóúñ]+)?)+$/',$var);
    }
    function isText($variable)
    {
        return preg_match('/^(([a-zA-ZÁÉÍÓÚÑáéíóúñ0-9_.\-\,\/()?]+)[ ]?([a-zA-ZÁÉÍÓÚÑáéíóúñ0-9_.\-\,\/()?]+)?)+$/',$variable);
    }

    function esVar($var){
        return preg_match('/^[a-zA-Z0-9óáéúíñÁÉÓÍÚÑ ]+$/',$var);
    }
    function esMail($var)
    {
        return filter_var($var,FILTER_VALIDATE_EMAIL);
    }
    
    function isUser($var)
    {
        return preg_match('/^U[0-9]{5}$/',$var);
    }
    function isPassword($var)
    {
        return preg_match('/^[a-zA-Z0-9\&\%\$\#\+\*\(\)]{8,40}$/',$var);
    }
    function esInteger($var)
    {
        return preg_match('/^[0-9]+$/',$var);
    }

    function isCode($var)
    {
        return preg_match('/^[0-9]{8,15}$/',$var);
    }

    function esFloat($var)
    {
        return preg_match('/^[0-9]+([.]?[0-9]+)?$/',$var);
    }
?>