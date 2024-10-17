<?php
namespace Controller;

defined('ROOTPATH') OR exit('Error: Access denied.');

class _404
{
    use MainController;

    public function index()
    {
        echo '404 Controller not Found';
    }
}