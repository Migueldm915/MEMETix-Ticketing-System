<?php
    $conn = mysqli_connect('localhost', 'username', 'password', 'memetix');
   
    if (!$conn){
        echo 'Connection error: ' . mysqli_connect_error();
    }

    if(isset($_GET['LastName']) && isset($_GET['FirstName']) && isset($_GET['UserName']) && isset($_GET['Passwords']) && isset($_GET['ConfirmPasswords']) && isset($_GET['Email'])) {
        $lastName = mysqli_real_escape_string($conn, $_GET['LastName']);
        $firstName = mysqli_real_escape_string($conn, $_GET['FirstName']);
        $username = mysqli_real_escape_string($conn, $_GET['UserName']);
        $passwords = mysqli_real_escape_string($conn, $_GET['Passwords']);
        $confirmPasswords = mysqli_real_escape_string($conn, $_GET['ConfirmPasswords']);
        $email = mysqli_real_escape_string($conn, $_GET['Email']);

        // Check if the email or username already exists
        $check_username_query = "SELECT * FROM login_userdetails WHERE UserName='$username'";
        $result_username = mysqli_query($conn, $check_username_query);
        if (mysqli_num_rows($result_username) > 0) {
            $errorusername_message = "Username already exists. Please choose a different one.";
        }

        $check_email_query = "SELECT * FROM login_userdetails WHERE Email='$email'";
        $result_email = mysqli_query($conn, $check_email_query);
        if (mysqli_num_rows($result_email) > 0) {
            $erroremail_message = "Email already exists. Please choose a different one.";
        }

        if (!isset($errorusername_message) && !isset($erroremail_message)) {
            // Proceed with inserting the record
            if ($passwords !== $confirmPasswords) {
                $errorpass_message = "Passwords do not match. Please try again.";
            } else {
                $sql = "INSERT INTO login_userdetails (UserName, Passwords, LastName, FirstName, Email)
                        VALUES ('$username', '$passwords', '$lastName', '$firstName', '$email')";
                if(mysqli_query($conn, $sql)){
                    $success_message = "Record inserted successfully";
                } else{
                    $error_message = "Error: " . $sql . "<br>" . mysqli_error($conn);
                }
            }
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <div class="header">
        <h1>MEMEtix</h1>
    </div>
    <title>User Registration</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <div class="registration-container">
        <h2>User Registration</h2>
        <?php if(isset($error_message)) { ?>
            <p class="error"><?php echo $error_message; ?></p>
        <?php } ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="get">
            <label>Email:</label>
            <input type="email" name="Email" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$">
                <?php if(isset($erroremail_message)) { ?>
                    <p class="erroremail"><?php echo $erroremail_message; ?></p>
                <?php } ?>
            <label>Last Name:</label>
            <input type="text" name="LastName" required>
            <label>First Name:</label>
            <input type="text" name="FirstName" required>
            <label>User Name:</label>
            <input type="text" name="UserName" required>
                <?php if(isset($errorusername_message)) { ?>
                    <p class="errorusername"><?php echo $errorusername_message; ?></p>
                <?php } ?>
            <label>Password:</label>
            <input type="password" name="Passwords" required>
            <label>Confirm Password:</label>
            <input type="password" name="ConfirmPasswords" required>
                <?php if(isset($errorpass_message)) { ?>
                    <p class="errorpass"><?php echo $errorpass_message; ?></p>
                <?php } ?>
            <button type="submit" name="submit">Submit</button>
        </form>
        <a href="user_login.php"><button>Login</button></a>
        <?php if(isset($success_message)) { ?>
            <p class="success"><?php echo $success_message; ?></p>
        <?php } ?>
    </div>
    <div class="footer">
            <p>&copy; 2024 MEMEtix</p>
    </div>
</body>
</html>


