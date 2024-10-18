<?php
defined('ROOTPATH') OR exit('Error: Access denied.');

/**
 * Loads a model?
 */
spl_autoload_register(function($classname)
{
    $classname = explode("\\", $classname);
    $classname = end($classname);
    require $filename = "../app/models/".ucfirst($classname).".php";
});

require 'config.php';
require 'functions.php';
require 'Database.php';
require 'Model.php';
require 'Controller.php';
require 'Session.php';
require 'App.php';