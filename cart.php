<?php
// Include the header
include 'header.php';

// Start session for user check
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

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
                        <th></th>
                    </tr>
                    <?php
                    $subtotal = 0;

                    $user_id = $_SESSION['user_id'] ?? null;

                    $sql_orders = "SELECT * FROM orders WHERE user_id = '$user_id'";
                    $result_orders = $conn->query($sql_orders);


                    if (isset($_POST['remove_item']) and $_SERVER['REQUEST_METHOD'] == 'POST') {
                        $item_id = intval($_POST['item_id']);

                        // Delete Item from cart table
                        $sql = "DELETE FROM orders WHERE id = '$item_id'";
                        $conn->query($sql);
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
                            } else {
                                echo "<p>Product not found.</p>";
                            }

                            $subtotal += $product_row['price'] * $quantity;
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
                    <td>
                        <?php
                        echo "$" . number_format($subtotal, 2);
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Tax (10%)</td>
                    <td>
                        <?php
                        $tax = $subtotal * 0.1;
                        echo "$" . number_format($tax, 2);
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Total</td>
                    <td>
                        <?php
                        echo "$" . number_format($subtotal + $tax, 2);
                        ?>
                    </td>
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