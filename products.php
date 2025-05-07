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

// Fetch products in this category
$sql_products = "SELECT * FROM products WHERE category_id = '$category_id'";
$result_products = $conn->query($sql_products);

echo "<section class='products-section'>";
echo "<h2>Products in " . $category['name'] . "</h2>";
$sql = "SELECT * FROM products";
$result = $conn->query($sql);

echo "<div class='cards-wrapper'>";
while ($row = $result_products->fetch_assoc()) {
  echo "<div class='card'>";
  echo "<img src='/assets/images/placeholder.jpg' alt='placeholder-image'>";
  echo "<p>" . $row['description'] . "</p>";
  echo "<h3>" . $row['name'] . "</h3>";

  echo "<div>";
  echo "<form action='order.php' method='POST'>
          <input type='hidden' name='product_id' value='" . $row['id'] . "'>
          <button type='submit'>Add to cart</button>
          <p>$" . $row['price'] . "</p>
        </form>";
  echo "</div>";

  echo "</div>";
}
echo "</div>";
echo "</section>";

// Include the footer
include 'footer.php';
