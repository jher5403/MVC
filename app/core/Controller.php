<?php
namespace Controller;

defined('ROOTPATH') OR exit('Error: Access denied.');

/**
 * Handles nearly all the logic for and between the view and database.
 */
Trait MainController
{
    public function view($name)
    {
        $filename = "../app/views/".$name.".view.php";

        // If file exists, show view.
        if(file_exists($filename)) {
            require $filename;
        } else {
            $filename = "../app/views/_404.view.php";
            require $filename;
        }
    }
}