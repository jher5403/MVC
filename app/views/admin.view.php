<!--
Use and modify this template for other page views

Contains external CSS for Bootstrap and Components (Banner, Footer, etc...)
Contains JQuery and Boostrap script dependencies.
-->
<!doctype html>
<html lang="en" class="h-100" data-bs-theme="auto">

<head>
    <?php $this->view('includes/head.tag') ?>
    <link rel="stylesheet" type="text/css" href="<?=ROOT?>/assets/css/datatables.css"">
    <!--Add Head & CSS Content-->
    <title>Administration Settings</title>
</head>

<body>
    <?php $this->view('includes/modals') ?>
    <?php $this->view('includes/header') ?>

    <section id="page-body">
        <div class='container' id="main-body">
            <h1 class="display-5">Administration</h1>
            <h3>Users</h3>
            <table class="usersTable display" id="usersTable">
                <thead>
                    <tr>
                        <th>Email</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Password</th>
                        <th>Active</th>
                        <th>Role</th>
                        <th>Created Time</th>
                        <th>Modified Time</th>
                        <th>Reset Token</th>
                        <th>Token Expiration</th>
                        <th>Token Created Time</th>
                    </tr>
                </thead>
                <tbody>
                    <?= $this->insertTable('users'); ?>
                </tbody>
            </table>

            <h3>Blogs</h3>
            <table class="blogsTable display" id="blogsTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Creator Email</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Event Date</th>
                        <th>Creation Date</th>
                        <th>Modification Date</th>
                        <th>Privacy Filter</th>
                    </tr>
                </thead>
                <tbody>
                    <?= $this->insertTable('blogs'); ?>
                </tbody>
            </table>
        </div>
        </div>
    </section>

    <?php $this->view('includes/footer') ?>
    <!--Add Non Bootstrap & JQuery Libraries-->
    <script src="<?=ROOT?>/assets/js/datatables.js"></script>
    <script>
    setWidths();
    //setTables();

    function setWidths() {
        $(document).ready(function() {
            $('#usersTable').DataTable({
                "columns": [{
                        "width": "15%"
                    }, // Email
                    {
                        "width": "10%"
                    }, // First Name
                    {
                        "width": "10%"
                    }, // Last Name
                    {
                        "width": "15%"
                    }, // Password
                    {
                        "width": "5%"
                    }, // Active
                    {
                        "width": "8%"
                    }, // Role
                    {
                        "width": "10%"
                    }, // Created Time
                    {
                        "width": "10%"
                    }, // Modified Time
                    {
                        "width": "10%"
                    }, // Reset Token
                    {
                        "width": "10%"
                    }, // Token Expiration
                    {
                        "width": "10%"
                    } // Token Created Time
                ]
            });
        });
        $(document).ready(function() {
            $('#blogssTable').DataTable({
                "columns": [{
                        "width": "5%"
                    }, // blog ID
                    {
                        "width": "15%"
                    }, // creator email
                    {
                        "width": "10%"
                    }, // title
                    {
                        "width": "10%"
                    }, // description
                    {
                        "width": "10%"
                    }, // event date
                    {
                        "width": "10%"
                    }, // creation date
                    {
                        "width": "10%"
                    }, // modification date
                    {
                        "width": "10%"
                    }, // privacy filter
                ]
            });
        });
    }
    </script>
</body>

</html>