<?php

session_start(); 


require_once 'config/config.php'; 
require_once 'config/user.php';

// Handle login request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

   
    if (loginUser($email, $password)) {
        // Redirect to the dashboard or another protected page
        header("Location: user_dashboard/index.php");
        exit;
    } else {
        $error_message = "Invalid email or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css"> <!-- Optional: Link to your CSS file -->
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <?php if (isset($error_message)): ?>
            <p style="color:red;"><?php echo htmlspecialchars($error_message); ?></p>
        <?php endif; ?>
        <form method="POST" action="login.php">
            <div>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div>
                <button type="submit">Login</button>
            </div>
        </form>
    </div>
</body>
</html>