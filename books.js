function filterBooks(genre) {
    const section_heading = document.getElementById("search_heading");
    const bookListContainer = document.getElementById("book_list_container");

    window.location.href = "ViduraBooknest/books_demo.php?category=" + genre;
    
    // Update the heading dynamically
    // section_heading.innerText = genre;

    // Fetch books dynamically using AJAX (Fetch API)
    // fetch(`books_demo.php?genre=${genre}`)
    //     .then(response => response.text())
    //     .then(data => {
    //         // Update book list with fetched HTML content
    //         bookListContainer.innerHTML = data;
    //     })
    //     .catch(error => console.error("Error fetching books:", error));
}

alert("Hello");