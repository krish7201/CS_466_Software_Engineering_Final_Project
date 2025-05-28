    <?php
    // Database connection parameters
    $hostname = 'database-1.cs1hkdhivv1o.eu-central-1.rds.amazonaws.com';
    $username = 'admin';
    $password = 'euDmg7+0Q4~';
    $database = 'acastat-database';

    // Connect to the database
    $con = mysqli_connect($hostname, $username, $password, $database);

    // Check connection
    if (mysqli_connect_errno()) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Query to select assignmentID, title, and dueDate from assignments table
    $assignmentQuery = "SELECT assignmentID, title, dueDate FROM assignments";

    // Perform query for assignments
    $assignmentResult = mysqli_query($con, $assignmentQuery);

    // Initialize an array to store events
    $events = []; //only used once

    // Check if query was successful
    if ($assignmentResult) {
        // Fetch data from the result set (assignmentID, title, dueDate from assignments)
        while ($row = mysqli_fetch_assoc($assignmentResult)) {
            $title = $row['title'];
            $dueDate = $row['dueDate'];

            // Format dueDate to match JavaScript date format (YYYY-MM-DD)
            $formattedDueDate = date('Y-m-d', strtotime($dueDate));

            // Add the title to the events array using dueDate as key
            if (!isset($events[$formattedDueDate])) {
                $events[$formattedDueDate] = [];
            }
            $events[$formattedDueDate][] = $title;
        }

        // Free result set
        mysqli_free_result($assignmentResult);
    } else {
        echo "Error retrieving assignments: " . mysqli_error($con);
    }

    // Close connection
    mysqli_close($con);

    // Convert PHP $events array to JSON format for JavaScript

    $datesJSON = json_encode($formattedDueDate);  //TO-DO: remove
    $titleJSON = json_encode($title); //TO-DO: remove
    $eventsJSON = json_encode($events);
?>