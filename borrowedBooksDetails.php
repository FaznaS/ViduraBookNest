<?php
include "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST['action'];

    // Display borrowed books details
    if ($action == "fetch") {
        $query = isset($_POST['query']) ? mysqli_real_escape_string($conn, $_POST['query']) : "";

        $sql = "SELECT * FROM borrowed_book_details";
        if (!empty($query)) {
            $sql .= " WHERE book_id LIKE '%$query%' OR borrowed_date LIKE '%$query%' OR borrow_id LIKE '%$query%' 
            OR status LIKE '%$query%' OR user_id LIKE '%$query%' OR return_date LIKE '%$query%'";
        } 

        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            echo "<table class='table table-bordered table-hover'>";
            echo "<tr style='background-color: white;'>";
            echo "<th>Borrowed ID</th>";
            echo "<th>Book ID</th>";
            echo "<th>User ID</th>";
            echo "<th>Borrowed Date</th>";
            echo "<th>Return Date</th>";
            echo "<th>Status</th>";
            echo "<th>Actions</th>";
            echo "</tr>";
    
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>{$row['borrow_id']}</td>";
                echo "<td>{$row['book_id']}</td>";
                echo "<td>{$row['user_id']}</td>";
                echo "<td>{$row['borrowed_date']}</td>";
                echo "<td>{$row['return_date']}</td>";
                echo "<td>{$row['status']}</td>";
                echo "<td>";
                echo "<button class='return-book-btn'>Return</button>";
                echo "<button class='lost-book-btn'>Lost</button>";
                echo "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<div class='no-results'>No records found for the search.</div>";
        }
    } 
}
?>