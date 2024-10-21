<!doctype html>
<html lang="en" class="h-100" data-bs-theme="auto">

<head>
    <?php $this->view('includes/head.tag') ?>

    <link rel="stylesheet" type="text/css" href="<?=ROOT?>/assets/css/alpha.css">
    <title>Alphabet Book</title>
</head>

<body>
    <?php $this->view('includes/modals') ?>
    <?php $this->view('includes/header') ?>
    <?php $this->view('includes/modals/abook.modal') ?>

    <section id="page-body">
        <div class='container' id="main-body">

            <div class="container" id='book-bar'>
                <div class="row align-items-start flex-nowrap overflow-x-scroll" id="book-bar-row"></div>
            </div>

            <div class="container" id='book-content'>
                <div class="container row" id="util-bar">

                    <div class="container" id="progress-bar">
                        <h2 style="text-align: center;">Book Completion</h2>

                        <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
                            <div class="progress-bar w-75"></div>
                        </div>

                    </div>

                    <div class='col'>
                        <button type="button" class="btn btn-primary" id='update-button' onclick="updateBook()">Save Blog</button>
                    </div>
                    

                </div>
                    

                <!-- Styling to grid for height -->
                <div class='container' id='alpha-grid'>
                    <div class="row justify-content-center" id="alpha-grid-row"></div>
                </div>
                
            </div>
        </div>
    </section>

    <?php $this->view('includes/footer') ?>

    <script src="<?=ROOT?>/assets/js/abook-grid.js"></script>
    <script>

    const user_books = <?= $this->user_books ?>;
    const user_blogs = <?= $this->user_blogs ?>;
    console.log(user_blogs);
    displayBar();
    
    </script>

</body>

</html>