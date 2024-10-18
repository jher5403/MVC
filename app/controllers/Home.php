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

        // Set public_blogs array as 
        $result = $blog->where($arr);
        $ses->set('public_blogs', $result);

        // Sets display type
        $ses->set('blog_display_type', 'Public Blogs');

        // Show value in session array.
        $this->displayType = $ses->get('blog_display_type');
        show($ses->get('public_blogs'));
        $this->view('home');
    }

    public function register()
    {
        show($_POST);
        $user = new User;
        $user->insert($_POST);
        redirect('home');
    }

}
