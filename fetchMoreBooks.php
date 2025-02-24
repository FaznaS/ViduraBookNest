<?php
    include_once 'config.php';

    // Initialize variables
    $title = isset($_POST['title']) ? $_POST['title'] : '';
    $author = isset($_POST['author']) ? $_POST['author'] : '';
    $category = isset($_POST['category']) ? $_POST['category'] : '';
    $limit = isset($_POST['limit']) ? (int)$_POST['limit'] : 2;
    $offset = isset($_POST['offset']) ? (int)$_POST['offset'] : 0;

    // Build the main query with filters
    $query = "SELECT SQL_CALC_FOUND_ROWS * FROM books WHERE 1";

    if (!empty($title)) {
        $query .= " AND title LIKE '%$title%'";
    }
    if (!empty($author)) {
        $query .= " AND author LIKE '%$author%'";
    }
    if (!empty($category)) {
        $query .= " AND category = '$category'";
    }

    $query .= " LIMIT $limit OFFSET $offset";

    $result_query = mysqli_query($conn, $query);
    $total_query = "SELECT FOUND_ROWS() AS total";
    $total_result = mysqli_query($conn, $total_query);
    $total_row = mysqli_fetch_assoc($total_result);
    $total_books = $total_row['total'];

    // Display the books
    if (mysqli_num_rows($result_query) > 0) {
        while ($fetch_book = mysqli_fetch_assoc($result_query)) {
            echo '<div class="book_container">
                    <img id="book_img" src="Assets/uploaded_images/' . $fetch_book["image"] .' ">
                    <a href="book_details.php?id=' . $fetch_book["acc_no"] . '" style="text-decoration:none; color: black;">
                        <h3 id="book_title">' . $fetch_book["title"] . '</h3>
                    </a>
                </div>';
        }

        // Display the "More" button logic
        if ($offset + $limit < $total_books) {
            echo '<input type="button" value="More" name="view-more" id="view-more-btn" class="view-more-btn">';
        } else {
            echo '<style>#view-more-btn { display: none; }</style>';
        }
    }
?>

<script>
    $(document).ready(function() {
        const limit = 2;

        $("#view-more-btn").on("click", function() {
            // Get the current offset by counting the number of displayed book containers
            const offset = $("#book_display_container .book_container").length;

            const title = $("#search-title").val();
            const author = $("#search-author").val();
            const category = $("#search-category").val();

            $.ajax({
                url: "fetchMoreBooks.php",
                type: "POST",
                dataType: "json",
                data: {
                    title,
                    author,
                    category,
                    limit,
                    offset
                },
                success: function(data) {
                    const response = data.response.trim();
                    const totalBooks = parseInt(data.totalBooks, 10);

                    if (response === "") {
                        $("#view-more-btn").hide();
                    } else {
                        $("#book_display_container").append(response);
                        // Check if the displayed books are equal to or greater than the totalBooks
                        const displayedBooks = $("#book_display_container .book_container").length;
                        const totalBooks = <?php echo $totalBooks; ?>;

                        if (displayedBooks >= totalBooks) {
                            $("#view-more-btn").hide();
                        }
                    }
                },
            });
        });
    });
</script>
