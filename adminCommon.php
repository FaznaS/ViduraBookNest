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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="index.css">
    <script src="index.js"></script>
    <style>
        .header {
            width: 100%;
            margin: 0;
            top: 0;
            left: 0;
            display: block;
            position: absolute;
        }

        nav {
            position: sticky;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding-left: 20px;
            padding-right: 20px;
            height: fit-content;
            background-color:#E5DAD8;
        }

        .back-arrow {
            padding: 4px;
            background-color:#D09594; 
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 15px;
            transition: background-color 0.3s;
            margin-top: 20px;
            position: absolute;
            left: 25px;
        }

        .back-arrow:hover {
            background-color: #0056b3;
        }

        .arrow {
            font-size: 15px; 
        }
    </style>
</head>
<body>
    <div class="header">
        <nav>
            <a href="admin.php">
                <img src="./Assets/logo.jpg" alt="logo" style="width: 200px; padding: 10px;">
            </a>

            <ul style="display: flex; list-style: none;">
            <li>
                <div class="nav-element-container">
                    <a href="addBook.php" class="header-links">Add Book</a>
                </div>
            </li>
            <li>
                <div class="nav-element-container">
                    <a href="updateBooks.html" class="header-links">Update Books</a>
                </div>
            </li>
            <li>
                <div class="nav-element-container">
                    <a href="bookDetails.html" class="header-links">Delete Books</a>
                </div>
            </li>
            <li>
                <div class="nav-element-container">
                    <a href="viewRecords.php" class="header-links">View Records</a>
                </div>
            </li>
        </ul>
        </nav>
        
        <div id="page-container">
            <div>
                <a href="javascript:history.back()" class="back-arrow">
                    <span class="arrow">&#8592;</span> Back
                </a>
            </div>
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
                <a href="editprofile.php" class="more-options-links">Edit Profile</a>
                <a href="help.html" class="more-options-links">Help and Support</a>
                <a href="settings.html" class="more-options-links">Settings</a>
                <br>
                <br>
                <button type="button" class="btn" style="margin-left: 13px;">
                    <i class="fa fa-external-link" aria-hidden="true" style="color: blue; text-align: center;"></i>
                    <a href="welcome.html" style="color: blue; text-decoration: none;font-weight: normal;font-family: 'Times New Roman', Times, serif;">Log Out</a>
                </button>
            </div>
        </div>
    </div>
    </div>
</body>
</html>