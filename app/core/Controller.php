<?php
namespace Controller;

defined('ROOTPATH') OR exit('Error: Access denied.');

Trait MainController
{
    public function view($name)
    {
        $filename = "../app/views/".$name.".view.php";

        if(file_exists($filename)) {
            require $filename;
        } else {
            $filename = "../app/views/_404.view.php";
            require $filename;
        }
    }
}