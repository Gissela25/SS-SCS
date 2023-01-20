<?php
    class Routing{
        public $url;
        public $controller;
        public $method;
        public $param;

        function __construct()
        {
            $var="";
            $this->url = explode("/", $_SERVER['REQUEST_URI']);
            $this->controller = empty($this->url[2]) ? 'Index' : $this->url[2];
            $this->controller .= 'Controller';
            $this->method = empty($this->url[3]) ? 'Index' : $this->url[3];
            $this->param = empty($this->url[4]) ? $var : $this->url[4];
        }


    }
?>