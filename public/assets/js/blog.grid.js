function displaySortedBlogs(sortOrder = 'asc') 
{
    blogRow.innerHTML = ''; // Clear the container

    // Sort blogs based on title in ascending or descending order
    blogs.sort((a, b) => {
        const titleA = a.table.title.toLowerCase();
        const titleB = b.table.title.toLowerCase();
        if (sortOrder === 'asc') {
            return titleA < titleB ? -1 : (titleA > titleB ? 1 : 0);
        } else {
            return titleA > titleB ? -1 : (titleA < titleB ? 1 : 0);
        }
    });

    blogs.forEach(pair => {
        // Blog Row Attributes
        const table = pair.table;

        const blog_id = table.blog_id;
        const email = table.creator_email;
        const title = table.title;

        const description = table.description;
        const event_date = table.event_date;
        const creation_date = table.creation_date;
        const modification_date = table.modification_date;
        const privacy_filter = table.privacy_filter;

        // Image Array
        const images = pair.images;
        const img_src = `${images.dir}${images.img_names[0]}`;
        createCard(blogRow, title, email, img_src, blog_id, pair);
    });
}

function createCard(pair) 
{
    const card = document.createElement("div");
    card.className='card';
    card.id = `blog-${id}`;
        // Header
        const cardHeader = document.createElement("div");
        cardHeader.className = "card-header";
            const cardTitle = document.createElement("h4");
            cardTitle.className = "card-title";
            cardTitle.textContent = title;
        cardHeader.appendChild(cardTitle);
        // Body
        const cardBody = document.createElement("div");
        cardBody.className = "card-body";
            const cardLink = document.createElement("a");
            cardLink.setAttribute('data-target', "#card-modal");
            cardLink.setAttribute('data-toggle', "modal");
            cardLink.className = 'stretched-link';
            cardLink.onclick = function() {fillModal(pair);};
            const cardImage = document.createElement("img");
            cardImage.className = "card-img";
            cardImage.src = img;
        cardBody.appendChild(cardImage);
        cardBody.appendChild(cardLink);
        // Footer
        const cardFooter = document.createElement("div");
        cardFooter.className = "card-footer";
            const cardEmail = document.createElement("p");
            cardEmail.className = "card-text";
            cardEmail.textContent = email;
        cardFooter.appendChild(cardEmail);

    card.appendChild(cardHeader);
    card.appendChild(cardBody);
    card.appendChild(cardFooter);

    // Attach to container.
    container.appendChild(card);
}

function fillModal(pair) 
{
    const table = pair.table;
    const blog_id = table.blog_id;
    const email = table.creator_email;
    const title = table.title;
    const description = table.description;
    const event_date = table.event_date;
    const creation_date = table.creation_date;
    const modification_date = table.modification_date;
    const privacy_filter = table.privacy_filter;

    // Image Array
    const images = pair.images;

    // Image Source
    const img_src = `${images.dir}${images.img_names[0]}`;

    document.getElementById('card-modal-title').innerHTML = title;
    document.getElementById('card-modal-img').setAttribute('src', img_src);
    document.getElementById('card-modal-desc').innerHTML = description;
    document.getElementById('card-modal-email').innerHTML = email;
    document.getElementById('card-modal-email').onclick = function() {
        $.ajax({
            type: 'GET',
            url: 'actions/get-blogs-modular.php',
            data: {
                select_user: email
            },
            cache: false,
            success: function () {
                console.log(success);
            },
            error: function(xhr, status, error) {
                console.error(xhr);
            }
        });
    };
}

