<?php
session_start(); // Start the session to access session variables

// Check if the session variable 'unique_id' is set, meaning the user is logged in
if(isset($_SESSION['unique_id'])){
    include_once "config.php"; // Include the database connection settings
    $outgoing_id = $_SESSION['unique_id']; // The ID of the user who is sending the message
    $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']); // Sanitize the incoming user ID to prevent SQL injection
    $message = mysqli_real_escape_string($conn, $_POST['message']); // Sanitize the message content to prevent SQL injection

    // Check if the message is not empty
    if(!empty($message)){
        // Insert the message into the 'messages' table
        $sql = mysqli_query($conn, "INSERT INTO messages (incoming_msg_id, outgoing_msg_id, msg)
              VALUES ({$incoming_id}, {$outgoing_id}, '{$message}')") or die(); // Execute the query or die on error
    }
}else{
    // If the user is not logged in, redirect them to the login page
    header("location: ../login.php");
}
?>
