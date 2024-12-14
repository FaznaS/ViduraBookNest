<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vidura College BookNest</title>
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="index.js"></script>
    <script src="home.js"></script>
    <style>
        ul {
            list-style: none;
        }
        .search-bar {
            display: flex;
            align-items: center;
            margin-top: 20px;
            width: fit-content;
        }
        .search-bar input {
            border: none;
            background-color: #E5C2BB;
            padding: 10px 40px;
            border-radius: 25px;
            height: 25px;
            width: 400px;
        }
        .fa-filter {
            position: relative;
            font-size: large;
            left: 30px;
        }
        .fa-search {
            position: relative;
            font-size: large;
            right: 30px;
        }
        #filter-options {
            background-color: #E5DAD8;
            width: 420px;
            padding: 10px;
            padding-bottom: 20px;
            position: absolute;
            z-index: 1;
        }
        .btn-genre, .btn-author {
            padding: 5px 20px;
            font-weight: bold;
        }
        .book_category_container {
            margin-left: 40px;
            margin-right: 40px;
            justify-content: center;
        }
        h2 {
            background-color: #D9D9D9;
            border-radius: 20px;
            width: fit-content;
            height: fit-content;
            padding-top: 5px;
            padding-bottom: 5px;
            padding-left: 25px;
            padding-right: 25px;
        }
        #book_list_container {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            width: 100%;
        }
        .book_container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            width: fit-content;
            height: fit-content;
            margin-right: 10px;
            padding: 8px;
            margin: 10px;
        }
        #book_img {
            height: 250px;
            width: 170px;
        }
        #book_title {
            background-color: #D9D9D9;
            padding: 3px;
            border-radius: 20px;
            width: 200px;
            text-align: center;
            height: fit-content;
        }
        .view-more-btn {
            width: 120px;
            height: 40px;
            font-size: large;
            padding: 5px;
            border: 1px solid white;
            border-radius: 0.8em;
            margin-left: 40px;
            color: #0029FF;
        }
        #page-container {
            background-color: rgba(204, 195, 195, 0.3);
        }
        .no-books-message {
            background-color: #D9D9D9;
            width: 100%;
            justify-content: center;
            text-align: center;
            font-size: 20px;
            padding: 5px;
        }
    </style>
</head>
<body>

    <!--To display student name-->
    <?php 
        include "index.php"
    ?>

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
                    <a href="cart.html" class="header-links">Cart</a>
                </div>
            </li>
            <li>
                <div class="nav-element-container">
                    <i class="fa fa-credit-card-alt" aria-hidden="true" style="font-size: larger; padding-top: 3px;"></i>
                    <a href="payment.html" class="header-links">Payment</a>
                </div>
            </li>
        </ul>
    </nav>

    <div id="page-container">
        <div id="content-wrap">
            <!--User Profile-->
            <div id="user-profile-container" onmouseover="showViewProfile()" onmouseleave="hideViewProfile()">
                <div id="view-profile-option">
                    <div style="display: flex; flex-direction: column; align-items: center;">
                        <p><?php echo htmlspecialchars($student_name); ?></p>
                        <a href="viewProfile.html" style="text-decoration: none;">View Profile</a>
                    </div>
                </div>
                <button type="button" id="user-profile-icon">
                    <i class="fa fa-user" aria-hidden="true" style="font-size: xx-large;" onclick="showMore()"></i>
                </button>
            </div>

            <div id="more-options">
                <a href="editProfile.html" class="more-options-links">Edit Profile</a>
                <a href="help.html" class="more-options-links">Help and Support</a>
                <a href="settings.html" class="more-options-links">Settings</a>
                <br>
                <br>
                <button type="button" class="btn" style="margin-left: 13px;">
                    <i class="fa fa-external-link" aria-hidden="true" style="color: blue; text-align: center;"></i>
                    <a href="welcome.html" style="color: blue; text-decoration: none;font-weight: normal;font-family: 'Times New Roman', Times, serif;">Log Out</a>
                </button>
            </div>

            <!-------------------------------Search Bar------------------------------->
            <div style="display: flex; justify-content: center;">
                <div class="search-bar">
                    <i class="fa fa-filter" aria-hidden="true" onclick="showFilterOptions()"></i>
                    <input type="text" placeholder="Search">
                    <i class="fa fa-search" aria-hidden="true"></i>
                </div>
            </div>

            <!-------------------------------Filter Options------------------------------->
            <div id="filter-options-container" style="display: none; justify-content: center;">
                <div id="filter-options">
                    <h4>Genre</h4>
                    <div style="padding: 5px;">
                        <button type="button" class="btn-genre">Fiction</button>
                        <button type="button" class="btn-genre">Non-Fiction</button>
                        <button type="button" class="btn-genre">Science</button>
                        <button type="button" class="btn-genre">History</button>
                    </div>
                    <div style="padding: 5px;">
                        <button type="button" class="btn-genre">Language</button>
                        <button type="button" class="btn-genre">Literature</button>
                        <button type="button" class="btn-genre">Technology</button>
                    </div>
                    <h4>Author</h4>
                    <input type="text" placeholder="Type" style="width: 350px; height: 20px; padding: 5px;">
                </div>
            </div>

            <!-------------------------------Book Collection------------------------------->
            <?php 
                include "config.php";
                
                $category = "";

                function displayBookByCategory($conn, $category) {
                    $search = "SELECT * FROM books WHERE category = '$category'";
                    $result = mysqli_query($conn,$search);

                    if(mysqli_num_rows($result) > 0) {
                        while($fetch_book = mysqli_fetch_assoc($result)) {
                            echo '<div class="book_container">
                                    <img id="book_img" src="Assets/uploaded_images/' . $fetch_book["image"] .' ">
                                    <h3 id="book_title">' . $fetch_book["title"] . '</h3>
                                </div>';
                        }
                                            
                        echo '<input type="button" value="More" name="view-more" class="view-more-btn">';

                    } else {
                        echo '<p class="no-books-message"> 
                                No books available in this category 
                            </p>';
                    }
                }
            ?>

            <section class="book_category_container">
                <h2>Fiction</h2>
                <div id="book_list_container">
                    <?php displayBookByCategory($conn, 'English Fiction') ?>
                </div>
            </section>
            
            <section class="book_category_container">
                <h2>Non Fiction</h2>
                <div id="book_list_container">
                    <?php displayBookByCategory($conn, 'Non Fiction') ?>
                </div>
            </section>
            
            <section class="book_category_container">
                <h2>Science</h2>
                <div id="book_list_container">
                    <?php displayBookByCategory($conn, 'Science') ?>
                </div>
            </section>  

            <section class="book_category_container">
                <h2>History</h2>
                <div id="book_list_container">
                    <?php displayBookByCategory($conn, 'History') ?>
                </div>
            </section>

            <section class="book_category_container">
                <h2>Language</h2>
                <div id="book_list_container">
                    <?php displayBookByCategory($conn, 'Language') ?>
                </div>
            </section>

            <section class="book_category_container">
                <h2>Literature</h2>
                <div id="book_list_container">
                    <?php displayBookByCategory($conn, 'Literature') ?>
                </div>
            </section>
            
            <section class="book_category_container">
                <h2>Technology</h2>
                <div id="book_list_container">
                    <?php displayBookByCategory($conn, 'Technology') ?>
                </div>
            </section>
        </div>
        
        <!-------------------------------Footer------------------------------->
        <footer>
            <div id="footer-link-container">
                <ul>
                    <li><a href="home.html" class="footer-links">Home</a></li>
                    <li><a href="books.html" class="footer-links">Books</a></li>
                    <li><a href="cart.html" class="footer-links">Cart</a></li>
                    <li><a href="payment.html" class="footer-links">Payment</a></li>
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