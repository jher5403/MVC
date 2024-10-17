<?php
namespace Controller;

defined('ROOTPATH') OR exit('Error: Access denied.');

class Register
{
    use MainController;
    
    public function index()
    {
        
        $this->view('blogs');
    }
}