<?php
    $conn = mysqli_connect('localhost', 'username', 'password', 'memetix');
   
    if (!$conn){
        echo 'Connection error: ' . mysqli_connect_error();
        exit; // Terminate script if connection fails
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve form data for the event
        $eventName = mysqli_real_escape_string($conn, $_POST['eventName']);
        $venue = mysqli_real_escape_string($conn, $_POST['venue']);
        $date = mysqli_real_escape_string($conn, $_POST['date']);
        $time = mysqli_real_escape_string($conn, $_POST['time']);
    
        // Validate and format date
        $date = date("F d, Y", strtotime($date));
    
        // Validate and format time
        $time = date("h:i A", strtotime($time));
    
        // Upload image file
        $targetDir = "";
        $targetFile = $targetDir . basename($_FILES["image"]["name"]);
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        
        // Check if file is a valid image
        $validExtensions = array("jpg", "jpeg", "png");
        if (!in_array($imageFileType, $validExtensions)) {
            echo "Only JPG, JPEG, and PNG files are allowed.";
            exit;
        }
    
        // Insert event details into the database
        $sql = "INSERT INTO eventlist (eventname, venue, date, time, picture) 
                VALUES ('$eventName', '$venue', '$date', '$time', '$targetFile')";
    
        if(mysqli_query($conn, $sql)){
            // Retrieve the generated eventID
            $eventID = mysqli_insert_id($conn);
    
            // Retrieve form data for event sections
            $vipPrice = mysqli_real_escape_string($conn, $_POST['vipPrice']);
            $lbPrice = mysqli_real_escape_string($conn, $_POST['lbPrice']);
            $ubPrice = mysqli_real_escape_string($conn, $_POST['ubPrice']);
            $genadPrice = mysqli_real_escape_string($conn, $_POST['genadPrice']);
            $vipCount = mysqli_real_escape_string($conn, $_POST['vipCount']);
            $lbCount = mysqli_real_escape_string($conn, $_POST['lbCount']);
            $ubCount = mysqli_real_escape_string($conn, $_POST['ubCount']);
            $genadCount = mysqli_real_escape_string($conn, $_POST['genadCount']);
    
            // Insert event section details into the database using the retrieved eventID
            $section_sql = "INSERT INTO eventsections (eventID, vip_price, lb_price, ub_price, genad_price, vip_count, lb_count, ub_count, genad_count) 
                            VALUES ('$eventID', '$vipPrice', '$lbPrice', '$ubPrice', '$genadPrice', '$vipCount', '$lbCount', '$ubCount', '$genadCount')";
    
            if(mysqli_query($conn, $section_sql)){
                $success_message = "Event and sections added successfully!";
            } else {
                $error_message = "Error: " . $section_sql . "<br>" . mysqli_error($conn);
            }
        } else {
            $error_message = "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
    

    // Close the database connection
    mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
<div class="header">
        <h1>MEMEtix</h1>
        <!-- Logout Button -->
        <a href="user_login.php" class="admin2userlogin">User Login</a>
    </div>
    <title>Add Event</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <div class="newevent_container">
        <h2>Add Event</h2>
        <?php if(isset($error_message)) { ?>
            <p class="error"><?php echo $error_message; ?></p>
        <?php } ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data">
            <label>Event Name:</label>
            <input type="text" name="eventName" required>
            <label>Venue:</label>
            <input type="text" name="venue" required>
            <label>Date:</label>
            <input type="date" name="date" required>
            <label>Time:</label>
            <input type="time" name="time" required>
            <label>Upload Image:</label>
            <input type="file" name="image" accept="image/*" required>
            <label>VIP Price:</label>
            <input type="number" name="vipPrice" min="0" step="0.01" required>
            <label>VIP Count:</label>
            <input type="number" name="vipCount" min="0" required>

            <label>Lower Box (LB) Price:</label>
            <input type="number" name="lbPrice" min="0" step="0.01" required>
            <label>LB Count:</label>
            <input type="number" name="lbCount" min="0" required>

            <label>Upper Box (UB) Price:</label>
            <input type="number" name="ubPrice" min="0" step="0.01" required>
            <label>UB Count:</label>
            <input type="number" name="ubCount" min="0" required>

            <label>General Admission (Gen Ad) Price:</label>
            <input type="number" name="genadPrice" min="0" step="0.01" required>
            <label>Gen Ad Count:</label>
            <input type="number" name="genadCount" min="0" required>

            <p> <button type="submit" name="submit">Add Event</button></p>

        </form>
        <?php if(isset($success_message)) { ?>
            <p class="success"><?php echo $success_message; ?></p>
        <?php } ?>
    </div>
    <div class="footer">
        <p>&copy; 2024 MEMEtix</p>
    </div>
</body>
</html>
