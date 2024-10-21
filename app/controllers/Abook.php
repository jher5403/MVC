<?php
namespace Controller;

use Model\{
    Book,
    User,
    Blog,
};

defined('ROOTPATH') OR exit('Error: Access denied');

class Abook
{
    use MainController;

    protected $user_books;
    protected $user_blogs;

    public function index()
    {
        $ses = new \Core\Session;
        $blog = new Blog;
        $book = new Book;
        $user_email = $ses->get('USER')[0]->email;

        $blogsResult = $blog->whereSimple('*', "creator_email = '{$user_email}'");

        foreach($blogsResult as &$row) {
            $blog_dir = ('assets/images/blogs/'.$row->blog_id.'/');
            $blog_files = array_values(array_diff(scandir($blog_dir), array('..', '.')));
            $blog_images = array('dir' => $blog_dir, 'images' => $blog_files);
            (array)$row = array_merge((array)$row, $blog_images);
        }

        $booksResult = $book->whereSimple('*', "creator_email = '{$user_email}'");

        $this->user_blogs = json_encode($blogsResult);
        $this->user_books = json_encode($booksResult);

        $this->view('abook');
    }

    // Create New Book
    public function newBook()
    {
        $ses = new \Core\Session;
        $creator_email = $ses->get('USER')[0]->email;
        
        $book = new Book;
        $book->insert(array('creator_email' => $creator_email));
        $updatedBooksArr = $book->whereSimple('*', "creator_email = '{$creator_email}'");
        $this->user_books = $updatedBooksArr;
    }

    public function updateBook($newBook)
    {
        $newBook = json_decode($newBook, true);
        $id = $newBook['book_id'];
        $book = new Book;
        
        $book->update($id, $newBook, 'book_id');
    }

    // Test Set Current User
    public function setUser()
    {
        $ses = new \Core\Session;
        $user = new User;
        $arr['email'] = 'bob@example.com';

        $logged_user = $user->where($arr);
        $ses->set('USER', $logged_user);

        redirect('abook');
    }

    public function reset() 
    {
        session_start();
        session_destroy();
        redirect('abook');
    }
    
}