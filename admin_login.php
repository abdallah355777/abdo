<?php
// Include the header
include 'header.php';

// Start session for login check
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "shop";

$conn = new mysqli($servername, $username, $password, $dbname);

$message = "";

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
            $message = "Invalid password!";
        }
    } else {
        $message = "No admin user found with this email!";
    }
}
?>

<section class="login">
    <p><?php echo htmlspecialchars($message); ?></p>
    <div>
        <h2>Admin Portal</h2>
        <form method="POST">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
            <button type="submit" value="Login">Login</button>
        </form>
    </div>
</section>

<?php include 'footer.php'; ?>