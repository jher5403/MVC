<?php

class Home extends Controller
{
    public function index($a = '', $b = '', $c = '')
    {
        //echo 'Home Controller';

        $this->view('home');
    }
}
