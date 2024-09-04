<!-- delete-user.php -->
<?php
session_start(); // Start the session to access session variables
include_once "config.php"; // Include the database connection settings

// Check if the session variable 'unique_id' and the POST variable 'user_id' are set
if(isset($_SESSION['unique_id']) && isset($_POST['user_id'])){
    $user_id = mysqli_real_escape_string($conn, $_POST['user_id']); // Sanitize the user ID to prevent SQL injection

    // Execute the query to delete the user from the 'users' table based on their unique ID
    $sql = mysqli_query($conn, "DELETE FROM users WHERE unique_id = {$user_id}");

    // Check if the deletion was successful
    if($sql){
        echo "User deleted successfully."; // Success message
    } else {
        echo "Failed to delete user."; // Error message if the query fails
    }
} else {
    echo "Invalid request."; // Message if the required session or POST variables are not set
}
?>
