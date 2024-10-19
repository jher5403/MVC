<?php
namespace Model;

defined('ROOTPATH') OR exit('Error: Access denied');

class Book 
{
    use Model;

    protected $order_type = 'asc';
    protected $order_column = 'book_id';
    protected $table = 'alphabet_book';
    
    protected $allowed_columns = [

    ];
}