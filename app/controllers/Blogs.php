<?php
namespace Controller;

defined('ROOTPATH') OR exit('Error: Access denied.');

class Blogs
{
    use MainController;
    
    /**Where Example. Returns all public blogs.
            $arr['privacy_filter'] = 'public';
            $result = $blog->where($arr);
        
        Insert Example. Inserts blog with following attributes.
            $arr['creator_email'] = 'example@example.com';
            $arr['title'] = 'Generic Blog Title';
            $arr['description'] = 'Generic Description';
            $arr['event_date'] = date('2024-12-02');
            $result = $blog->insert($arr);

        Delete Example. Deletes the blog with id=21.
            $result = $blog->delete(21);

        Update Example. Changes title of first blog.
            $arr['title'] = 'A for AI';
            $result = $blog->update(1, $arr);

        Find All Example. Returns all blogs.
            $result = $blog->findAll();

        Shows Result Array.
            show($result); */

    public function index()
    {
        $this->view('blogs/blogs');
    }
}