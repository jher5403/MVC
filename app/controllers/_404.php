<?php
namespace Controller;

defined('ROOTPATH') OR exit('Error: Access denied.');

class _404
{
    use MainController;

    public function index()
    {
        $this->view('_404');
    }
}