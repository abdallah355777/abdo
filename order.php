<?php
// Include the header
include 'header.php';

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

<main class="cart">
    <!-- <h2>Your Cart</h2> -->
    <div class="cart-wrapper">
        <div class="cart-products-info">
            <div class="cart-products-list">
                <table>
                    <tr>
                        <th>Name</th>
                        <th>Quantity</th>
                        <th>Subtotal</th>
                    </tr>
                    <?php
                    $user_id = $_SESSION['user_id'] ?? null;

                    $sql_orders = "SELECT * FROM orders WHERE user_id = '$user_id'";
                    $result_orders = $conn->query($sql_orders);

                    if ($result_orders && $result_orders->num_rows > 0) {
                        while ($row = $result_orders->fetch_assoc()) {
                            $product_id = $row["product_id"];
                            $quantity = $row["quantity"];

                            $sql_product = "SELECT * FROM products WHERE id = '$product_id'";
                            $result_product = $conn->query($sql_product);

                            if ($result_product && $product_row = $result_product->fetch_assoc()) {
                                echo "<tr class='cart-item'>";
                                echo "<td>" . htmlspecialchars($product_row['name']) . "</td>";
                                echo "<td>" . intval($quantity) . "</td>";
                                echo "<td>$" . number_format($product_row['price'], 2) . "</td>";
                                echo "</tr>";
                            } else {
                                echo "<p>Product not found.</p>";
                            }
                        }
                    } else {
                        echo "<p>Your cart is empty.</p>";
                    }
                    ?>
                </table>
            </div>
        </div>
        <div class="cart-bill-info">
            <table class="cart-bill-list">
                <tr>
                    <td>subtotal</td>
                    <td>$200.00</td>
                </tr>
                <tr>
                    <td>Tax</td>
                    <td>$35.00</td>
                </tr>
                <tr>
                    <td>Total</td>
                    <td>$235.00</td>
                </tr>
            </table>
            <div class="cart-order">
                <button>Checkout ></button>
            </div>
        </div>
    </div>
</main>

<?php
// Include the footer
include 'footer.php';
?>