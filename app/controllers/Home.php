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
        // Start session?
        // Get and store public blogs.
        // Call blogs array into js const.
        // Show public blogs.
        $ses = new \Core\Session;
        $blog = new Blog;

        // Get only public blogs
        $arr['privacy_filter'] = 'public';
        $result = $blog->where($arr);

        // Adds image data (directory & file array) to 
        foreach($result as &$row) {
            $blog_dir = ('assets/images/'.$row->blog_id.'/');
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
        $this->view('home');
    }

    public function register()
    {
        //show($_POST);
        $user = new User;
        $user->insert($_POST);
        redirect('home');
    }

}
