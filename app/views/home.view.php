<!doctype html>
<html lang="en" class="h-100" data-bs-theme="auto">

<head>
    <?php $this->view('includes/head.tag') ?>
    
    <link rel="stylesheet" type="text/css" href="<?=ROOT?>/assets/css/blog-grid.css">
    <title>Template Page Title</title>
</head>

<body>
    <?php $this->view('includes/modals') ?>
    <?php $this->view('includes/header') ?>

    <section id="page-body">
        <div class='container' id="main-body">
            <h1 class="display-5">Home | <?=$this->displayType?> </h1>
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