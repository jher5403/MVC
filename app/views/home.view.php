<!doctype html>
<html lang="en" class="h-100" data-bs-theme="auto">

<head>
    <?php $this->view('includes/head.tag') ?>
    
    <link rel="stylesheet" type="text/css" href="<?=ROOT?>/assets/css/blog-grid.css">
    <title>Home Page</title>
</head>

<body>
    <?php $this->view('includes/modals') ?>
    <?php $this->view('includes/header') ?>

    <section id="page-body">
        <div class='container' id="main-body">
            <h1 class="display-5">Home | <?=$this->displayType?></h1>

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
                    <option value="A_ASC">Alphabetically (A-Z)</option>
                    <option value="A_DESC">Alphabetically (Z-A)</option>
                    <option value="CH_ASC">Event Date (Oldest to Newest)</option>
                    <option value="CH_DESC">Event Date (Newest to Oldest)</option>
                </select>
            </div>

            <div class="row" id="blog-row"></div>
        </div>
    </section>

    <?php $this->view('includes/footer') ?>
    <script src="<?=ROOT?>/assets/js/blog.grid.js"></script>

    <script>
        
        const blogs = <?=$this->currentBlogs?>;
        displaySortedBlogs();
        
    </script>
</body>

</html>