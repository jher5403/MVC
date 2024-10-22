<!--
Use and modify this template for other page views

Contains external CSS for Bootstrap and Components (Banner, Footer, etc...)
Contains JQuery and Boostrap script dependencies.
-->
<!doctype html>
<html lang="en" class="h-100" data-bs-theme="auto">

<head>
    <?php $this->view('includes/head.tag') ?>
    <link rel="stylesheet" type="text/css" href="<?=ROOT?>/assets/css/my-blogs-grid.css">
    <!--Add Head & CSS Content-->
    <title>My Blogs</title>
</head>

<body>
    <?php $this->view('includes/modals') ?>
    <?php $this->view('includes/header') ?>
    <!--Create Blog Modal-->

    <section id="page-body">
        <div class='container' id="main-body">
            <h1 class="display-5">My Blogs</h1>

            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#newBlogModal">
                Create New Blog
            </button>

            <div id="searchContainer">
                <input type="text" id="searchInput" placeholder="Search by title...">
                <label for="startDate">Sort by creation date:</label>
                <input type="date" id="startDate" placeholder="Start Date" style="margin-left: 5px;">
                <input type="date" id="endDate" placeholder="End Date">
                <button id="searchButton">Search</button>
            </div>

            <div id="sortContainer">
                <label for="sortOrder">Display:</label>
                <select id="sortOrder">
                    <option value="asc">Alphabetically (A-Z)</option>
                    <option value="desc">Alphabetically (Z-A)</option>
                </select>
            </div>

            <div class="dropdown">
                <button class="options-button">...</button>
                <div class="dropdown-content">
                    <a href="#">Edit</a>
                    <a href="#">Delete</a>
                </div>
            </div>

            <!-- Posts Container for Grid -->
            <div id="postsContainer" class="grid-container"></div>

        </div>
    </section>

    <?php $this->view('includes/footer') ?>
    <!--Add Non Bootstrap & JQuery Libraries-->
    <script>

    const blogPosts = <?= $this->myBlogs?>;
    const postsContainer = document.getElementById('postsContainer');

    displayBlogs();

    function displayBlogs()
    {
        postsContainer.innerHTML = ''; // Clear previous posts

        blogPosts.forEach(post => {
            const blogContainer = document.createElement('div');
            blogContainer.className = 'blog-container';

            const blogUserContainer = document.createElement('div');
            blogUserContainer.className = 'blog-user-container';

            const userImage = document.createElement('img');
            userImage.src = 'assets/images/blank-user.jpg';
            userImage.alt = 'User Image';
            userImage.className = 'blog-user-image';

            const username = document.createElement('p');
            username.className = 'blog-username';
            username.textContent = post.creator_email;

            const creationDate = document.createElement('p');
            creationDate.className = 'blog-creation-date';
            creationDate.textContent = new Date(post.creation_date).toLocaleString();

            const blogTitle = document.createElement('h2');
            blogTitle.className = 'blog-title';
            blogTitle.textContent = post.title;

            const img = document.createElement('img');
            img.src = `${post.dir}${post.images[0]}`;
            img.alt = 'Blog Image';
            img.className = 'blog-photo';

            const blogDescription = document.createElement('p');
            blogDescription.className = 'blog-description';
            blogDescription.textContent = post.description;

            // Create dropdown for edit/delete options
            const optionsDropdown = document.createElement('div');
            optionsDropdown.className = 'dropdown';

            const optionsButton = document.createElement('button');
            optionsButton.className = 'options-button';
            optionsButton.innerHTML = '▼'; // Down caret

            const dropdownContent = document.createElement('div');
            dropdownContent.className = 'dropdown-content';

            const editLink = document.createElement('a');
            editLink.href = '#'; // Link to edit functionality
            editLink.textContent = 'Edit';

            const deleteLink = document.createElement('a');
            deleteLink.href = '#'; // Link to delete functionality
            deleteLink.textContent = 'Delete';

            dropdownContent.appendChild(editLink);
            dropdownContent.appendChild(deleteLink);
            optionsDropdown.appendChild(optionsButton);
            optionsDropdown.appendChild(dropdownContent);

            // Append elements to blogContainer
            blogUserContainer.appendChild(userImage);
            blogUserContainer.appendChild(username);
            blogUserContainer.appendChild(creationDate);
            blogContainer.appendChild(blogUserContainer);
            blogContainer.appendChild(blogTitle);
            blogContainer.appendChild(img);
            blogContainer.appendChild(blogDescription);
            blogContainer.appendChild(optionsDropdown); // Add dropdown to blogContainer
            postsContainer.appendChild(blogContainer);
        })
    }

    /*
    const fetchBlogs = (actionType, title = '', startDate = '', endDate = '', sortOrder = 'asc') => {
        fetch(
                `actions/${actionType}.php?title=${title}&start_date=${startDate}&end_date=${endDate}&sort_order=${sortOrder}`)
            .then(response => response.json())
            .then(blogPosts => {
                const postsContainer = document.getElementById('postsContainer');
                postsContainer.innerHTML = ''; // Clear previous posts

                if (blogPosts.message) {
                    const noResultsMessage = document.createElement('p');
                    noResultsMessage.textContent = blogPosts.message; // "No matching blogs found"
                    noResultsMessage.className = 'no-results-message';
                    postsContainer.appendChild(noResultsMessage);
                    return;
                }

                
                });
            })
            .catch(error => console.error('Error fetching blog posts:', error));
    };
    */

    // Initial fetch with default action
    //fetchBlogs('get-my-blogs');

    document.getElementById('searchButton').addEventListener('click', () => {
        const title = document.getElementById('searchInput').value;
        const startDate = document.getElementById('startDate').value;
        const endDate = document.getElementById('endDate').value;
        const sortOrder = document.getElementById('sortOrder').value;
        //fetchBlogs('get-my-blogs', title, startDate, endDate, sortOrder);
    });

    document.getElementById('searchInput').addEventListener('keydown', (event) => {
        if (event.key === 'Enter') {
            event.preventDefault();
            const title = document.getElementById('searchInput').value;
            const startDate = document.getElementById('startDate').value;
            const endDate = document.getElementById('endDate').value;
            const sortOrder = document.getElementById('sortOrder').value;
            //fetchBlogs('get-my-blogs', title, startDate, endDate, sortOrder);
        }
    });

    document.getElementById('sortOrder').addEventListener('change', () => {
        const title = document.getElementById('searchInput').value;
        const startDate = document.getElementById('startDate').value;
        const endDate = document.getElementById('endDate').value;
        const sortOrder = document.getElementById('sortOrder').value;
        //fetchBlogs('get-my-blogs', title, startDate, endDate, sortOrder);
    });
    document.addEventListener('DOMContentLoaded', () => {
        // Toggle the dropdown menu visibility when the button is clicked
        document.addEventListener('click', function(event) {
            // Get all dropdowns
            const dropdowns = document.querySelectorAll('.dropdown-content');

            // Close all dropdowns if the click is outside
            dropdowns.forEach(dropdown => {
                if (!dropdown.parentElement.contains(event.target)) {
                    dropdown.style.display = 'none';
                }
            });

            // If the clicked element is the dropdown button, toggle the respective menu
            if (event.target.classList.contains('options-button')) {
                const dropdownContent = event.target.nextElementSibling;
                dropdownContent.style.display = dropdownContent.style.display === 'block' ? 'none' :
                    'block';
            }
        });
    });
    </script>
</body>

</html>