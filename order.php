<?php
// Include the header
include('header.php');

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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];
    $user_id = $_SESSION['user_id'];

    // Insert order into the orders table
    $sql = "INSERT INTO orders (user_id, product_id, quantity) VALUES ('$user_id', '$product_id', '$quantity')";

    if ($conn->query($sql) === TRUE) {
        echo "Order placed successfully!";
    } else {
        echo "Error placing order: " . $conn->error;
    }
}
?>

<h2>Place Your Order</h2>
<p>Choose the product and quantity to order:</p>

<?php
// Fetch product details from the database
$product_id = $_POST['product_id'];
$sql_product = "SELECT * FROM products WHERE id = '$product_id'";
$result_product = $conn->query($sql_product);
$product = $result_product->fetch_assoc();

echo "<h3>" . $product['name'] . "</h3>";
echo "<p>" . $product['description'] . "</p>";
echo "<p>Price: $" . $product['price'] . "</p>";
?>

<form method="POST">
    <label for="quantity">Quantity:</label><br>
    <input type="number" id="quantity" name="quantity" value="1" min="1" required><br><br>
    <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
    <input type="submit" value="Place Order">
</form>

<?php
// Include the footer
include('footer.php');
?>
