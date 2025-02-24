<?php

    include 'config.php';

    include 'index.php';

    // Fetch user details from the database
    $user = [];
    $stmt = $conn->prepare("SELECT * FROM members WHERE user_id = ?");
    $stmt->bind_param("i", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
    }
    $stmt->close();

    // Variables for error and success messages
    $error_message = "";
    $success_message = "";

    // Handle form submission
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST['email'];
        $contact_no = $_POST['contact_no'];
        $grade_class = $_POST['grade_class'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];

        // Validation
        if (empty($email) || empty($contact_no) || empty($grade_class) || empty($password) || empty($confirm_password)) {
            $error_message = "All fields are required!";
        } elseif ($password !== $confirm_password) {
            $error_message = "Passwords do not match!";
        } elseif (!preg_match("/^[0-9]{10}$/", $contact_no)) {
            $error_message = "Invalid contact number format!";
        } else {
            // Update the database
            $stmt = $conn->prepare("UPDATE members SET email = ?, contact_no = ?, grade_class = ?, password = ? WHERE user_id = ?");
            $stmt->bind_param("ssssi", $email, $contact_no, $grade_class, $password, $username);

            if ($stmt->execute()) {
                $success_message = "Profile updated successfully!";
                // Refresh the user details
                $user['email'] = $email;
                $user['contact_no'] = $contact_no;
                $user['grade_class'] = $grade_class;
            } else {
                $error_message = "Error updating profile!";
            }
            $stmt->close();
        }
    }

    $conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="index.css">
    <script src="index.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
       
       
        ul {
            list-style: none;
        }

        .content-container {
            background-color: #E5DAD8;
            border-radius: 15px;
            height: fit-content;
            width: 600px;
            padding: 50px;
            margin: 40px;
            text-align: center;
            justify-content: center;
            align-items: center;
        }

        section{
            display: flex;
            justify-content: center;

        }
        #form-container {
            background-color: #D09594;
            padding: 15px;
            border-radius: 10px;
            margin-top: 10%;
            margin-bottom: 40px;
            height: 70%;
            width: fit-content;
            justify-content: center;
            align-items: center;
        }
        label {
            font-weight: bold;
        }
        input {
            width: 300px; 
            height: 15px; 
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
            margin-bottom: 8px;
            cursor: pointer;
            border: 1px solid black;
        }
        #icon-eye,#confirm-icon-eye {
            position: absolute;
            right: 10px; 
            top: 5px;
            cursor: pointer;
        }
        .submit1{
            width: 150px;
            height: 40px;
            font-size: small;
            font-weight: bold;
            padding: 8px;
            border-radius: 0.8em;
            margin-bottom: 8px;
            cursor: pointer;
            border: 1px solid black;
        }

        footer {
            position: relative;
        }
    </style>
</head>
<body>
    <!-- Display messages -->
    <?php if (!empty($error_message)): ?>
            <p class="error"><?php echo $error_message; ?></p>
        <?php endif; ?>
        <?php if (!empty($success_message)): ?>
            <p class="success"><?php echo $success_message; ?></p>
        <?php endif; 
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

<?php 
    include "backbtn.php"
?>

<section>
    <div class="content-container" style="display: flex; flex-direction: column; justify-content: center; align-items: center;">
        <img src="./Assets/logo.jpg" alt="logo" id="logo">
        <div id="form-container">
        <!-- Profile Edit Form -->
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <table align="center" cellpadding="3px" style="text-align: left;">
                <tr>
                    <td><i class="fa fa-user" aria-hidden="true" style="font-size:40px;"> </i></td>
                    <td><input type="submit" id="add" name="add" value="Choose Image" class="submit1" style="background-color: #AA9595;"></td>
                </tr>
                <tr>
                    <td><label for="student_name">Name:</label></td>
                    <td><input type="text" id="student_name" value="<?php echo htmlspecialchars($user['name'] ?? ''); ?>" readonly> </td>
                </tr>
                <tr>
                    <td><label for="email">Email:</label></td>
                    <td><input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email'] ?? ''); ?>" required></td>
                </tr>
                <tr> 
                    <td><label for="contact_no">Contact No:</label> </td>
                    <td><input type="tel" id="contact_no" name="contact_no" value="<?php echo htmlspecialchars($user['contact_no'] ?? ''); ?>" required> </td>
                </tr>
                <tr>
                    <td><label for="grade_class">Grade/Class:</label></td>
                    <td><input type="text" id="grade_class" name="grade_class" value="<?php echo htmlspecialchars($user['grade_class'] ?? ''); ?>" required> </td>
                </tr>
                <tr>
                    <td><label for="password">Password:</label></td>
                    <td>
                        <div style="position: relative; height: 15px; margin-bottom: 10px;">
                            <input type="password" id="password" name="password" placeholder="New Password" required>
                            <i id="icon-eye" class="fa fa-eye" aria-hidden="true" onclick="togglePassword()"></i>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>   
                        <label for="confirm_password">Confirm Password:</label> 
                    </td>
                    <td> 
                        <div style="position: relative; height: 15px;">
                            <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm Password" required>
                            <i id="confirm-icon-eye" class="fa fa-eye" aria-hidden="true" onclick="toggleConfirmPassword()"></i>
                        </div>
                    </td>
                </tr>
            </table>
            <br>
            <input type="submit" id="add" name="add" value="Edit Profile" class="submit-btn" style="background-color: #AA9595;">
        </form>
   
        </div>

        </div>
        </section>
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