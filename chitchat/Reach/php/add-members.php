<?php
session_start(); // Start the session to access session variables, if any
include_once "config.php"; // Include the database connection settings

// Check if both 'group_id' and 'user_ids' are set in the POST request
if(isset($_POST['group_id']) && isset($_POST['user_ids'])){
    $group_id = mysqli_real_escape_string($conn, $_POST['group_id']); // Sanitize the group ID to prevent SQL injection
    $user_ids = $_POST['user_ids']; // Get the array of selected user IDs

    // Loop through each user ID in the array
    foreach($user_ids as $user_id){
        $user_id = mysqli_real_escape_string($conn, $user_id); // Sanitize each user ID
        // Insert the group_id and user_id into the group_members table
        mysqli_query($conn, "INSERT INTO group_members (group_id, user_id) VALUES ('{$group_id}', '{$user_id}')");
    }
    header("Location: groups.php"); // Redirect to the groups page after successfully adding members
    exit(); // Ensure no further code is executed after redirection
} else {
    // Display a message if no users were selected
    echo "Please select at least one user.";
}
?>
