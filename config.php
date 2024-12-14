<?php 
    $conn = mysqli_connect("localhost", "root", "fazna11aa99zz@Sheriffdeen", "booknest_db");

    if (!$conn) {
        die("Connection Unsuccessful: " . mysqli_connect_error());
    }
?>