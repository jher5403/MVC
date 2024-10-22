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

    // Kept for legacy. Can probably just use the count() method instead.
    protected $totalUsers;
    protected $totalBlogs;

    function index()
    {
        $this->getTables();
        $this->view('admin');
    }

    /**
     * Returns all table row attributes for users and blogs.
     */
    function getTables()
    {
        $user = new User;
        $blog = new Blog;

        $this->userTable = ($user->findAll());
        $this->blogTable = ($blog->findAll());
        $this->totalUsers = count($this->userTable);
        $this->totalBlogs = count($this->blogTable);
    }


    /**
     * Inserts JQuery DataTable rows and cells.
     * 
     * A data row is created for every table row
     * A data cell is created created for every value.
     * Uses a switch statement to handle specific attribute keys.
     * 
     * 
     * @param string $table
     * The type of table to insert. Currently only 'users' and 'blogs'
     */
    function insertTable(string $table)
    {
        switch ($table) 
        {
            case 'users':
                foreach ($this->userTable as $row) {
                    echo "<tr>";
                    foreach ($row as $key => $value) {
                        switch ($key) {
                            case 'reset_token':
                            case 'token_expiration':
                            case 'token_created_time':
                                break;
                            case 'active':
                                $format_val = $this->formatActive($value);
                                echo "<td> {$format_val} </td>";
                                break;

                            case 'creation_date':
                                $format_val = $this->formatDateTime($value);
                                echo "<td> {$format_val} </td>";
                                break;

                            case 'modification_date': 
                                $format_val = $this->formatDateTime($value);
                                echo "<td> {$format_val} </td>";
                                break;

                            default:
                                echo "<td> {$value} </td>";
                                break;
                        }
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

    /**
     * Function to format the date and time.
     * 
     * @param string $dateString
     * String to be formatted.
     */
    function formatDateTime(string $dateString) {
        try {
            $date = new \DateTime($dateString);
            $datetimeLocalFormat = $date->format('Y-m-d\TH:i');
            return $datetimeLocalFormat;
        } catch (\Exception $e) {
            return "Invalid Date";
        }
    }

    /**
     * Function to format active value into a string value
     * 
     * @param $activeValue
     * Active value to be formatted.
     */
    function formatActive($activeValue) {
        try {
            if ($activeValue == "0") {
                return "Not Active";
            } else if ($activeValue == "1") {
                return "Active";
            }
        } catch (\Exception $e) {
            return "Invalid Active Value";
        }
    }

    /**
     * Action Page Query Adapting:
     * 
     * 1) Move all JavaScript from the modal into view or external js file.
     *      All Admin Modals are already included in page.
     * 2) Change the JavaScript fetch URL to controller method.
     *      Ex: fetch('actions/update-user.php') to fetch('admin/editUser/')
     *          'admin'     |   References the admin controller
     *          'editUser'  |   References the editUser() method in the controller.
     * 3) Create new query method in the controller.
     *      Recieve the data
     *      Create the model required class.
     *          User for user queries.
     *          Blog for blog queries.
     * 3) Adapt the formData keys to match the database table keys.
     *      Ex: blogId to blog_id,  creatorEmail to creator_email
     * 4) Modify the .then blocks in the fetch statements.
     *      The query doesn't return any sort of feedback for updates or deletes.
     *      Might have to change the logic to use the Promise state instead.
     * 5) Adapt re-display methods.
     *      Can redirect page with redirect(method or page ref);
     *      Can probably handle in JavaScript function.
     */

     /**
      * Edits a given user after recieving user attributes
      * 
      */
    function editUser()
    {
        $data = json_decode(file_get_contents("php://input"), true);
        //show($data);
        $email = $data['email'];
        $user = new User;
        
        $response = $user->update($email, $data, 'email');
        //print_r($response);
        json_encode($response, JSON_INVALID_UTF8_IGNORE);
        
    }

    function deleteUser()
    {
        $user = new User;
    }

    function editBlog()
    {
        $blog = new Blog;
    }

    function deleteBlog()
    {
        $blog = new Blog;
    }

}