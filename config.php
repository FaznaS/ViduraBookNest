<?php 
    $conn = mysqli_connect("localhost", "root", "***REMOVED***", "booknest_db");

    if (!$conn) {
        die("Connection Unsuccessful: " . mysqli_connect_error());
    }
?>