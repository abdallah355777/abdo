<?php
// Include the header
include('header.php');

// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "shop";

$conn = new mysqli($servername, $username, $password, $dbname);

$category_id = $_GET['category_id']; // Get category ID from URL

// Fetch category name for the title
$sql_category = "SELECT name FROM categories WHERE id = '$category_id'";
$result_category = $conn->query($sql_category);
$category = $result_category->fetch_assoc();

echo "<h2>Products in " . $category['name'] . "</h2>";

// Fetch products in this category
$sql_products = "SELECT * FROM products WHERE category_id = '$category_id'";
$result_products = $conn->query($sql_products);

while ($row = $result_products->fetch_assoc()) {
    echo "<div>";
    echo "<h3>" . $row['name'] . "</h3>";
    echo "<p>" . $row['description'] . "</p>";
    echo "<p>Price: $" . $row['price'] . "</p>";
    echo "<form action='order.php' method='POST'>
            <input type='hidden' name='product_id' value='" . $row['id'] . "'>
            <input type='number' name='quantity' value='1' min='1' required>
            <input type='submit' value='Add to Order'>
          </form>";
    echo "</div>";
}

// Include the footer
include('footer.php');
?>
