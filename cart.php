<?php
include 'header.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "shop";

$conn = new mysqli($servername, $username, $password, $dbname);

// Handle checkout
$checkoutSuccess = false;
if (isset($_POST['checkout'])) {
    $user_id = $_SESSION['user_id'];
    $sql = "SELECT * FROM cart WHERE user_id = '$user_id'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $product_id = $row['product_id'];
            $quantity = $row['quantity'];

            $insert = $conn->query("INSERT INTO orders (user_id, product_id, quantity, order_date) 
                                    VALUES ('$user_id', '$product_id', '$quantity', NOW())");

            if (!$insert) {
                echo "<p>Error placing order: " . $conn->error . "</p>";
            }
        }

        // Clear the cart
        $conn->query("DELETE FROM cart WHERE user_id = '$user_id'");
        $checkoutSuccess = true;
    }
}
?>

<main class="cart">
    <div class="cart-wrapper">
        <div class="cart-products-info">
            <div class="cart-products-list">
                <?php if ($checkoutSuccess): ?>
                    <p style="color: green; font-weight: bold;">✅ Order placed successfully!</p>
                <?php endif; ?>
                <table>
                    <tr>
                        <th>Name</th>
                        <th>Quantity</th>
                        <th>Subtotal</th>
                        <th></th>
                    </tr>
                    <?php
                    $subtotal = 0;
                    $user_id = $_SESSION['user_id'];

                    $sql_orders = "SELECT * FROM cart WHERE user_id = '$user_id'";
                    $result_orders = $conn->query($sql_orders);

                    if (isset($_POST['remove_item']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
                        $item_id = intval($_POST['item_id']);
                        $conn->query("DELETE FROM cart WHERE id = '$item_id'");
                    }

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
                                echo "<td>
                                        <form action='' method='POST'>
                                            <input type='hidden' name='item_id' value='" . $row['id'] . "'>
                                            <button type='submit' name='remove_item'>X</button>
                                        </form>
                                    </td>";
                                echo "</tr>";

                                $subtotal += $product_row['price'] * $quantity;
                            }
                        }
                    }
                    ?>
                </table>
            </div>
        </div>
        <div class="cart-bill-info">
            <table>
                <tr>
                    <td>Subtotal</td>
                    <td><?php echo "$" . number_format($subtotal, 2); ?></td>
                </tr>
                <tr>
                    <td>Tax (10%)</td>
                    <td><?php echo "$" . number_format($subtotal * 0.1, 2); ?></td>
                </tr>
                <tr>
                    <td>Total</td>
                    <td><?php echo "$" . number_format($subtotal * 1.1, 2); ?></td>
                </tr>
            </table>
            <div class="cart-order">
                <form method="POST">
                    <button type="submit" name="checkout">Checkout ></button>
                </form>
            </div>
        </div>
    </div>
</main>

<?php include 'footer.php'; ?>
