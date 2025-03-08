<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vidura College BookNest</title>
    <link rel="stylesheet" href="index.css">
    <style>
        body {
            font-size: large;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .content-container {
            background-color: #E5DAD8;
            border-radius: 15px;
            padding: 20px 50px;
            margin: 40px;
            text-align: center;
        }

        #form-container {
            background-color: #D09594;
            padding: 15px;
            border-radius: 10px;
            margin-top: 3%;
            margin-bottom: 5%;
        }

        label {
            font-weight: bold;
        }

        input,
        select,
        textarea {
            width: 400px;
            height: 5%;
            border-radius: 5px;
            border-color: #D09594;
            padding: 5px;
        }

        .error {
            color: #FF0000;
            font-size: 1.0em;
        }

        .submit-btn {
            width: 120px;
            height: 40px;
            font-size: large;
            font-weight: bold;
            padding: 8px;
            border-radius: 0.8em;
        }
    </style>
</head>
<body>
    <?php
        include "manageBookRecords.php";
    ?>
    <div class="content-container" style="display: flex; flex-direction: column; justify-content: center; align-items: center;">
        <img src="./Assets/logo.jpg" alt="logo" style="height: 100px; padding-top: 10px;">
        <h2>Update Book</h2>
        <form id="form-container" method="POST" enctype="multipart/form-data">
            <table align="center" cellpadding="3px" style="text-align: left;">
                <tr>
                    <td><label for="acc_no">ACC.No</label></td>
                    <td>
                        <input type="text" id="acc_no" name="acc_no" value="<?php echo $book['acc_no']; ?>">
                    </td>
                </tr>
                <tr>
                    <td><label for="title">Book Title</label></td>
                    <td>
                        <input type="text" id="title" name="title" value="<?php echo $book['title']; ?>" required>
                    </td>
                </tr>
                <tr>
                    <td><label for="book_image">Book Cover Page</label></td>
                    <td>
                        <input type="file" id="book_image" name="book_image" accept="image/jpg, image/jpeg, image/png" style="padding-left: 0%;">
                    </td>
                </tr>
                <tr>
                    <td><label for="book_link">Online Reading Link</label></td>
                    <td>
                        <input type="text" id="book_link" name="book_link" value="<?php echo $book['file_path']; ?>">
                    </td>
                </tr>
                <tr>
                    <td><label for="category">Category</label></td>
                    <td>
                        <select name="category" style="width: 100%;">
                            <option value="select">Select</option>
                            <option value="English Fiction" <?php if ($book['category'] == "English Fiction") echo "selected"; ?>>English Fiction</option>
                            <option value="Non Fiction" <?php if ($book['category'] == "Non Fiction") echo "selected"; ?>>Non Fiction</option>
                            <option value="Science" <?php if ($book['category'] == "Science") echo "selected"; ?>>Science</option>
                            <option value="History" <?php if ($book['category'] == "History") echo "selected"; ?>>History</option>
                            <option value="Language" <?php if ($book['category'] == "Language") echo "selected"; ?>>Language</option>
                            <option value="English Literature" <?php if ($book['category'] == "English Literature") echo "selected"; ?>>English Literature</option>
                            <option value="Technology" <?php if ($book['category'] == "Technology") echo "selected"; ?>>Technology</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label for="author">Author</label></td>
                    <td>
                        <input type="text" id="author" name="author" value="<?php echo $book['author']; ?>" required>
                    </td>
                </tr>
                <tr>
                    <td><label for="book_copies">Book Copies</label></td>
                    <td>
                        <input type="number" id="book_copies" name="book_copies" value="<?php echo $book['copies']; ?>">
                    </td>
                </tr>
                <tr>
                    <td><label for="publisher">Publisher Name</label></td>
                    <td>
                        <input type="text" id="publisher" name="publisher" value="<?php echo $book['publisher']; ?>" required>
                    </td>
                </tr>
                <tr>
                    <td><label for="isbn">ISBN</label></td>
                    <td>
                        <input type="text" id="isbn" name="isbn" value="<?php echo $book['isbn']; ?>" required>
                    </td>
                </tr>
                <tr>
                    <td><label for="copyright_year">Copyright Year</label></td>
                    <td>
                        <input type="text" id="copyright_year" name="copyright_year" value="<?php echo $book['copyright_year']; ?>">
                    </td>
                </tr>
                <tr>
                    <td><label for="class_no">Class No</label></td>
                    <td>
                        <input type="text" id="class_no" name="class_no" value="<?php echo $book['class_no']; ?>">
                    </td>
                </tr>
                <tr>
                    <td><label for="book_price">Book Price</label></td>
                    <td>
                        <input type="number" id="book_price" name="book_price" value="<?php echo $book['price']; ?>">
                    </td>
                </tr>
                <tr>
                    <td><label for="status">Status</label></td>
                    <td>
                        <select name="status" style="width: 100%;">
                            <option value="select">Select</option>
                            <option value="Old" <?php if ($book['status'] == "Old") echo "selected"; ?>>Old</option>
                            <option value="New" <?php if ($book['status'] == "New") echo "selected"; ?>>New</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label for="comment">Comment</label></td>
                    <td>
                        <textarea id="comment" name="comment" style="height: 70px;"><?php echo $book['comment']; ?></textarea>
                    </td>
                </tr>
            </table>
            <br>
            <input type="submit" id="update" name="update" value="UPDATE" class="submit-btn" style="background-color: #AA9595;">
        </form>
    </div>
</body>
</html>
