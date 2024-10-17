<?php
namespace Controller;

use Model\User;

defined('ROOTPATH') OR exit('Error: Access denied');

class Home
{
    use MainController;

    public function index()
    {
        
        $this->view('home');
    }
}
