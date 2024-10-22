<?php
namespace Controller;

// Necessary directory references to create objects.
use Model\{
    Blog,
    User,
};

// Prevents direct URL referencing.
defined('ROOTPATH') OR exit('Error: Access denied');

class Template
{

    // Essentially just extends the Controller superclass.
    use MainController;

    // Is called when routed by URL.
    function index()
    {

        $this->view('template');
    }
}