<?php
session_start();

// Check if user is already logged in
if(isset($_SESSION['user_id'])) {
    header("Location: user_dashboard.php");
    exit;
}

$_SESSION['userID'] = $userID;

$conn = mysqli_connect('localhost', 'username', 'password', 'memetix');
   
if (!$conn){
    echo 'Connection error: ' . mysqli_connect_error();
}

// Check login credentials
if (isset($_GET['UserName']) && isset($_GET['Passwords'])) {
       
    $userC = FALSE;
    $userP = FALSE;

    if (empty($_GET['UserName'])) {
        echo 'Input Username <br />';
    } else {
        $username = mysqli_real_escape_string($conn, $_GET['UserName']);
        $userC = TRUE;
    }
   
    if (empty($_GET['Passwords'])) {
        echo 'Input Password <br />';
    } else {
        $passwords = mysqli_real_escape_string($conn, $_GET['Passwords']);
        $passC = TRUE;
    }
   
    if ($userC && $passC){
        $sql = "SELECT * FROM login_userdetails WHERE username='$username' AND passwords='$passwords'";

        $result = mysqli_query($conn, $sql);

        if(mysqli_num_rows($result) == 1) {
            header("Location: home.php");
            exit();
        } else {
            $error_message = "Invalid username or password";
        }
    }   

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>User Login</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <div class="header">
        <h1>MEMEtix</h1>
    </div>
    <div class="container">
        <div class="slideshow-container">
            <div class="mySlides fade">
                <!-- Image 1 -->
                <img src="image1.jpg" style="width:100%">
            </div>

            <div class="mySlides fade">
                <!-- Image 2 -->
                <img src="image2.jpg" style="width:100%">
            </div>

            <div class="mySlides fade">
                <!-- Image 3 -->
                <img src="image3.jpg" style="width:100%">
            </div>

            <div class="mySlides fade">
                <!-- Image 4 -->
                <img src="image4.jpg" style="width:100%">
            </div>

            <div class="mySlides fade">
                <!-- Image 5 -->
                <img src="image5.jpg" style="width:100%">
            </div>

            <div style="text-align:center">
                <span class="dot"></span>
                <span class="dot"></span>
                <span class="dot"></span>
                <span class="dot"></span>
                <span class="dot"></span>
                <!-- Add more dots for additional slides -->
            </div>
        </div>

        <div class="login-container">
            <h2>User Login</h2>
            <?php if(isset($error_message)) { ?>
                <p class="error"><?php echo $error_message; ?></p>
            <?php } ?>
            <form method="get" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <label>Username:</label>
                <input type="text" name="UserName" required><br><br>
                <label>Password:</label>
                <input type="password" name="Passwords" required><br><br>
                <button type="submit" name="submit">Login</button>
            </form>
            <p>Don't have an account? <a href="register.php">Register</a></p>
            <p>Admin? <a href="admin_login.php">Admin Login</a></p>
        </div>
    </div>

    <script src="slideshow.js"></script>

    <div class="footer">
            <p>&copy; 2024 MEMEtix</p>
    </div>

</body>
</html>
