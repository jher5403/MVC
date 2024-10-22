<?php
namespace Model;

defined('ROOTPATH') OR exit('Error: Access denied.');

class User
{
    use Model;

    protected $order_type = 'asc';
    protected $order_column = 'email';
    protected $table = 'users';
    protected $allowed_columns = [
        'first_name',
        'last_name',
        'password',
        'email',
    ];
}