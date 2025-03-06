<?php
// Retrieve eventID from URL parameter
$eventID = $_GET['eventID'];

// Establish a connection to the database
$conn = mysqli_connect('localhost', 'username', 'password', 'memetix');

// Check if the connection was successful
if (!$conn){
    echo 'Connection error: ' . mysqli_connect_error();
}

// Fetch event details from the database based on eventID
$event_sql = "SELECT * FROM eventlist WHERE eventID = '$eventID'";
$event_result = mysqli_query($conn, $event_sql);
$event = mysqli_fetch_assoc($event_result);

$section_sql = "SELECT * FROM eventsections WHERE eventID = '$eventID'";
$section_result = mysqli_query($conn, $section_sql);
$sections = mysqli_fetch_assoc($section_result);

// Retrieve quantities from URL parameters
$vipQuantity = $_GET['vipQuantity'];
$lbQuantity = $_GET['lbQuantity'];
$ubQuantity = $_GET['ubQuantity'];
$genadQuantity = $_GET['genadQuantity'];

// Fetch section prices from the database based on eventID
// You can modify this part as per your database schema
$vip_price = $sections['vip_price'];
$lb_price = $sections['lb_price'];
$ub_price = $sections['ub_price'];
$genad_price = $sections['genad_price'];

// Calculate subtotal for each section
$vip_subtotal = $vip_price * $vipQuantity;
$lb_subtotal = $lb_price * $lbQuantity;
$ub_subtotal = $ub_price * $ubQuantity;
$genad_subtotal = $genad_price * $genadQuantity;

// Calculate total amount
$total = $vip_subtotal + $lb_subtotal + $ub_subtotal + $genad_subtotal;

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
    <title>Checkout</title>
    <link rel="stylesheet" href="checkout_styles.css">
</head>
<body>
    <div class="container">
        <h1 class="header">Checkout</h1>
        <div class="card">
            <h2 class="card-header"><?php echo $event['eventname']; ?></h2>
            <div class="card-body">
                <p>Date: <?php echo $event['date']; ?></p>
                <p>Venue: <?php echo $event['venue']; ?></p>
            </div>
        </div>

        <!-- Display section quantities and subtotals -->
        <div class="section-details">
            <h3>Section Details</h3>
            <ul>
                <li>VIP Section: Quantity - <?php echo $vipQuantity; ?>, Subtotal - $<?php echo $vip_subtotal; ?></li>
                <li>Lower Box Section: Quantity - <?php echo $lbQuantity; ?>, Subtotal - $<?php echo $lb_subtotal; ?></li>
                <li>Upper Box Section: Quantity - <?php echo $ubQuantity; ?>, Subtotal - $<?php echo $ub_subtotal; ?></li>
                <li>General Admission Section: Quantity - <?php echo $genadQuantity; ?>, Subtotal - $<?php echo $genad_subtotal; ?></li>
            </ul>
        </div>

        <!-- Display total amount -->
        <div class="total-amount">
            <h3>Total Amount: $<?php echo $total; ?></h3>
        </div>

        <!-- Proceed to Payment Button -->
        <form class="form" action="payment.php" method="post">
            <input type="hidden" name="eventID" value="<?php echo $eventID; ?>">
            <input type="hidden" name="totalAmount" value="<?php echo $total; ?>">
            <button href="payment.php?eventID=<?php echo $eventID; ?>" class="btn" type="submit">Proceed to Payment</button>
        </form>
        
    </div>
    <div class="footer">
            <p>&copy; 2024 MEMEtix</p>
    </div>
</body>
</html>

