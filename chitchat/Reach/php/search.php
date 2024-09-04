<?php
session_start(); // Start the session to access session variables

include_once "config.php"; // Include the database connection settings

$outgoing_id = $_SESSION['unique_id']; // Get the logged-in user's unique ID
$searchTerm = mysqli_real_escape_string($conn, $_POST['searchTerm']); // Sanitize the search term to prevent SQL injection
$output = ""; // Initialize an empty string to store the search results

// Query to find users who are not the logged-in user and match the search term in first or last name
$sql = mysqli_query($conn, "SELECT * FROM users WHERE NOT unique_id = {$outgoing_id} 
                            AND (fname LIKE '%{$searchTerm}%' OR lname LIKE '%{$searchTerm}%')");

// Check if any users are found
if(mysqli_num_rows($sql) > 0){
    include "data.php"; // Include the file to process and display the user data
}else{
    // If no users are found, set the output message
    $output .= "No user found related to your search term";
}

echo $output; // Output the search results or message
?>
