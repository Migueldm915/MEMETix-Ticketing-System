<?php
// Establish a connection to the database
$conn = mysqli_connect('localhost', 'username', 'password', 'memetix');

// Check if the connection was successful
if (!$conn) {
    echo 'Connection error: ' . mysqli_connect_error();
    exit;
}

// Retrieve form data from the POST request
$eventID = isset($_POST['eventID']) ? $_POST['eventID'] : '';
$paymentMode = isset($_POST['paymentMode']) ? $_POST['paymentMode'] : '';
$totalAmount = isset($_POST['totalAmount']) ? $_POST['totalAmount'] : 0;
$vipQuantity = isset($_POST['vip_quantity']) ? intval($_POST['vip_quantity']) : 0;
$lbQuantity = isset($_POST['lb_quantity']) ? intval($_POST['lb_quantity']) : 0;
$ubQuantity = isset($_POST['ub_quantity']) ? intval($_POST['ub_quantity']) : 0;
$genadQuantity = isset($_POST['genad_quantity']) ? intval($_POST['genad_quantity']) : 0;

// Update section counts and quantities in the database
$update_sql = "UPDATE eventsections SET 
                vip_count = vip_count - $vipQuantity, 
                lb_count = lb_count - $lbQuantity, 
                ub_count = ub_count - $ubQuantity, 
                genad_count = genad_count - $genadQuantity, 
                vip_quantity = vip_quantity + $vipQuantity, 
                lb_quantity = lb_quantity + $lbQuantity, 
                ub_quantity = ub_quantity + $ubQuantity, 
                genad_quantity = genad_quantity + $genadQuantity 
                WHERE eventID = '$eventID'";

if (mysqli_query($conn, $update_sql)) {
    $success_message = "Section counts and quantities updated successfully!<br>";
} else {
    $error_message = "Error updating section counts and quantities: " . mysqli_error($conn) . "<br>";
}

// Insert payment details into the database
$sql = "INSERT INTO checkout (eventID, payment_mode, payment_date) 
        VALUES ('$eventID', '$paymentMode', NOW())";

if (mysqli_query($conn, $sql)) {
    $success_message = "Checkout processed successfully!";
} else {
    $error_message = "Error processing checkout: " . mysqli_error($conn);
}


// Close the database connection
mysqli_close($conn);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <div class="origheader">
        <h1>MEMEtix</h1>
        <a href="home.php" class="origlogout">Back</a>
    </div>  
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <link rel="stylesheet" href="payment_styles.css">
</head>
<body>
    <div class="container">
        <h1>Payment</h1>
        <?php if(isset($error_message) && !empty($error_message)) { ?>
            <p class="error"><?php echo $error_message; ?></p>
        <?php } ?>
        <?php if(isset($success_message) && !empty($success_message)) { ?>
            <p class="success"><?php echo $success_message; ?></p>
        <?php } ?>
        <p>Total Amount: $<?php echo $totalAmount; ?></p>
        <div class="payment-options">
            <form action="ticket.php?eventID=<?php echo $eventID; ?>&paymentMode=Card" method="post">
            <input type="hidden" name="totalAmount" value="<?php echo $totalAmount; ?>">
            <input type="hidden" name="paymentMode" value="Card">
            <input type="hidden" name="eventID" value="<?php echo $eventID; ?>">
            <input type="hidden" name="vip_quantity" value="<?php echo $vipQuantity; ?>">
            <input type="hidden" name="lb_quantity" value="<?php echo $lbQuantity; ?>">
            <input type="hidden" name="ub_quantity" value="<?php echo $ubQuantity; ?>">
            <input type="hidden" name="genad_quantity" value="<?php echo $genadQuantity; ?>">
            <button class="payment-button" type="submit">Pay with Card</button>
        </form>

        <form action="ticket.php?eventID=<?php echo $eventID; ?>&paymentMode=GCash" method="post">
            <input type="hidden" name="totalAmount" value="<?php echo $totalAmount; ?>">
            <input type="hidden" name="paymentMode" value="GCash">
            <input type="hidden" name="eventID" value="<?php echo $eventID; ?>">
            <input type="hidden" name="vip_quantity" value="<?php echo $vipQuantity; ?>">
            <input type="hidden" name="lb_quantity" value="<?php echo $lbQuantity; ?>">
            <input type="hidden" name="ub_quantity" value="<?php echo $ubQuantity; ?>">
            <input type="hidden" name="genad_quantity" value="<?php echo $genadQuantity; ?>">
            <button class="payment-button" type="submit">Pay with GCash</button>
        </form>

        </div>
    </div>
    <div class="footer">
            <p>&copy; 2024 MEMEtix</p>
    </div>
</body>
</html>
