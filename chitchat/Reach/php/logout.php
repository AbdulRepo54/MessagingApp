<?php
session_start(); // Start the session to access session variables

// Check if the 'unique_id' session variable is set, meaning the user is logged in
if(isset($_SESSION['unique_id'])){
    include_once "config.php"; // Include the database connection settings
    
    $logout_id = mysqli_real_escape_string($conn, $_GET['logout_id']); // Sanitize the logout ID from the GET request
    
    // Check if the logout ID is provided
    if(isset($logout_id)){
        $status = "Offline now"; // Set the status to 'Offline now'
        // Update the user's status in the database
        $sql = mysqli_query($conn, "UPDATE users SET status = '{$status}' WHERE unique_id = {$logout_id}");
        
        // Check if the status update was successful
        if($sql){
            session_unset(); // Remove all session variables
            session_destroy(); // Destroy the session
            header("location: ../login.php"); // Redirect to the login page
        }
    }else{
        header("location: ../users.php"); // Redirect to users page if logout ID is not set
    }
}else{
    header("location: ../login.php"); // Redirect to login page if the user is not logged in
}
?>
