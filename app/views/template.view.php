<!--
Use and modify this template for other page views

Contains external CSS for Bootstrap and Components (Banner, Footer, etc...)
Contains JQuery and Boostrap script dependencies.
-->
<!doctype html>
<html lang="en" class="h-100" data-bs-theme="auto">

<head>
    <?php $this->view('includes/head.tag') ?>

    <!--Add Head & CSS Content-->
    <title>Template Page Title</title>
</head>

<body>
    <?php $this->view('includes/modals') ?>
    <?php $this->view('includes/header') ?>

    <section id="page-body">
        <div class='container' id="main-body">
            <h1 class="display-5">Template Header</h1>
            <!--Add Main Content-->
        </div>
    </section>

    <?php $this->view('includes/footer') ?>
    <!--Add Non Bootstrap & JQuery Libraries-->

    <script>
        // Get JavaScript PHP constants...
        // Run JavaScript Methods...
    </script>
</body>

</html>