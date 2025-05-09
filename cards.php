<?php

if (isset($_POST['add_to_cart']) and $_SERVER['REQUEST_METHOD'] == 'POST') {
  $product_id = intval($_POST['product_id']);
  $quantity = 1;
  $user_id = $_SESSION['user_id'];

  // Insert order into the orders table
  $sql = "INSERT INTO cart (user_id, product_id, quantity) VALUES ('$user_id', '$product_id', '$quantity')";

  $conn->query($sql);
}

echo "<div class='cards-wrapper'>";
while ($row = $result->fetch_assoc()) {
  echo "<div class='card'>";
  echo "<img src='assets/images/". $row['image'] ."' alt='placeholder-image'>";
  echo "<p>" . $row['description'] . "</p>";
  echo "<h3>" . $row['name'] . "</h3>";

  echo "<div>";
  echo "<form action='' method='POST'>
        <input type='hidden' name='product_id' value='" . $row['id'] . "'>
        <button type='submit' name='add_to_cart'>Add to cart</button>
        <p>$" . number_format($row['price'], 2) . "</p>
      </form>";
  echo "</div>";
  echo "</div>";
}
echo "</div>";