<?php 
session_start(); // Start the session to access session variables

include_once "config.php"; // Include the database connection settings

$outgoing_id = $_SESSION['unique_id']; // Retrieve the logged-in user's unique ID

// Ensure $conn is not null, meaning the database connection was successful
if ($conn) {
    // Query to select all users except the logged-in user, ordered by user_id in descending order
    $sql = mysqli_query($conn, "SELECT * FROM users WHERE NOT unique_id = {$outgoing_id} ORDER BY user_id DESC");
    $output = ""; // Initialize an empty string to store the output

    // Check the number of rows returned by the query
    if (mysqli_num_rows($sql) == 0) {
        $output .= "No users are available to chat"; // Message when no users are found
    } elseif (mysqli_num_rows($sql) > 0) {
        include "data.php"; // Include the file to process and display the user data
    }

    echo $output; // Output the result or message
} else {
    echo "Database connection error!"; // Error message if the database connection fails
}
?>
