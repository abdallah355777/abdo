<?php
// Include the header
include('header.php');

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

    // Check admin credentials
    $sql = "SELECT * FROM users WHERE email = '$email' AND role = 'admin'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role'];
            header('Location: admin_dashboard.php');
            exit();
        } else {
            echo "Invalid password!";
        }
    } else {
        echo "No admin user found with this email!";
    }
}
?>

<h2>Admin Login</h2>
<form method="POST">
    <label for="email">Email</label><br>
    <input type="email" id="email" name="email" required><br><br>
    <label for="password">Password</label><br>
    <input type="password" id="password" name="password" required><br><br>
    <input type="submit" value="Login">
</form>

<?php
// Include the footer
include('footer.php');
?>
