<?php
// Include the header
include'header.php';

// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "shop";

$conn = new mysqli($servername, $username, $password, $dbname);

$category_id = $_GET['category_id'];

// Fetch category name for the title
$sql_category = "SELECT name FROM categories WHERE id = '$category_id'";
$result_category = $conn->query($sql_category);
$category = $result_category->fetch_assoc();

// Fetch products in this category
$sql_products = "SELECT * FROM products WHERE category_id = '$category_id'";
$result = $conn->query($sql_products);

echo "<section class='products-section'>";
echo "<h2>Products in " . $category['name'] . "</h2>";


// Cards
include "cards.php";
echo "</section>";

// Include the footer
include 'footer.php';
