<?php
namespace Controller;

use Model\{
    Blog,
    User,
};

defined('ROOTPATH') OR exit('Error: Access denied');

class Home
{
    use MainController;

    protected $displayType;
    protected $currentBlogs;

    public function index() 
    {
        $ses = new \Core\Session;
        $this->displayType = $ses->get('blog_display_type');
        $this->currentBlogs = $ses->get('public_blogs');

        // Use switchase maybe?
        if (empty($this->displayType))
        {
            $this->getPublicBlogs();
        }

        $this->view('home');
    }

    public function about()
    {
        $this->view('about');
    }
    
    public function getPublicBlogs()
    {
        $ses = new \Core\Session;
        $blog = new Blog;

        // Get only public blogs
        $arr['privacy_filter'] = 'public';
        $result = $blog->where($arr);

        // Adds image data (directory & file array) to 
        foreach($result as &$row) {
            $blog_dir = ('assets/images/blogs/'.$row->blog_id.'/');
            $blog_files = array_values(array_diff(scandir($blog_dir), array('..', '.')));
            $blog_images = array('dir' => $blog_dir, 'images' => $blog_files);
            (array)$row = array_merge((array)$row, $blog_images);
        }
        
        // Set public_blogs array as key
        $ses->set('public_blogs', json_encode($result));

        // Sets display type
        $ses->set('blog_display_type', 'Public Blogs');

        // Set values for attribute class
        $this->displayType = $ses->get('blog_display_type');
        $this->currentBlogs = $ses->get('public_blogs');

        //show($ses->get('public_blogs'));
        //$this->view('home');
    }

    public function getSelectBlogs($sort = '', $title='' ,$min = '', $max = '') {
        $blog = new Blog;

        switch ($sort) {
            case "A_ASC":
                $sort = "title ASC";
                break;
            case "A_DESC":
                $sort = "title DESC";
                break;
            case "CH_ASC":
                $sort = "event_date ASC";
                break;
            case "CH_DESC":
                $sort = "event_date DESC";
                break;
        }

        $result = $blog->between('event_date', "{$min}", "{$max}", "{$sort}", "{$title}");

        foreach($result as &$row) {
            $blog_dir = ('assets/images/'.$row->blog_id.'/');
            $blog_files = array_values(array_diff(scandir($blog_dir), array('..', '.')));
            $blog_images = array('dir' => $blog_dir, 'images' => $blog_files);
            (array)$row = array_merge((array)$row, $blog_images);
        }

        echo json_encode($result, JSON_INVALID_UTF8_IGNORE);
    }
    
    // Get Blogs sorted by creation date
    // Get Blogs by search bar
    // Get Blogs by chronology

    public function register()
    {
        $user = new User;
        $user->insert($_POST);
        redirect('home');
    }

    public function logout()
    {
        $ses = new \Core\Session;
        $ses->logout();
        redirect('home');
    }

    public function template()
    {
        
        $this->view('template');
    }


}
