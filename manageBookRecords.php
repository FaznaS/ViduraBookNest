<?php 
    // Setting up the connection
    $conn = mysqli_connect("localhost", "root", "", "booknest_db");

    if (!$conn) {
        die("Connection Unsuccessful: " . mysqli_connect_error());
    }

    // Initializing variables
    $acc_no = $title = $category = $author = $publisher = $isbn = $copyright_year = $class_no = $status = $comment = "";
    $copies = $price = 0;

    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["insert"])) {
        $acc_no = $_POST["acc_no"] ?? "";
        $title = $_POST["title"];
        $category = $_POST["category"];
        $author = $_POST["author"];
        $copies = $_POST["book_copies"];
        $publisher = $_POST["publisher"];
        $isbn = $_POST["isbn"];
        $copyright_year = $_POST["copyright_year"];
        $class_no = $_POST["class_no"];
        $price = $_POST["book_price"];
        $status = $_POST["status"];
        $comment = $_POST["comment"] ?? "";

        if(!(empty($title) || empty($category) || empty($author) || empty($publisher) || empty($isbn))) {
            // Inserting a Book
            $add_query = "INSERT INTO books (acc_no, title, category, author, copies, publisher, isbn, copyright_year, class_no, price, status, comment) VALUES (
                    '$acc_no',
                    '$title',
                    '$category',
                    '$author',
                    $copies,
                    '$publisher',
                    '$isbn',
                    '$copyright_year',
                    '$class_no',
                    $price,
                    '$status',
                    '$comment')";

            if(mysqli_query($conn,$add_query)) {
                echo 
                "<script type=\"text/javascript\"> 
                    window.alert('Book added successfully');
                    window.location.href = 'addBook.html';
                </script>";
            } else {
                echo 
                "<script type=\"text/javascript\"> 
                    window.alert('Sorry! Failed to add book'); 
                     window.location.href = 'addBook.html';
                </script>";
            }
        }
    }

    // Closing the connection
    mysqli_close($conn);
?>
