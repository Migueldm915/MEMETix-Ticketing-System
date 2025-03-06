<?php
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the username and password are correct
    if ($_POST['username'] === 'admin' && $_POST['password'] === 'admin') {
        // If correct, redirect to add_event.php
        header("Location: add_event.php");
        exit;
    } else {
        // If incorrect, show error message
        $error_message = "Invalid username or password";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <div class="header">
        <h1>MEMEtix</h1>
        <!-- Logout Button -->
        <a href="user_login.php" class="admin2userlogin">User Login</a>
    </div>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="styles.css"> <!-- Assuming you have a CSS file for styling -->
</head>
<body>
    <div class="adminlogin-container">
        <h2>Admin Login</h2>
        <?php if(isset($error_message)) { ?>
            <p class="error"><?php echo $error_message; ?></p>
        <?php } ?>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required><br><br>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required><br><br>
            <button type="submit">Login</button>
        </form>
    </div>
    <div class="footer">
        <p>&copy; 2024 MEMEtix</p>
    </div>
</body>
</html>
