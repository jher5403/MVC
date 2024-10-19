<?php
namespace Model;

defined('ROOTPATH') OR exit('Error: Access denied');

class Blog 
{
    use Model;

    protected $order_type = 'asc';
    protected $order_column = 'blog_id';
    protected $table = 'blogs';
    protected $allowed_columns = [
        'creator_email',
        'title',
        'description',
        'event_date',
        'privacy_filter',
    ];
}

