<?php
// Include the header
include('header.php');

// Start session for login check
session_start();

// If not logged in as admin, redirect to login
if ($_SESSION['role'] != 'admin') {
    header('Location: admin_login.php');
    exit();
}

// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "shop";

$conn = new mysqli($servername, $username, $password, $dbname);

echo "<h2>All Orders</h2>";
$sql = "SELECT orders.id, users.name as user_name, products.name as product_name, orders.quantity, orders.order_date 
        FROM orders
        JOIN users ON orders.user_id = users.id
        JOIN products ON orders.product_id = products.id";
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
    echo "<p>Order ID: " . $row['id'] . " | User: " . $row['user_name'] . " | Product: " . $row['product_name'] . 
         " | Quantity: " . $row['quantity'] . " | Date: " . $row['order_date'] . "</p>";
}

// Include the footer
include('footer.php');
?>
