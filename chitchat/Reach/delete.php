<?php
include_once 'php/config.php'; // Include the database configuration file; update the path if necessary

// Check if the request is a POST request and contains 'delete' and 'user_id'
if(isset($_POST['delete']) && isset($_POST['user_id'])){
    // Sanitize the user ID to prevent SQL injection
    $user_id = mysqli_real_escape_string($conn, $_POST['user_id']);
    
    // SQL query to delete the user with the specified unique_id
    $sql = "DELETE FROM users WHERE unique_id = '{$user_id}'";
    
    // Execute the SQL query
    if(mysqli_query($conn, $sql)){
        // Redirect to the users page if the deletion was successful
        header("Location: users.php");
        exit(); // Ensure the script stops executing after redirection
    } else {
        // Display an error message if the query fails
        echo "Error deleting user: " . mysqli_error($conn);
    }
}
?>
