<?php

namespace Core;

defined('ROOTPATH') OR exit('Error: Access denied');

class Request
{
    /**
     * Returns post method.
     */
    public function method():string
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    /**
     * Checks if post method is POST and had element in array.
     */
    public function posted():bool
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST' && count($_POST) > 0)
        {
            return true;
        }
        return false;
    }

    /**
     * Get value from POST variable.
     */
    public function post(string $key = '', mixed $default = ''):mixed
    {
        if (empty($key))
        {
            return $_POST;
        } else if (isset($_POST[$key])) 
        {
            return $_POST[$key];
        }
        return $default;
    }

    /**
     * Get value from FILES variable.
     */
    public function files(string $key = '', mixed $default = ''):mixed
    {
        if(empty($key))
        {
            return $_FILES;
        } else if (isset($_FILES[$key])) 
        {
            return $_FILES[$key];
        }
        return $default;
    }

    /**
     * Get value from GET variable.
     */
    public function get(string $key = '', mixed $default = ''):mixed
    {
        if (empty($key))
        {
            return $_GET;
        } else if (isset($_GET[$key])) 
        {
            return $_GET[$key];
        }
        return $default;
    }

    /**
     * Get value from REQUEST variable.
     */
    public function input(string $key = '', mixed $default = ''):mixed
    {
        if (isset($_REQUEST[$key]))
        {
            return $_REQUEST[$key];
        }
        return $default;
    }

    /**
     * Get all values from REQUEST variable.
     */
    public function all():mixed
    {
        return $_REQUEST;
    }
}