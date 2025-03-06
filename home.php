<?php
// Establish a connection to the database
$conn = mysqli_connect('localhost', 'username', 'password', 'memetix');

// Check if the connection was successful
if (!$conn){
    echo 'Connection error: ' . mysqli_connect_error();
}

// Define the query to fetch all events
$sql = "SELECT * FROM eventlist";

// Execute the query
$result = mysqli_query($conn, $sql);

// Check if any rows were returned
if (mysqli_num_rows($result) > 0) {
    // Initialize an empty array to store events
    $events = [];

    // Fetch each row as an associative array and add it to the events array
    while ($row = mysqli_fetch_assoc($result)) {
        $events[] = $row;
    }
} else {
    // If no events were found, set $events to an empty array
    $events = [];
}

// Close the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <div class="header">
        <h1>MEMEtix</h1>
        <!-- Logout Button -->
        <a href="user_login.php" class="logout">Logout</a>
    </div>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <div class="search-container">
        <input type="text" id="eventSearch" placeholder="Search for events...">
        <button onclick="filterEvents()">Search</button>
    </div>
    <div class="event-container">
        <?php
         // Check if $events is not empty before trying to iterate over it
         if (!empty($events)) {
            foreach ($events as $event) {
                // Individual anchor tag for each event with eventID as a parameter in the URL
                echo '<a href="eventsections.php?eventID=' . $event['eventID'] . '" class="event">';
                echo '<div>';
                echo '<img src="' . $event['picture'] . '" alt="Event Poster">';
                echo '<div class="event-details">';
                echo '<h3>' . $event['eventname'] . '</h3>';
                echo '<p>Date: ' . $event['date'] . '</p>';
                echo '<p>Time: ' . $event['time'] . '</p>';
                echo '<p>Venue: ' . $event['venue'] . '</p>';
                echo '</div>';
                echo '</div>';
                echo '</a>';
            }
        } else {
            // If no events were found
            echo '<p>No events found.</p>';
        }
        ?>
    </div>
    <div class="footer">
        <p>&copy; 2024 MEMEtix</p>
    </div>

    <!-- JavaScript for filtering events -->
    <script>
        function filterEvents() {
            var input, filter, eventContainer, events, event, txtValue;
            input = document.getElementById('eventSearch');
            filter = input.value.toUpperCase();
            eventContainer = document.getElementsByClassName('event-container')[0];
            events = eventContainer.getElementsByClassName('event');
            for (var i = 0; i < events.length; i++) {
                event = events[i];
                txtValue = event.textContent || event.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    event.style.display = "";
                } else {
                    event.style.display = "none";
                }
            }
        }
    </script>
</body>
</html>



