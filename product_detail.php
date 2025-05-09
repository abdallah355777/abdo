<?php
// product_detail.php
session_start();
include 'header.php';

// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "shop";

$conn = new mysqli($servername, $username, $password, $dbname);


if (!isset($_GET['product_id'])) {
  echo "Product not found.";
  exit;
}

$product_id = $_GET['product_id'];
$sql = "SELECT * FROM `products` WHERE id = $product_id;";
$result = $conn->query($sql);

if ($result->num_rows === 0) {
  echo "Product not found.";
  exit;
}

$product = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>

<head>
  <title><?php echo $product['name']; ?></title>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <main class="product-detail">
    <div class="product-image">
      <img src="assets/images/products/placeholder.jpg" alt="Product Image">
    </div>
    <div class="product-info">
      <h2><?php echo $product['name']; ?></h2>
      <p class="product-price">$<?php echo $product['price']; ?></p>
      <p class="product-description"><?php echo $product['description']; ?></p>

      <form method="POST" action="add_to_cart.php" class="add-to-cart-form">
        <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">

        <div>
          <label for="quantity">Quantity:</label>
          <input type="number" id="quantity" name="quantity" value="1" min="1" required>
        </div>

        <button type="submit" class="btn">Add to Cart</button>
      </form>
    </div>
  </main>
</body>

</html>

<?php
include 'footer.php';
?>