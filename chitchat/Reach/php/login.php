<?php
session_start(); // Start the session to manage user login state

include_once "config.php"; // Include the database connection settings

// Sanitize and retrieve email and password from POST request
$email = mysqli_real_escape_string($conn, $_POST['email']);
$password = mysqli_real_escape_string($conn, $_POST['password']);

// Check if both email and password fields are not empty
if(!empty($email) && !empty($password)){
    // Validate user credentials with the database
    $sql = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}' AND password = '{$password}'");
    
    // Check if any user matches the provided email and password
    if(mysqli_num_rows($sql) > 0){
        $row = mysqli_fetch_assoc($sql); // Fetch the user data
        
        // Set the user's status to 'Active now'
        $status = "Active now";
        $sql = mysqli_query($conn, "UPDATE users SET status = '{$status}' WHERE unique_id = {$row['unique_id']}");
        
        // Check if the status update was successful
        if($sql){
            $_SESSION['unique_id'] = $row['unique_id']; // Store the user's unique ID in the session
            echo "success"; // Indicate successful login
        }
    }else{
        echo "Email or Password is incorrect!"; // Error message for invalid credentials
    }

}else{
    echo "All input fields are required!"; // Error message if any input field is empty
}
?>
