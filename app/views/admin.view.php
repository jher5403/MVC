<!doctype html>
<html lang="en" class="h-100" data-bs-theme="auto">

<head>
    <?php $this->view('includes/head.tag') ?>
    <link rel="stylesheet" type="text/css" href="<?=ROOT?>/assets/css/tables.css">
    <link rel="stylesheet" type="text/css" href="<?=ROOT?>/assets/css/datatables.css">
    <!--Add Head & CSS Content-->
    <title>Administration Settings</title>
</head>

<body>
    <?php $this->view('includes/modals') ?>
    <?php $this->view('includes/header') ?>
    <?php $this->view('includes/admin.modal') ?>

    <section id="page-body">
        <div class='container' id="main-body">
            <section>
                <h1 class="display-5">Administration</h1>
                <div class=" tableContainer">
                    <h3>Users</h3>
                    <table id="usersTable" class="display">
                        <thead>
                            <tr id="header">
                                <th>Email</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Password</th>
                                <th>Active</th>
                                <th>Role</th>
                                <th>Created Time</th>
                                <th>Modified Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?= $this->insertTable('users');?>
                        </tbody>
                    </table>
                    <button id="editUserButton">Edit User</button>
                    <button id="deleteUserButton">Delete User</button>
                </div>
            </section>
            </br>
            <section>

                <div class="tableContainer">
                    <h3>Blogs</h3>
                    <table id="blogsTable" class="display">
                        <thead>
                            <tr id="header">
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
                            <?= $this->insertTable('blogs');?>
                        </tbody>
                    </table>
                    <button id="editBlogButton">Edit Blog</button>
                    <button id="deleteBlogButton">Delete Blog</button>
                </div>
            </section>
            </br>

            <section>
                <div class="tableContainer">
                    <h3>Site Counts</h3>
                    <table id="countsTable" class="display">
                        <thead>
                            <tr id="header">
                                <th>Count Type</th>
                                <th>Total Count</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Total Number of Users</td>
                                <td><?php echo $this->totalUsers; ?></td>
                            </tr>
                            <tr>
                                <td>Total Number of Blog Entries</td>
                                <td><?php echo $this->totalBlogs; ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </section>
            </br>

        </div>
        </div>
    </section>

    <?php $this->view('includes/footer') ?>
    <!--Add Non Bootstrap & JQuery Libraries-->
    <script src="<?=ROOT?>/assets/js/datatables.js"></script>
    <script>
    $(document).ready(function() {
        $('#usersTable').DataTable();
        $('#blogsTable').DataTable();
        $('#countsTable').DataTable();

        const usersTable = new DataTable('#usersTable');
        const blogsTable = new DataTable('#blogsTable');
        const countsTable = new DataTable('#countsTable');

        usersTable.on('click', 'tbody tr', function(e) {
            if ($(this).hasClass('selected')) {
                $(this).removeClass('selected');
            } else {
                $('#usersTable tbody tr').removeClass('selected');
                $(this).addClass('selected');
            }
        });

        // Click listener for the Edit user button
        $('#editUserButton').on('click', function() {
            const selectedRow = $('#usersTable tbody tr.selected');

            if (selectedRow.length === 0) {
                alert('Please select a user to edit.');
                return;
            }

            const email = selectedRow.find('td:eq(0)').text(); // Email
            const firstName = selectedRow.find('td:eq(1)').text(); // First Name
            const lastName = selectedRow.find('td:eq(2)').text(); // Last Name
            const password = selectedRow.find('td:eq(3)').text(); // Password
            const active = selectedRow.find('td:eq(4)').text(); // Active
            const role = selectedRow.find('td:eq(5)').text(); // Role

            // Fill in fields in the modal
            $('#editEmail').text(email);
            $('#editFirstName').val(firstName);
            $('#editLastName').val(lastName);
            $('#editPassword').val(password);
            $('#active').val(active);
            $('#role').val(role);

            $('#editUserModal').modal('show');
        });

        // Click listener for the Delete user button
        $('#deleteUserButton').on('click', function() {
            const selectedRow = $('#usersTable tbody tr.selected');

            if (selectedRow.length === 0) {
                alert('Please select a user to delete.');
                return;
            }

            const email = selectedRow.find('td:eq(0)').text(); // Email

            // Fill in fields in the modal
            $('#deleteEmail').text(email);

            $('#deleteUserModal').modal('show');
        });

        blogsTable.on('click', 'tbody tr', function(e) {
            if ($(this).hasClass('selected')) {
                $(this).removeClass('selected');
            } else {
                $('#blogsTable tbody tr').removeClass('selected');
                $(this).addClass('selected');
            }
        });

        // Click listener for the Edit blog button
        $('#editBlogButton').on('click', function() {
            const selectedRow = $('#blogsTable tbody tr.selected');

            if (selectedRow.length === 0) {
                alert('Please select a blog to edit.');
                return;
            }

            const blogId = selectedRow.find('td:eq(0)').text(); // Blog ID
            const creatorEmail = selectedRow.find('td:eq(1)').text(); // Creator Email
            const title = selectedRow.find('td:eq(2)').text(); // Title
            const description = selectedRow.find('td:eq(3)').text(); // Description
            const eventDate = selectedRow.find('td:eq(4)').text(); // Event Date
            const creationDate = selectedRow.find('td:eq(5)').text(); // Creation Date
            const modificationDate = selectedRow.find('td:eq(6)').text(); // Modification Date
            const privacyFilter = selectedRow.find('td:eq(7)').text(); // Privacy Filter

            // Fill in form fields in the modal
            $('#BlogId').text(blogId);
            $('#editCreatorEmail').text(creatorEmail);
            $('#editTitle').val(title);
            $('#editDescription').val(description);
            $('#editEventDate').val(eventDate);
            $('#editCreationDate').val(creationDate);
            $('#editModificationDate').val(modificationDate);
            $('#editPrivacyFilter').val(privacyFilter);

            $('#editBlogModal').modal('show');
        });

        // Click listener for the Delete blog button
        $('#deleteBlogButton').on('click', function() {
            const selectedRow = $('#blogsTable tbody tr.selected');

            if (selectedRow.length === 0) {
                alert('Please select a blog to delete.');
                return;
            }

            const blogId = selectedRow.find('td:eq(0)').text(); // Blog ID
            const creatorEmail = selectedRow.find('td:eq(1)').text(); // Creator Email
            const title = selectedRow.find('td:eq(2)').text(); // Title
            const description = selectedRow.find('td:eq(3)').text(); // Description

            // Fill in form fields in the modal
            $('#deleteBlogId').text(blogId);
            $('#deleteCreatorEmail').text(creatorEmail);
            $('#deleteTitle').text(title);
            $('#deleteDescription').text(description);

            $('#deleteBlogModal').modal('show');
        });

        countsTable.on('click', 'tbody tr', function(e) {
            if ($(this).hasClass('selected')) {
                $(this).removeClass('selected');
            } else {
                $('#countsTable tbody tr').removeClass('selected');
                $(this).addClass('selected');
            }
        });
    });

    function saveUserChanges() {
        const formData = {
            email: document.getElementById('editEmail').innerText,
            first_name: document.getElementById('editFirstName').value,
            last_name: document.getElementById('editLastName').value,
            password: document.getElementById('editPassword').value,
            active: document.getElementById('editActive').value,
            role: document.getElementById('editRole').value
        };

        // AJAX request
        fetch('admin/editUser/', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(formData),
        })
        .then(response => console.log(response.text()))
        /*
        .then(data => {
            if (data.success) {
                alert('User updated successfully!');
                location.reload();
            } else {
                alert('Error updating user: ' + data.message);
            }
        })
        .catch((error) => {
            console.error('Error:', error);
        });
        */
    }

    </script>
</body>

</html>