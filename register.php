<?php
// Include the header
include 'header.php';

// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "shop";

$conn = new mysqli($servername, $username, $password, $dbname);


// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Encrypt password

    // Check if email already exists
    $check_sql = "SELECT * FROM users WHERE email = '$email'";
    $check_result = $conn->query($check_sql);

    if ($check_result->num_rows > 0) {
        // Email already exists
        $message = "Email is already registered. Please use a different one.";
        include "error.php";
    } else {
        // Insert data into the users table
        $sql = "INSERT INTO users (name, email, password, role) VALUES ('$name', '$email', '$password', 'customer')";

        if ($conn->query($sql) === TRUE) {
            header('Location: index.php');
            exit();
        } else {
            $message = " . $conn->error . ";
            include "error.php";
        }
    }
}
?>

<section class="login">
    <div>
        <h2>Create an Account</h2>
        <form method="POST">
            <label for="name">Full Name</label>
            <input type="text" id="name" name="name" required>
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
            <button type="submit">Login</button>
        </form>

        <p>You already have an account? <a href="login.php">Login</a> here.</p>
    </div>
</section>

<?php
// Include the footer
include 'footer.php';
?>