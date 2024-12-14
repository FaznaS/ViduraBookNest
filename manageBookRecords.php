<?php 
    // Setting up the connection
    include "config.php";

    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["insert"])) {
        $acc_no = $_POST["acc_no"] ?? "";
        $title = $_POST["title"];

        $book_image = $_FILES["book_image"]["name"];
        $image_size=$_FILES['book_image']['size'];
        $image_tmp_name=$_FILES['book_image']['tmp_name'];
        $image_folder="Assets/uploaded_images/".$book_image;
        
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
            $add_query = "INSERT INTO books (acc_no, title, image, category, author, copies, publisher, isbn, copyright_year, class_no, price, status, comment) VALUES (
                    '$acc_no',
                    '$title',
                    '$book_image',
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
            
            if (mysqli_query($conn, $add_query)) {
                if ($image_size > 2000000) {
                    echo 
                    "<script type=\"text/javascript\"> 
                        window.alert('Image size is too large');
                        window.location.href = 'addBook.html';
                    </script>";
                } elseif (!move_uploaded_file($image_tmp_name, $image_folder)) {
                    echo 
                    "<script type=\"text/javascript\"> 
                        window.alert('Failed to upload image. Please try again.');
                        window.location.href = 'addBook.html';
                    </script>";
                } else {
                    echo 
                    "<script type=\"text/javascript\"> 
                        window.alert('Book added successfully');
                        window.location.href = 'addBook.html';
                    </script>";
                }
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
