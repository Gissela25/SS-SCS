<?php
abstract class Controller{
    public function render($view, $viewBag=array())
    {
        $file = "Views/".static::class."/".$view;
        $file=str_replace("Controller","",$file);
        if(is_file($file))
        {
            extract($viewBag);
            ob_start();//Abriendo el buffer
            require($file);
            $content=ob_get_contents();//Leyendo el contenido
            ob_end_clean();
            echo $content;

        }
        else{
            echo "<h1>No existe este archivo</h1>";
        }
    }
}
?>