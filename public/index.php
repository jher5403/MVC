<?php 
session_start();

// Check for valid php version.
$minPHPVersion = '8.0';
if(phpversion() < $minPHPVersion) {
    die("PHP Version must be {$minPHPVersion} or higher. Current version is " . phpversion());
}

/**Path to index.php */
define('ROOTPATH', __DIR__ . DIRECTORY_SEPARATOR);

require '../app/core/init.php';

// If DEBUG is true: run first method. Else run second method.
DEBUG ? ini_set('display_errors', 1) : ini_set('display_errors', 0);
$app = new App;
$app->loadController();