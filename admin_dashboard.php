<?php
// Include the header
include 'header.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "shop";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Run SQL query to fetch all orders, including user and product details
$sql = "SELECT orders.order_group_id, users.name AS user_name, products.name AS product_name, 
               orders.quantity, orders.order_date
        FROM orders
        JOIN users ON orders.user_id = users.id
        JOIN products ON orders.product_id = products.id
        ORDER BY orders.order_group_id DESC, orders.order_date DESC";

$result = $conn->query($sql);

// Display the dashboard
echo '<div class="admin-dashboard">';
echo '<h2 class="dashboard-title">All Orders</h2>';
echo '<div class="table-container">';
echo '<table class="admin-table">';
echo '<thead><tr><th>Order Group ID</th><th>User</th><th>Product</th><th>Quantity</th><th>Date</th></tr></thead>';
echo '<tbody>';

$order_group_id = null; // Track the current order group

while ($row = $result->fetch_assoc()) {
    // Display a new group ID if it changes
    if ($row['order_group_id'] !== $order_group_id) {
        // Update the current group ID
        $order_group_id = $row['order_group_id'];

        // Add a separator for the new order group
        echo "<tr><td colspan='5' class='group-header'>Order Group ID: {$order_group_id}</td></tr>";
    }

    // Display the order details
    echo "<tr>
            <td>{$row['order_group_id']}</td>
            <td>{$row['user_name']}</td>
            <td>{$row['product_name']}</td>
            <td>{$row['quantity']}</td>
            <td>{$row['order_date']}</td>
        </tr>";
}

echo '</tbody></table></div></div>';

include 'footer.php';
?>
