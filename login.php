<?php
// Include the header
include 'header.php';

// Start session for login check
session_start();

// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "shop";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check user credentials
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role'];
            header('Location: index.php');
            exit();
        } else {
            echo "<div class='error'>";
            echo "<p>Invalid password!</p>";
            echo "</div>";
        }
    } else {
        echo "No user found with this email!";
    }
}
?>

<section class="login">
    <div>
        <h2>Login</h2>
        <form method="POST">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
            <button type="submit" value="Login">Login</button>
        </form>

        <p>You don't an account? <a href="register.php">Register</a> here.</p>
    </div>
</section>


<?php
// Include the footer
include 'footer.php';
?>