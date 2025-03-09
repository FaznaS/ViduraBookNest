<?php
    include "config.php";
    include "index.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vidura College BookNest</title>
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="index.js"></script>
    <style>
        ul {
            list-style: none;
        }
        .content-container {
            background-color: #E5DAD8;
            border-radius: 20px;
            height: 40%;
            width: 80%;
            padding: 1.5%;
            margin: 7%;
        }
        th {
            font-size: large;
        }
        th,td {
            padding: 10px;
            border: 1px solid rgb(0, 0, 0);
        }
        #pay-btn {
            background-color: #8C8181;
            color: white;
            border: 1px solid #8C8181;
            border-radius: 15px;
            padding: 8px;
            width: 140px;
            font-size: large;
        }

        .back-arrow {
            display: inline-block;
            padding: 4px;
            background-color:#D09594; /* Bootstrap primary color */
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 15px;
            transition: background-color 0.3s;
            z-index: 100;
            margin: 10px;
            position: fixed;
        }

        .back-arrow:hover {
            background-color: #0056b3; /* Darker shade on hover */
        }

        .arrow {
            font-size: 15px; /* Adjust size of the arrow */
        }
    </style>
</head>
<body>
    <!-------------------------------Header Design------------------------------->
    <nav>
        <img src="./Assets/logo.jpg" alt="logo" style="width: 200px; padding: 10px;">
        <ul style="display: flex;">
            <li>
                <div class="nav-element-container">
                    <i class="fa fa-home" aria-hidden="true"></i>
                    <a href="home.php" class="header-links">Home</a>
                </div>
            </li>
            <li>
                <div class="nav-element-container">
                    <i class="fa fa-book" aria-hidden="true"></i>
                    <a href="books.php" class="header-links">Books</a>
                </div>
            </li>
            <li>
                <div class="nav-element-container">
                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                    <a href="cart.php" class="header-links">Cart</a>
                </div>
            </li>
            <li>
                <div class="nav-element-container">
                    <i class="fa fa-credit-card-alt" aria-hidden="true" style="font-size: larger; padding-top: 3px;"></i>
                    <a href="payment.php" class="header-links">Payment</a>
                </div>
            </li>
        </ul>
    </nav>

    <a href="javascript:history.back()" class="back-arrow">
        <span class="arrow">&#8592;</span> Back
    </a>

    <div id="page-container">
        <div id="content-wrap">
            <!-------------------------------User Profile------------------------------->
            <div id="user-profile-container" onmouseover="showViewProfile()" onmouseleave="hideViewProfile()">
                <div id="view-profile-option">
                    <div style="display: flex; flex-direction: column; align-items: center;">
                        <p><?php echo htmlspecialchars($student_name); ?></p>
                        <a href="viewProfile.php" style="text-decoration: none;">View Profile</a>
                    </div>
                </div>
                <button type="button" id="user-profile-icon">
                    <i class="fa fa-user" aria-hidden="true" style="font-size: xx-large;" onclick="showMore()"></i>
                </button>
            </div>

            <div id="more-options">
                <a href="editProfile.php" class="more-options-links">Edit Profile</a>
                <a href="help.html" class="more-options-links">Help and Support</a>
                <a href="settings.html" class="more-options-links">Settings</a>
                <br>
                <br>
                <button type="button" class="btn" style="margin-left: 13px;">
                    <i class="fa fa-external-link" aria-hidden="true" style="color: blue; text-align: center;"></i>
                    <a href="welcome.html" style="color: blue; text-decoration: none;font-weight: normal;font-family: 'Times New Roman', Times, serif;">Log Out</a>
                </button>
            </div>

            <!-------------------------------Content------------------------------->
            <div style="display: flex; justify-content: center; align-items: center;">
                <div class="content-container">
                    <h2>Fine Payment</h2>
                    <p style="color: #2C0163; font-size: large;">Charges per day = LKR 5</p>
                    <?php 
                        // Getting the user id of current user
                        $user_id = $_SESSION["username"];
                        
                        // Getting the books where the return date is passed
                        $search_books = "SELECT b.title, bb.borrowed_date, bb.return_date, bb.status 
                                            FROM books AS b 
                                            JOIN borrowed_book_details AS bb
                                            ON bb.book_id = b.acc_no
                                            WHERE user_id = '$user_id' AND return_date < CURDATE() AND bb.status != 'Returned'";
                        $delayed_books_result = mysqli_query($conn, $search_books);

                        // Calculating fine based on the number of days delayed
                        if(mysqli_num_rows($delayed_books_result) > 0) {
                            echo "<table align='center' style='text-align: center; margin-bottom: 30px;' cellspacing='0px'>
                                <tr>
                                    <th>Book</th>
                                    <th>Borrowed Date</th>
                                    <th>Return Date</th>
                                    <th>No. of days due</th>
                                    <th>Fee</th>
                                </tr>";

                            while ($fetch_delayed_books = mysqli_fetch_assoc($delayed_books_result)) {
                                $current_date = date('Y-m-d');
                                $return_date = $fetch_delayed_books["return_date"];

                                // Convert dates to timestamps
                                $diff_in_seconds = strtotime($current_date) - strtotime($return_date);

                                // Convert seconds to days
                                $due_days = floor($diff_in_seconds / (60 * 60 * 24));

                                // Calculating fine
                                $fine = $due_days * 5;
                                
                                echo "<tr>
                                        <td>" . $fetch_delayed_books["title"] . "</td>
                                        <td>" . $fetch_delayed_books["borrowed_date"] . "</td>
                                        <td>" . $fetch_delayed_books["return_date"] . "</td>
                                        <td>" . $due_days . "</td>
                                        <td>LKR " . $fine . "</td>
                                    </tr>";
                            };
                            
                            echo "</table>";
                        }
                    ?>
                    
                    <div style="display: flex; justify-content: center; font-size:larger; font-weight:bold; color: red; ">
                        <p> Kindly settle the payment with the Librarian. </p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-------------------------------Footer------------------------------->
        <footer>
            <div id="footer-link-container">
                <ul>
                    <li><a href="home.php" class="footer-links">Home</a></li>
                    <li><a href="books.php" class="footer-links">Books</a></li>
                    <li><a href="cart.php" class="footer-links">Cart</a></li>
                    <li><a href="payment.php" class="footer-links">Payment</a></li>
                </ul>
            </div>
            <div id="contact-container">
                <ul style="line-height: 1.5em;">
                    <li>
                        <div style="display: flex; flex-direction: row;">
                            <i class="fa fa-map-marker" aria-hidden="true" style="margin-right: 42px; font-size: larger;"></i>
                            <a href="https://www.google.com/maps/dir//Vidura+College,+742%2F16+Samagi+Mawatha,+Hokandara+10230/data=!4m6!4m5!1m1!4e2!1m2!1m1!1s0x3ae250eed5064887:0x99747169de18801f?sa=X&ved=1t:57443&ictx=111"
                            class="footer-links">
                                742/16 Samagi Mawatha, Hokandara 10230
                            </a>
                        </div>
                    </li>
                    <li>
                        <div style="display: flex; flex-direction: row;">
                            <i class="fa fa-phone" aria-hidden="true" style="font-size: larger;"></i>
                            <ul style="display: flex; flex-direction: column;">
                                <li>+94 11 286 6238</li>
                                <li>+94 11 287 1861</li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
            <div id="social-media-container">
                <i class="fa fa-facebook-square" aria-hidden="true"></i>
                <i class="fa fa-instagram" aria-hidden="true"></i>
                <i class="fa fa-twitter" aria-hidden="true"></i>
            </div>
        </footer>
    </div>
</body>
</html>
