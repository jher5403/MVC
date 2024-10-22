<?php
namespace Controller;

use Model\{
    Book,
    User,
    Blog,
};

defined('ROOTPATH') OR exit('Error: Access denied');

class Admin
{
    use MainController;

    protected $userTable;
    protected $blogTable;
    protected $bookTable;

    function index()
    {
        $this->getTables();

        //show($this->userTable);
        //show($this->blogTable);
        $this->insertTable('users');

        $this->view('admin');
    }

    function getTables()
    {
        $user = new User;
        $blog = new Blog;

        $userArr = [];
        $blogArr = [];

        $this->userTable = ($user->findAll());
        $this->blogTable = ($blog->findAll());

        //$this->userTable = json_encode($user->findAll());
        //$this->blogTable = json_encode($blog->findAll());
    }

    function insertTable($table)
    {
        switch ($table) 
        {
            case 'users':
                foreach ($this->userTable as $row) {
                    echo "<tr>";
                    foreach ($row as $key => $value) {
                        echo "<td> {$value} </td>";
                    }
                    echo "</tr>";
                }
                break;
            
            case 'blogs':
                foreach ($this->blogTable as $row) {
                    echo "<tr>";
                    foreach ($row as $key => $value) {
                        echo "<td> {$value} </td>";
                    }
                    echo "</tr>";
                }
                break;
        }
    }

}