<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>My Retail Shop</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>


<?php
// Include the header
include('header.php');

// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "shop";

$conn = new mysqli($servername, $username, $password, $dbname);

echo "<h2>Categories</h2>";
$sql = "SELECT * FROM categories";
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
    echo "<a href='products.php?category_id=" . $row['id'] . "'>" . $row['name'] . "</a><br>";
}

echo "<h2>Featured Products</h2>";
$sql = "SELECT * FROM products";
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
    echo "<div>";
    echo "<h3>" . $row['name'] . "</h3>";
    echo "<p>" . $row['description'] . "</p>";
    echo "<p>Price: $" . $row['price'] . "</p>";
    echo "</div>";
}

// Include the footer
include('footer.php');
?>
