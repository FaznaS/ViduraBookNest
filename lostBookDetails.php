<?php
include "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST['action'];

    // Display lost books details
    if ($action == "fetch") {
        $query = isset($_POST['query']) ? mysqli_real_escape_string($conn, $_POST['query']) : "";

        $sql = "SELECT * FROM lost_books_view";
        if (!empty($query)) {
            $sql .= " WHERE lost_id LIKE '%$query%' OR user_id LIKE '%$query%' OR book_id LIKE '%$query%' 
            OR lost_date LIKE '%$query%' OR title LIKE '%$query%'";
        }

        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            echo "<table class='table table-bordered table-hover'>";
            echo "<tr style='background-color: white;'>";
            echo "<th>Lost ID</th>";
            echo "<th>Lost Date</th>";
            echo "<th>Book ID</th>";
            echo "<th>Title</th>";
            echo "<th>User ID</th>";
            echo "<th>Actions</th>";
            echo "</tr>";
            
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>{$row['lost_id']}</td>";
                echo "<td>{$row['lost_date']}</td>";
                echo "<td>{$row['book_id']}</td>";
                echo "<td>{$row['title']}</td>";
                echo "<td>{$row['user_id']}</td>";
                echo "<td>";
                echo "<button class='replace-btn'>Replaced</button>";
                echo "<button class='pay-btn'}'>Paid</button>";
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