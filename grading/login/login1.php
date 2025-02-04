<?php
session_start();

$servername = "localhost"; 
$username = "root"; 
$password = ''; 
$dbname = "user_management"; 

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$signin_email_error = $signin_password_error = "";
$signin_success_message = "";

$signin_email = $signin_password = "";

// Handle signin form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['signin-submit'])) {
    $signin_email = trim($_POST['signin-email']);
    $signin_password = trim($_POST['signin-password']);

    // Validate email
    if (empty($signin_email) || !filter_var($signin_email, FILTER_VALIDATE_EMAIL)) {
        $signin_email_error = "Invalid email format.";
    }

    // Validate password
    if (empty($signin_password)) {
        $signin_password_error = "Password is required.";
    }

    // If no errors, proceed with signin
    if (empty($signin_email_error) && empty($signin_password_error)) {
        $stmt = $conn->prepare("SELECT password FROM user_accounts WHERE email = ?");
        $stmt->bind_param("s", $signin_email);
        $stmt->execute();
        $stmt->store_result();
        
        // Check if the user exists
        if ($stmt->num_rows > 0) {
            $stmt->bind_result($hashed_password);
            $stmt->fetch();
            // Verify the password
            if (password_verify($signin_password, $hashed_password)) {
                $_SESSION['signin_success_message'] = "Signin successful! Welcome back.";
                header("Location: admin.php"); // Redirect to admin dashboard
                exit(); // Ensure script stops executing after redirection
            } else {
                $signin_password_error = "Incorrect password.";
            }
        } else {
            $signin_email_error = "No account found with that email.";
        }
        $stmt->close();
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signin Form</title>
    <link rel="stylesheet" href="style/login.css">
</head>
<body>

<div class="container">
    <div id="signin" class="form">
        <h2>Login Page</h2>
        <form method="POST" action="">
            <div class="form-group">
                <label for="signin-email">Email:</label>
                <input type="email" name="signin-email" id="signin-email" placeholder="Enter your email" required value="<?php echo htmlspecialchars($signin_email); ?>">
                <div class="signin-error error-message"><?php echo $signin_email_error; ?></div>
            </div>
            <div class="form-group">
                <label for="signin-password">Password:</label>
                <input type="password" name="signin-password" id="signin-password" placeholder="Enter your password" required>
                <div class="signin-error error-message"><?php echo $signin_password_error; ?></div>
            </div>
            <button class="btn" type="submit" name="signin-submit">Login</button>

            <?php if ($signin_success_message): ?>
                <div class="success-message"><?php echo $signin_success_message; ?></div>
            <?php endif; ?>
        </form>
    </div>
</div>
</body>
</html>