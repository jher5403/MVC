const blogRow = document.getElementById('blog-row');

function clearCard() {
    blogRow.innerHTML = ''; // Clear the container
}

function displaySortedBlogs(sortOrder = 'asc') {
    blogs.forEach(blog => {
        createCard(blog);
    });
}

function createCard(blog)
{
    const card = document.createElement("div");
    card.className = 'card';
    card.id = `blog-${blog.blog_id}`;
    // Header
    const cardHeader = document.createElement("div");
    cardHeader.className = "card-header";
    const cardTitle = document.createElement("h4");
    cardTitle.className = "card-title";
    cardTitle.textContent = blog.title;
    cardHeader.appendChild(cardTitle);

    // Body
    const cardBody = document.createElement("div");
    cardBody.className = "card-body";
    const cardLink = document.createElement("a");
    cardLink.setAttribute('data-bs-target', "#card-modal");
    cardLink.setAttribute('data-bs-toggle', "modal");
    cardLink.className = 'stretched-link';
    cardLink.onclick = function () { fillModal(blog); };
    const cardImage = document.createElement("img");
    cardImage.className = "card-img";
    cardImage.src = `${blog.dir}${blog.images[0]}`;
    cardBody.appendChild(cardImage);
    cardBody.appendChild(cardLink);

    // Footer
    const cardFooter = document.createElement("div");
    cardFooter.className = "card-footer";
    const cardEmail = document.createElement("p");
    cardEmail.className = "card-text";
    cardEmail.textContent = blog.creator_email;
    cardFooter.appendChild(cardEmail);

    card.appendChild(cardHeader);
    card.appendChild(cardBody);
    card.appendChild(cardFooter);

    // Attach to container.
    blogRow.appendChild(card);
}

function fillModal(blog)
{
    document.getElementById('card-modal-title').innerHTML = blog.title;
    document.getElementById('card-modal-img').setAttribute('src', `${blog.dir}${blog.images[0]}`);
    document.getElementById('card-modal-desc').innerHTML = blog.description;
    document.getElementById('card-modal-email').innerHTML = blog.creator_email;
    document.getElementById('card-modal-email').onclick = function () {
        console.log(blog.creator_email);
    };
}

document.getElementById('searchButton').addEventListener('click', () => {
    const title = document.getElementById('searchInput').value;
    const min = document.getElementById('startDate').value;
    const max = document.getElementById('endDate').value;
    const sort = document.getElementById('sortOrder').value;

    fetch(`home/getSelectBlogs/${sort}/${title}/${min}/${max}/`)
        .then(response => response.json())
        .then(selectBlogs => {
            clearCard();
            selectBlogs.forEach(blog => {
                createCard(blog);
            });
        });
});

document.getElementById('searchInput').addEventListener('keydown', (event) => {
    if (event.key === 'Enter') {
        event.preventDefault();
        const title = document.getElementById('searchInput').value;
        const min = document.getElementById('startDate').value;
        const max = document.getElementById('endDate').value;
        const sort = document.getElementById('sortOrder').value;

        fetch(`home/getSelectBlogs/${sort}/${title}/${min}/${max}/`)
        .then(response => response.json())
        .then(selectBlogs => {
            clearCard();
            selectBlogs.forEach(blog => {
                createCard(blog);
            });
        });
    }
});

document.getElementById('sortOrder').addEventListener('change', () => {
    const title = document.getElementById('searchInput').value;
    const min = document.getElementById('startDate').value;
    const max = document.getElementById('endDate').value;
    const sort = document.getElementById('sortOrder').value;

    fetch(`home/getSelectBlogs/${sort}/${title}/${min}/${max}/`)
        .then(response => response.json())
        .then(selectBlogs => {
            clearCard();
            selectBlogs.forEach(blog => {
                createCard(blog);
            });
        });
});