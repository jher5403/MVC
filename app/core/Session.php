<?php

namespace Core;

defined('ROOTPATH') OR exit('Error: Access denied');

class Session
{

    public $mainkey = 'APP';
    public $userkey = 'USER';

    // Start session if not already started.
    private function start_session():int
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        return 1;
    }

    // Set session array or key.
    public function set(mixed $keyOrArr, mixed $value = ''):int
    {
        $this->start_session();

        if (is_array($keyOrArr))
        {
            foreach ($keyOrArr as $key => $value) {
                $_SESSION[$this->mainkey][$key] = $value;
            }
            return 1;
        }

        $_SESSION[$this->mainkey][$keyOrArr] = $value;

        return 1;
    }

    /**
     * Gets data from session. Default is returned if no data found.
     */
    public function get(string $key, mixed $default=''):mixed
    {
        $this->start_session();

        if(isset($_SESSION[$this->mainkey][$key]))
        {
            return $_SESSION[$this->mainkey][$key];
        }
        return $default;
    }

    /**
     * Stores user data into session after logging in.
     */
    public function auth(mixed $user_row):int
    {
        $this->start_session();
        $_SESSION[$this->userkey] = $user_row;
        return 0;
    }

    /**
     * Removes logged in user data from session.
     */
    public function logout():int
    {
        $this->start_session();
        if(!empty($_SESSION[$this->userkey]))
        {
            unset($_SESSION[$this->userkey]);
        }
        return 0;
    }

    /**
     * Returns true if USER session key exists. Returns false otherwise.
     */
    public function is_logged():bool
    {
        $this->start_session();
        if(!empty($_SESSION[$this->userkey]))
        {
            return true;
        }
        return false;
    }

    /**
     * Gets an attribute from current user by key.
     */
    public function user(string $key = '', mixed $default=''):mixed
    {
        $this->start_session();
        
        if (empty($key) && !empty($_SESSION[$this->userkey])) {
            return $_SESSION[$this->userkey];
        } else {
            if(!empty($_SESSION[$this->userkey]->$key)) {
                return $_SESSION[$this->userkey]->$key;
            }
        }
        return $default;
    }

    /**
     * Returns data from key and deletes it.
     */
    public function pop(string $key = '', mixed $default=''):mixed
    {
        $this->start_session();
        
        if(!empty($_SESSION[$this->mainkey][$key])) {
            $value = $_SESSION[$this->mainkey][$key];
            unset($_SESSION[$this->mainkey][$key]);
            return $value;
        }
        
        return $default;
    }

    /**
     * Returns all data from mainkey array.
     */
    public function all():mixed
    {
        $this->start_session();
        
        if(isset($_SESSION[$this->mainkey])) 
        {
            return $_SESSION[$this->mainkey];
        }
        
        return [];
    }
}