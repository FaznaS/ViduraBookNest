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
            height: 70%;
            width: 600px;
            padding: 50px;
            margin: 40px;
            text-align: center;
        }
        #form-container {
            background-color: #D09594;
            padding: 15px;
            border-radius: 10px;
            margin: 30px;
            height: 65%;
        }
        .user-input-container {
            text-align: left; 
            padding: 10px;
            margin-top: 20px;
        }
        label {
            font-weight: bold; 
            font-size: large;
        }
        input {
            width: 350px; 
            height: 20px; 
            border-radius: 5px;
            border-color: #D09594; 
            padding: 5px;
        }
        .submit-btn {
            width: 120px;
            height: 40px;
            font-size: large;
            font-weight: bold;
            padding: 8px;
            border-radius: 0.8em;
        }
        .error {
            color: #FF0000;
            font-size: 1.0em;
            padding-top: 5px;
        }
        a {
            text-decoration: none;
            font-size: 15px;
            display: flex;
            justify-content: flex-end;
            padding: 8px;
        }
    </style>
</head>
<body>
<?php
        // Setting up the connection
        $conn = mysqli_connect("localhost", "root", "fazna11aa99zz@Sheriffdeen", "booknest_db");

        if (!$conn) {
            die("Connection Unsuccessful: " . mysqli_connect_error());
        }

        // Initializing variables
        $usernameErr = $passwordErr = "";
        $username = $password = "";

        if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["login"])) {
            $username = $_POST["username"];
            $password = $_POST["password"];

            if(!(empty($username) || empty($password))) {
                // check if the user already exists
                $search_id = "SELECT * FROM student WHERE admission_no = '$_POST[username]'";
                $result = mysqli_query($conn,$search_id);

                if ($result->num_rows == 1) {
                    // Get user data
                    $row = mysqli_fetch_assoc($result);
                    $stored_password = $row['student_password'];

                    if($password == $stored_password) {
                        echo 
                        "<script type=\"text/javascript\">
                            window.location.href = 'home.html';
                        </script>";
                    } else {
                        $passwordErr = "Incorrect Password";
                    }
                } else {
                    $usernameErr = "Invalid Username";
                }
            } else {
                $usernameErr = "Username is required";
                $passwordErr = "Password is required";
            }
            
        }
    ?>

    <div class="content-container">
        <img src="./Assets/logo.jpg" alt="logo" id="logo">
        <div id="form-container" style="display: flex; align-items: center; justify-content: center;">
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <div class="user-input-container">
                    <label for="username">Username</label>
                    <br>
                    <input type="text" id="username" name="username" value="<?php echo $username; ?>" placeholder="Admission Number">
                    <br>
                    <span class="error"><?php echo $usernameErr; ?></span>
                </div>
                <div class="user-input-container">
                    <label for="password">Password</label>
                    <br>
                    <input type="password" id="password" name="password" value="<?php echo $password; ?>" >
                    <br>
                    <div style="display: flex; justify-content:space-between">
                        <span class="error"><?php echo $passwordErr; ?></span>
                        <a href="forgotPassword.php">Forgot Password?</a>
                    </div>
                </div>
                <br>
                <input type="submit" id="login" name="login" value="LOGIN" class="submit-btn" style="background-color: #AA9595;">
            </form>
        </div>
    </div>
</body>
</html>