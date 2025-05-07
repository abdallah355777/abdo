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
            <a href="register.php" class="hero-btn">Create an Account</a>
        </div>
        <div>
            <img src="/assets/images/online-store.png" alt="online-store">
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
    echo "<h2>Categories</h2>";
    echo "<div>";
    $sql = "SELECT * FROM categories";
    $result = $conn->query($sql);

    while ($row = $result->fetch_assoc()) {
        $name = $row['name'];
        echo "<a href='products.php?category_id=" . $row['id'] . "'>" . strtoupper($name) . "</a>";
    }
    echo "</div>";
    echo "</section>";

    echo "<section class='products-section'>";
    echo "<h2>Featured Products</h2>";
    $sql = "SELECT * FROM products";
    $result = $conn->query($sql);

    echo "<div class='cards-wrapper'>";
    while ($row = $result->fetch_assoc()) {
        echo "<div class='card'>";
        echo "<a href='product_detail.php?product_id=". $row['id'] ."'>";
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
        echo "</a>";
        echo "</div>";
    }
    echo "</div>";
    echo "</section>";


    // Include the footer
    include 'footer.php';
    ?>

</body>