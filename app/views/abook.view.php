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

    <section id="page-body">
        <div class='container' id="main-body">

            <div class="container" id='book-bar'>
                <div class="row align-items-start flex-nowrap overflow-x-scroll" id="book-bar-row">

                    <div class='card bar-card'>
                        <div class='card-header'>
                            Book Title
                        </div>
                        <div class='card-body'>
                            Image
                        </div>
                    </div>

                    <div class='card bar-card'>
                        <div class='card-body'>
                            Add New Book Card
                        </div>
                    </div>

                </div>
            </div>

            <div class="container" id='book-content'>

                <div class="container" id="progress-bar">
                    <h2 style="text-align: center;">Book Completion</h2>

                    <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="75"
                        aria-valuemin="0" aria-valuemax="100">
                        <div class="progress-bar w-75"></div>
                    </div>
                </div>

                <div class='container' id='alpha-grid'>
                    <div class="row justify-content-center" id="alpha">

                        <div class='card a-grid' id="a">
                            <div class='card-header'>
                                A Title
                            </div>
                            <div class='card-body'>
                                Image
                            </div>
                        </div>

                        <div class='card a-grid' id="b">
                            <div class='card-header'>
                                B Title
                            </div>
                            <div class='card-body'>
                                Image
                            </div>
                        </div>

                        <div class='card a-grid' id="c">
                            <div class='card-header'>
                                C Title
                            </div>
                            <div class='card-body'>
                                Image
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php $this->view('includes/footer') ?>
    <script>
    /*
        Book Bar:
        Get abook table content for current user.
        Select book. (Maybe open first book available?)
        OnClick: Open grid for lettered blogs.

        Selected Book Contents:
        OnClick: Open menu to add other blogs.
        
        Menu: Features small list of blogs whose letter starts with title.
        If saved to session: Sort array const per title?
        Otherwise: Use AJAX for dynamic query for menu.

        Save Mechanism: Once per blog (26 queries per manual entry)
        Save Mechanism: All at once? (1 query for array?)
        */
    </script>
</body>

</html>