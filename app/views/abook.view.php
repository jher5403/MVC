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

                <!-- Styling to grid for height -->
                <div class='container' id='alpha-grid'>
                    <div class="row justify-content-center" id="alpha-grid-row">

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

    const user_books = <?= $this->current_books ?>;
    const booksRow = document.getElementById('book-bar-row');
    const alpha_grid = document.getElementById('alpha-grid-row');

    clearContainer(alpha_grid);
    displayBar();

    function displayBar() {
        clearContainer(booksRow);

        user_books.forEach(book => {
            createBarCard(book);
        });
    }

    function clearContainer(container)
    {
        container.innerHTML = '';
    }

    function showGrid(book) {
        const letters = book;
        delete letters['creator_email'];
        delete letters['book_id'];
        entries = Object.entries(letters);

        entries.forEach(pair => {
            const letter = pair[0];
            let blog_id = pair[1];

            if (blog_id == null) {
                //console.log(`Null at ${letter}`)
                createBlankGridCard(letter);
            } else {
                // Get blog from blog id?
                // Maybe query with async method?
            }
        });
        // If null, just print the array key (will be letter).
        // Else cast referenced grid by blog_id.
    }

    function createBarCard(book) 
    {
        
        const card = document.createElement("div");
        card.className = 'card bar-card';

            const cardHeader = document.createElement("div");
            cardHeader.className = "card-header";
            cardHeader.innerHTML = `Book ${book.book_id}`

            const cardBody = document.createElement("div");
            cardBody.className = "card-body";

                // Upload an image, or pick from existing blog image

                const cardLink = document.createElement("a");
                cardLink.className = 'stretched-link';
                cardLink.href = '#';
                cardLink.onclick = function () { showGrid(book) };

                
        card.appendChild(cardHeader);
        card.appendChild(cardBody);
        cardBody.appendChild(cardLink);
        booksRow.appendChild(card);

        /*
        <div class='card bar-card'>
            <div class='card-header'>
                Book Title
            </div>

            <div class='card-body'>
                Image
                <a class="stretched-link" 
                    href="abook/display_grid"></a>
            </div>
        </div>
    */
    }

    function createGridCard(blog)
    {
        const card = document.createElement("div");
        card.className = 'card a-grid';
        card.id = `${blog.blog_id}`;

            const cardHeader = document.createElement("div");
            cardHeader.className = "card-header";
            cardHeader.innerHTML = `${blog.title}`;

            const cardBody = document.createElement("div");
            cardBody.className = "card-body";

                // Upload an image, or pick from existing blog image

                const cardLink = document.createElement("a");
                cardLink.className = 'stretched-link';
                cardLink.href = '#';
                cardLink.onclick = function () { /** Attach to modal menu element */ };

                
        card.appendChild(cardHeader);
        card.appendChild(cardBody);
        cardBody.appendChild(cardLink);
        alpha_grid.appendChild(card);

        /*
        <div class='card a-grid' id="a">

            <div class='card-header'>
                A Title
            </div>

            <div class='card-body'>
                Image
            </div>

        </div>
        */
    }

    function createBlankGridCard(letter)
    {
        const card = document.createElement("div");
        card.className = 'card a-grid';
        card.id = `${letter}`;

            const cardHeader = document.createElement("div");
            cardHeader.className = "card-header";
            cardHeader.innerHTML = `${letter}`;

            const cardBody = document.createElement("div");
            cardBody.className = "card-body";

                // Upload an image, or pick from existing blog image

                const cardLink = document.createElement("a");
                cardLink.className = 'stretched-link';
                cardLink.href = '#';
                cardLink.onclick = function () { /** Attach to modal menu element */ };

                
        card.appendChild(cardHeader);
        card.appendChild(cardBody);
        cardBody.appendChild(cardLink);
        alpha_grid.appendChild(card);

        /*
        <div class='card a-grid' id="a">

            <div class='card-header'>
                A Title
            </div>

            <div class='card-body'>
                Image
            </div>

        </div>
        */
    }

    </script>
</body>

</html>