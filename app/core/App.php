<?php
defined('ROOTPATH') OR exit('Error: Access denied.');

/**
 * Handles routing by URL. URL will reference controller if it exists in the controllers directory.
 * 
 * ...MVC/public/ Is the root.
 * 
 */
class App 
{
    private $controller = 'Home';
    private $method = 'index';

    private function splitURL()
    {
        $URL = $_GET['url'] ?? 'home';
        $URL = explode('/', trim($URL, '/'));
        return $URL;
    }

    public function loadController() 
    {

        $URL = $this->splitURL();

        /**
         * Selects Controller from url.
         */
        $filename = "../app/controllers/".ucfirst($URL[0]).'.php';
        if(file_exists($filename)) {
            require $filename;
            $this->controller = ucfirst($URL[0]);
            unset($URL[0]);

        } else {
            $filename = "../app/controllers/_404.php";
            require $filename;
            $this->controller = '_404';
        }

        $controller = new ('\Controller\\'.$this->controller);

        /**
         * Selects controller method from url.
         */
        if(!empty($URL[1])) 
        {
            if(method_exists($controller, $URL[1]))
            {
                $this->method = $URL[1];
                unset($URL[1]);
            }
        }
        call_user_func_array([$controller, $this->method], $URL);
    }
    
}

?>