<?php
// Establish a connection to the database
$conn = mysqli_connect('localhost', 'username', 'password', 'memetix');

// Check if the connection was successful
if (!$conn){
    echo 'Connection error: ' . mysqli_connect_error();
    exit;
}

// Retrieve eventID and paymentMode from URL parameters
$eventID = $_GET['eventID'];
$paymentMode = $_GET['paymentMode'];

// Fetch checkout details from the database based on eventID
$checkout_sql = "SELECT * FROM checkout WHERE eventID = '$eventID'";
$checkout_result = mysqli_query($conn, $checkout_sql);
$checkout = mysqli_fetch_assoc($checkout_result);

// Fetch event details from the database based on eventID
$event_sql = "SELECT * FROM eventlist WHERE eventID = '$eventID'";
$event_result = mysqli_query($conn, $event_sql);
$event = mysqli_fetch_assoc($event_result);


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
    <title>Ticket Confirmation</title>
    <link rel="stylesheet" href="ticket_styles.css">
</head>
<body>
    <div class="ticket-container">
        <div class="ticket">
            <h1>Thank you for purchasing at MEMEtix!</h1>
            <?php if (!empty($event) && !empty($checkout)) { ?>
                <p>See you at <?php echo $event['eventname']; ?>!</p>
                <p>Payment ID: <?php echo $checkout['paymentID']; ?></p>
            <?php } else { ?>
                <p>Error: Ticket details not found.</p>
            <?php } ?>
        </div>
    </div>
    <div class="footer">
            <p>&copy; 2024 MEMEtix</p>
    </div>
</body>
</html>

