<?php
namespace Controller;

use Model\{
    Book,
    User,
};

defined('ROOTPATH') OR exit('Error: Access denied');

class Abook
{
    use MainController;

    protected $current_books;

    public function index()
    {
        $ses = new \Core\Session;
        //show($ses->get('USER'));
        $this->current_books = $ses->get('current_books');

        $this->view('abook');
    }

    // Query the alphabet book table.
    public function getBooks() 
    {
        $ses = new \Core\Session;
        $current_user = $ses->get('USER');
        $book = new Book;
        show($current_user[0]->email);
        $result = $book->whereSimple('*', "creator_email = '" . $current_user[0]->email . "'");
        //show($result);

        $result = json_encode($result, JSON_INVALID_UTF8_IGNORE);

        $ses->set('current_books', $result);


        $this->current_books = $ses->get('current_books');
        show($this->current_books);
    }

    // Show book contents when clicked.
    public function display_grid() {
        // Query book contents A-Z
        // Generates entries
        // 
    }

    // Query all the blogs for every element that isn't null.
    public function newBook()
    {

    }

    // Query all blogs for every element on click.
    public function slotBlogs()
    {

    }

    public function test($book_id)
    {
        echo $book_id;
    }

    // Count non null letters
    public function getProgress()
    {
        
    }

    // Test Set Current User
    public function setUser()
    {
        $ses = new \Core\Session;
        $user = new User;
        $arr['email'] = 'bob@example.com';

        $logged_user = $user->where($arr);
        //show($logged_user);

        //$_SESSION['USER'] = $logged_user; Equivalent to below.
        $ses->set('USER', $logged_user);
        //show($ses->get('USER'));
    }
    
}