<?php
// Include the header
include'header.php';

// Start session for user check
session_start();

// Redirect to login page if not logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "shop";

$conn = new mysqli($servername, $username, $password, $dbname);

$user_id = $_SESSION['user_id'];

echo "<h2>Your Orders</h2>";

$sql = "SELECT orders.id, products.name AS product_name, orders.quantity, orders.order_date 
        FROM orders
        JOIN products ON orders.product_id = products.id
        WHERE orders.user_id = '$user_id'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<p>Order ID: " . $row['id'] . " | Product: " . $row['product_name'] . 
             " | Quantity: " . $row['quantity'] . " | Date: " . $row['order_date'] . "</p>";
    }
} else {
    echo "<p>No orders placed yet.</p>";
}

// Include the footer
include'footer.php';
