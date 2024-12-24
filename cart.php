<?php

include 'config.php';
include 'index.php';

// Fetch user details from the database
$user = [];
$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT name, email, contact_no, grade_class FROM members WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    echo "User not found.";
    exit();
}
$stmt->close();
$conn->close();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Profile</title>
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
            height: fit-content;
            width: 600px;
            padding: 50px;
            margin: 40px;
            text-align: center;
        }
        #form-container {
            background-color: #D09594;
            padding: 15px;
            border-radius: 10px;
            margin-top: 10%;
            margin-bottom: 40px;
            height: 70%;
            width: fit-content;
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
        }
    </style>
</head>
<body>
    <div class="content-container">
        <h1>Profile Details</h1>
        <table>
            <tr>
                <td><label>Name:</label></td>
                <td><?php echo htmlspecialchars($user['name']); ?></td>
            </tr>
            <tr>
                <td><label>Email:</label></td>
                <td><?php echo htmlspecialchars($user['email']); ?></td>
            </tr>
            <tr>
                <td><label>Contact No:</label></td>
                <td><?php echo htmlspecialchars($user['contact_no']); ?></td>
            </tr>
            <tr>
                <td><label>Grade/Class:</label></td>
                <td><?php echo htmlspecialchars($user['grade_class']); ?></td>
            </tr>
        </table>
        <a href="editprofile.php">Edit Profile</a>
    </div>
</body>
</html>