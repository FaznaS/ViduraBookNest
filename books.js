function searchBook(title) {
    const xhr = new XMLHttpRequest();
    xhr.open("GET", `books.php?title=${encodeURIComponent(title)}`, true);

    xhr.onload = function () {
        if (xhr.status === 200) {
            const responseHTML = document.createElement('div');
            responseHTML.innerHTML = xhr.responseText;

            // Extracting only the book list container from the response
            const newBookList = responseHTML.querySelector("#book_list_container").innerHTML;

            // Replace the current book list container content
            document.getElementById("book_list_container").innerHTML = newBookList;
        } else {
            console.error("Failed to fetch books");
        }
    };

    xhr.send();
}

// Function to filter books based on genre
function filterBooks(genre) {
    // Redirect with the genre parameter in the URL
    window.location.href = `?genre=${genre}`;
}

// On page load, check the URL for the genre parameter
window.onload = function () {
    const urlParams = new URLSearchParams(window.location.search);
    const genre = urlParams.get("genre");
    const section_heading = document.getElementById("search_heading");

    // If genre is found in URL, update the heading
    if (genre) {
        section_heading.innerText = genre;
    } else {
        // Default heading when no filter is applied
        section_heading.innerText = "Top Recommendations";
    }
};

function filterBooksByAuthor(authorName) {
    const xhr = new XMLHttpRequest();
    xhr.open("GET", `books.php?author=${encodeURIComponent(authorName)}`, true);

    xhr.onload = function () {
        if (xhr.status === 200) {
            const responseHTML = document.createElement('div');
            responseHTML.innerHTML = xhr.responseText;

            // Extracting only the book list container from the response
            const newBookList = responseHTML.querySelector("#book_list_container").innerHTML;

            // Replace the current book list container content
            document.getElementById("book_list_container").innerHTML = newBookList;
        } else {
            console.error("Failed to fetch books");
        }
    };

    xhr.send();
}
