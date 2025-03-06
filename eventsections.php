<?php
// Establish a connection to the database
$conn = mysqli_connect('localhost', 'username', 'password', 'memetix');

// Check if the connection was successful
if (!$conn){
    echo 'Connection error: ' . mysqli_connect_error();
}

// Check if eventID is set in the URL
if (isset($_GET['eventID'])) {
    // Retrieve eventID from the URL
    $eventID = mysqli_real_escape_string($conn, $_GET['eventID']);

    // Define the query to fetch event details from eventlist table
    $event_sql = "SELECT * FROM eventlist WHERE eventID = '$eventID'";

    // Execute the event query
    $event_result = mysqli_query($conn, $event_sql);

    // Check if any rows were returned for event details
    if (mysqli_num_rows($event_result) > 0) {
        // Fetch the event details as an associative array
        $event = mysqli_fetch_assoc($event_result);
    } else {
        // If no event found with the given eventID
        echo 'Event not found.';
        exit;
    }

    // Define the queries to fetch section details for each section
    $vip_sql = "SELECT vip_price, vip_count FROM eventsections WHERE eventID = '$eventID'";
    $lb_sql = "SELECT lb_price, lb_count FROM eventsections WHERE eventID = '$eventID'";
    $ub_sql = "SELECT ub_price, ub_count FROM eventsections WHERE eventID = '$eventID'";
    $genad_sql = "SELECT genad_price, genad_count FROM eventsections WHERE eventID = '$eventID'";

    // Execute the queries
    $vip_result = mysqli_query($conn, $vip_sql);
    $lb_result = mysqli_query($conn, $lb_sql);
    $ub_result = mysqli_query($conn, $ub_sql);
    $genad_result = mysqli_query($conn, $genad_sql);

    // Fetch section details for each section
    $vip = mysqli_fetch_assoc($vip_result);
    $lb = mysqli_fetch_assoc($lb_result);
    $ub = mysqli_fetch_assoc($ub_result);
    $genad = mysqli_fetch_assoc($genad_result);
} else {
    // If eventID is not set in the URL
    echo 'Event ID not provided.';
    exit;
}

// Close the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <div class="header">
        <h1>MEMEtix</h1>
        <a href="home.php" class="logout">Back</a>
    </div>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $event['eventname']; ?> Details</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        .event-image {
            max-width: 200px; /* Adjust the maximum width as needed */
            height: auto;
        }
    </style>
</head>
<body>
    <div class="event-container">
        <div class="registration-container">
            <img src="<?php echo $event['picture']; ?>" alt="Event Poster" class="event-image">
            <h2><?php echo $event['eventname']; ?></h2>
            <p>Date: <?php echo $event['date']; ?></p>
            <p>Time: <?php echo $event['time']; ?></p>
            <p>Venue: <?php echo $event['venue']; ?></p>
        </div>
    </div>
    <div class="login-container">
        <!-- Section details -->
        <div class="section-details">
            <!-- VIP Section -->
            <div class="section">
                <h3>VIP Section</h3>
                <p>Price: $<?php echo $vip['vip_price']; ?></p>
                <p>Capacity: <?php echo $vip['vip_count']; ?></p>
                <label>Quantity:</label>
                <input type="number" name="vipQuantity" min="0" value="0" oninput="validateQuantity()">
            </div>

            <!-- Lower Box (LB) Section -->
            <div class="section">
                <h3>Lower Box (LB) Section</h3>
                <p>Price: $<?php echo $lb['lb_price']; ?></p>
                <p>Capacity: <?php echo $lb['lb_count']; ?></p>
                <label>Quantity:</label>
                <input type="number" name="lbQuantity" min="0" value="0" oninput="validateQuantity()">
            </div>

            <!-- Upper Box (UB) Section -->
            <div class="section">
                <h3>Upper Box (UB) Section</h3>
                <p>Price: $<?php echo $ub['ub_price']; ?></p>
                <p>Capacity: <?php echo $ub['ub_count']; ?></p>
                <label>Quantity:</label>
                <input type="number" name="ubQuantity" min="0" value="0" oninput="validateQuantity()">
            </div>

            <!-- General Admission (Gen Ad) Section -->
            <div class="section">
                <h3>General Admission (Gen Ad) Section</h3>
                <p>Price: $<?php echo $genad['genad_price']; ?></p>
                <p>Capacity: <?php echo $genad['genad_count']; ?></p>
                <label>Quantity:</label>
                <input type="number" name="genadQuantity" min="0" value="0" oninput="validateQuantity()">
            </div>

            <!-- Buy Tickets Button -->
            <p><button id="buyTicketsBtn" href="checkout.php" onclick="buyTickets()" disabled>Buy Tickets</button></p>
            <p id="validationMessage" style="color: red; display: none;">Please enter at least one quantity greater than 0.</p>
        </div>
    </div>
    <div class="footer">
            <p>&copy; 2024 MEMEtix</p>
    </div>

    <!-- JavaScript to handle ticket purchase -->
    <script>
        function validateQuantity() {
            var vipQuantity = parseInt(document.getElementsByName("vipQuantity")[0].value);
            var lbQuantity = parseInt(document.getElementsByName("lbQuantity")[0].value);
            var ubQuantity = parseInt(document.getElementsByName("ubQuantity")[0].value);
            var genadQuantity = parseInt(document.getElementsByName("genadQuantity")[0].value);

            if (vipQuantity > 0 || lbQuantity > 0 || ubQuantity > 0 || genadQuantity > 0) {
                document.getElementById("buyTicketsBtn").disabled = false;
                document.getElementById("validationMessage").style.display = "none";
            } else {
                document.getElementById("buyTicketsBtn").disabled = true;
                document.getElementById("validationMessage").style.display = "block";
            }
        }


        function buyTickets() {
            var vipQuantity = parseInt(document.getElementsByName("vipQuantity")[0].value);
            var lbQuantity = parseInt(document.getElementsByName("lbQuantity")[0].value);
            var ubQuantity = parseInt(document.getElementsByName("ubQuantity")[0].value);
            var genadQuantity = parseInt(document.getElementsByName("genadQuantity")[0].value);


            // Redirect to checkout page with quantity parameters
            var redirectUrl = "checkout.php?eventID=<?php echo $eventID; ?>&vipQuantity=" + vipQuantity +
                "&lbQuantity=" + lbQuantity + "&ubQuantity=" + ubQuantity + "&genadQuantity=" + genadQuantity;
            window.location.href = redirectUrl;
        }

    </script>
</body>
</html>
