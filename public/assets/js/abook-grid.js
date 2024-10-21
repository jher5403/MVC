const booksRow = document.getElementById('book-bar-row');
const alpha_grid = document.getElementById('alpha-grid-row');
let current_book;

function updateBook()
{
    const str = JSON.stringify(current_book);
    fetch(`abook/updateBook/${str}/`, 
        {
            method: 'POST',
        }).then(response => console.log(response.text()))
}

function newBook()
{
    fetch('abook/newBook/').then(response => console.log(response));
    displayBar();
}

/**
 * Updates the key (letter) in the current_book parameter.
 * 
 * @param {string} str 
 */
function updateSlot(str)
{
    arr = [];

    // Seperate string into array.
    res = str.split(':');

    // Cast blog_id as a number.
    res[1] = Number(res[1]);
    arr.push(res);

    // Create value-pair object.
    pair = Object.fromEntries(arr);

    // Assign variable to letter.
    Object.assign(current_book, pair);
    console.log(current_book);
    
}

// Display Functions

function displayBar() 
{
    clearContainer(booksRow);
    user_books.forEach(book => {
        createBarCard(book);
    });
    createBlankBarCard();

    if (user_books.length > 0)
    {
        displayGrid(user_books[0]);
    }
    
}

function displayGrid(book) 
{
    current_book = book;
    console.log('Book before displayGrid: ', current_book);
    clearContainer(alpha_grid);

    // Creates new book object. Prevents overriding of current_book.
    var letters = Object.assign({}, book);
    delete letters['creator_email'];
    delete letters['book_id'];

    entries = Object.entries(letters);
    console.log('Book after letter block: ', current_book);

    entries.forEach(pair => {
        const letter = pair[0];
        let blog_id = pair[1];

        const blog = getBlogById(blog_id);

        // If blog is empty, create empty slot.
        if (blog_id == null) {
            createBlankGridCard(letter);
        } else {
            createGridCard(blog);
        }
    });
}

function getBlogById(id)
{
    let result;
    user_blogs.forEach(blog => {
        if (blog.blog_id === id) {
            console.log(blog);
            result = blog;
        } 
    });
    return result;
}

function clearContainer(container)
{
    container.innerHTML = '';
}

function displayAvailableBlogs(letter)
{
    const modalRow = document.getElementById('abook-modal-row');
    clearContainer(modalRow);

    user_blogs.forEach(blog => {
        if (blog.title[0] == letter) {
            createGridCard(blog, modalRow, () => setCard(letter, blog));
        }
    });
}

function setCard(id, blog) 
{
    const cardRef = document.getElementById(`${id}-blank`);
    
    const card = document.createElement("div");
    card.className = 'card a-grid';
    card.id = `${blog.title[0]}:${blog.blog_id}`;

        const cardHeader = document.createElement("div");
        cardHeader.className = "card-header";
        cardHeader.innerHTML = `${blog.title}`;

        const cardBody = document.createElement("div");
        cardBody.className = "card-body";

            const cardImage = document.createElement("img");
            cardImage.className = "card-img";
            cardImage.src = `${blog.dir}${blog.images[0]}`;

            const cardLink = document.createElement("a");
            cardLink.className = 'stretched-link';
            cardLink.setAttribute('data-bs-target', "#abook-modal");
            cardLink.setAttribute('data-bs-toggle', "modal");
            //cardLink.href = '#';
            cardLink.onclick = function () { displayAvailableBlogs(card.id[0]) }

    card.appendChild(cardHeader);
    card.appendChild(cardBody);
    cardBody.appendChild(cardImage);
    cardBody.appendChild(cardLink);
    cardRef.replaceWith(card);
    updateSlot(card.id);

}

// Create Functions

function createBarCard(book) 
{
    const card = document.createElement("div");
    card.className = 'card bar-card';

        const cardHeader = document.createElement("div");
        cardHeader.className = "card-header";
        cardHeader.innerHTML = `Book ${book.book_id}`

        const cardBody = document.createElement("div");
        cardBody.className = "card-body";

            /*
            const cardImage = document.createElement("img");
            cardImage.className = "card-img";
            cardImage.src = `${blog.dir}${blog.images[0]}`;
            */

            const cardLink = document.createElement("a");
            cardLink.className = 'stretched-link';
            cardLink.href = '#';
            cardLink.onclick = function () { displayGrid(book) };

            
    card.appendChild(cardHeader);
    card.appendChild(cardBody);
    //cardBody.appendChild(cardImage);
    cardBody.appendChild(cardLink);
    booksRow.appendChild(card);
}

function createGridCard(blog, container = alpha_grid, func = displayAvailableBlogs)
{
    const card = document.createElement("div");
    card.className = 'card a-grid';
    card.id = blog.title[0];

        const cardHeader = document.createElement("div");
        cardHeader.className = "card-header";
        cardHeader.innerHTML = `${blog.title}`;

        const cardBody = document.createElement("div");
        cardBody.className = "card-body";

            const cardImage = document.createElement("img");
            cardImage.className = "card-img";
            cardImage.src = `${blog.dir}${blog.images[0]}`;

            const cardLink = document.createElement("a");
            cardLink.className = 'stretched-link';
            //cardLink.href = '#';
            cardLink.onclick = function () { func(card.id) }
            
    card.appendChild(cardHeader);
    card.appendChild(cardBody);
    cardBody.appendChild(cardImage);
    cardBody.appendChild(cardLink);
    container.appendChild(card);

}

function createBlankBarCard()
{
    const card = document.createElement("div");
    card.className = 'card bar-card';

        const cardBody = document.createElement("div");
        cardBody.className = "card-body";

            // Upload an image, or pick from existing blog image

            const cardLink = document.createElement("a");
            cardLink.className = 'stretched-link';
            //cardLink.href = '#'; // Create new book here.

            // Might add functionality later?
            cardLink.onclick = function () { newBook(); };
    
    card.appendChild(cardBody);
    cardBody.appendChild(cardLink);
    booksRow.appendChild(card);
}

function createBlankGridCard(letter)
{
    const card = document.createElement("div");
    card.className = 'card a-grid';
    card.id = `${letter}-blank`;

        const cardHeader = document.createElement("div");
        cardHeader.className = "card-header";
        cardHeader.innerHTML = `${letter}`;

        const cardBody = document.createElement("div");
        cardBody.className = "card-body";

            // Upload an image, or pick from existing blog image

            const cardLink = document.createElement("a");
            cardLink.className = 'stretched-link';
            cardLink.setAttribute('data-bs-target', "#abook-modal");
            cardLink.setAttribute('data-bs-toggle', "modal");
            //cardLink.href = `abook/${letter}`;
            //cardLink.href = `#`;
            cardLink.onclick = function () { displayAvailableBlogs(letter) };

            
    card.appendChild(cardHeader);
    card.appendChild(cardBody);
    cardBody.appendChild(cardLink);
    alpha_grid.appendChild(card);
}