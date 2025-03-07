<?php
include "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST['action'];

    // Display borrowed books details
    if ($action == "fetch") {
        $query = isset($_POST['query']) ? mysqli_real_escape_string($conn, $_POST['query']) : "";

        $sql = "SELECT * FROM payment_details";
        if (!empty($query)) {
            $sql .= " WHERE payment_id LIKE '%$query%' OR payment_slip LIKE '%$query%' OR payment_type LIKE '%$query%' 
            OR status LIKE '%$query%' OR user_id LIKE '%$query%' OR price LIKE '%$query%'";
        } 

        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            echo "<table class='table table-bordered table-hover'>";
            echo "<tr style='background-color: white;'>";
            echo "<th>Payment ID</th>";
            echo "<th>User ID</th>";
            echo "<th>Payment Type</th>";
            echo "<th>Price</th>";
            echo "<th>Payment Slip</th>";
            echo "<th>Status</th>";
            echo "<th>Actions</th>";
            echo "</tr>";
    
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>{$row['payment_id']}</td>";
                echo "<td>{$row['user_id']}</td>";
                echo "<td>{$row['payment_type']}</td>";
                echo "<td>{$row['price']}</td>";
                echo "<td>{$row['payment_slip']}</td>";
                echo "<td>{$row['status']}</td>";
                echo "<td>";
                if($row['status'] == "Pending") {
                    echo "<button class='approved-btn'
                        data-payment-id='{$row['payment_id']}'>Approved</button>";

                    echo "<button class='rejected-btn'
                        data-payment-id='{$row['payment_id']}'>Rejected</button>";
                } else {
                    echo "<button class='approved-btn' disabled style='background-color:rgb(125, 204, 125); color: #666;'>Return</button>";
                    echo "<button class='rejected-btn' disabled style='background-color:rgb(214, 54, 81); color: #666;'>Lost</button>";
                }
                echo "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<div class='no-results'>No records found for the search.</div>";
        }
    } 

    //When Payment is Approved, 
    if ($action === "aprove_payment") {
        $paymentId = intval($_POST['payment_id']);

        $updatePayment = "UPDATE payment_details SET status = 'Approved' WHERE payment_id = $paymentId";

        if (mysqli_query($conn, $updatePayment)) {
            echo json_encode(["message" => "Update the payment status successfully."]);
        } else {
            echo json_encode(["message" => "Error updating the payment status: " . mysqli_error($conn)]);
        }
    }

    //When Payment is Rejected, 
    if ($action === "reject_payment") {
        $paymentId = intval($_POST['payment_id']);

        $updatePayment = "UPDATE payment_details SET status = 'Rejected' WHERE payment_id = $paymentId";

        if (mysqli_query($conn, $updatePayment)) {
            echo json_encode(["message" => "Update the payment status successfully."]);
        } else {
            echo json_encode(["message" => "Error updating the payment status: " . mysqli_error($conn)]);
        }
    }
}
?>