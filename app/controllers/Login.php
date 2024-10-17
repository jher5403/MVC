<?php
namespace Controller;

defined('ROOTPATH') OR exit('Error: Access denied.');

class Login
{
    use MainController;
    
    public function index()
    {
        
        $this->view('home');
    }
}