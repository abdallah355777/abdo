<?php
include "header.php";

// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "shop";

$conn = new mysqli($servername, $username, $password, $dbname);

echo "<section class='products-section'>";
echo "<h2>Browse Our Products</h2>";
$sql = "SELECT * FROM products";
$result = $conn->query($sql);

// Cards

include "cards.php";

echo "</section>";


// Include the footer
include 'footer.php';
?>