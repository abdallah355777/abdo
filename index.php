<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>My Retail Shop</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
    <?php
    include "header.php"
        ?>

    <section class="hero-section">
        <div>
            <h2>Your <span>One-Stop</span> Online Shop.</h2>
            <p>Browse our categories: food, tools, toys, and more — fast delivery, simple ordering.</p>
            <?php if (!isset($_SESSION['user_id'])): ?>
                <a href="register.php" class="hero-btn">Create an Account</a>
            <?php else: ?>
                <a href="all_products.php" class="hero-btn">Browse product</a>
            <?php endif; ?>
        </div>
        <div>
            <img src="assets/images/online-store.png" alt="online-store">
        </div>
    </section>


    <?php
    // Connect to the database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "shop";

    $conn = new mysqli($servername, $username, $password, $dbname);

    echo "<section class='categories-section'>";
    echo "<h2>CATEGORIES</h2>";
    echo "<div>";
    $sql = "SELECT * FROM categories";
    $result = $conn->query($sql);

    while ($row = $result->fetch_assoc()) {
        $name = $row['name'];
        echo "<a href='category.php?category_id=" . $row['id'] . "'>" . strtoupper($name) . "</a>";
    }
    echo "</div>";
    echo "</section>";

    echo "<section class='products-section'>";
    echo "<h2>Featured Products</h2>";
    $sql = "SELECT * FROM products";
    $result = $conn->query($sql);

    // Cards
    include "cards.php";
    echo "</section>";


    // Include the footer
    include 'footer.php';
    ?>

</body>