<?php
session_start(); // Start the session to access session variables

// Check if the session variable 'unique_id' is set, meaning the user is logged in
if(isset($_SESSION['unique_id'])){
    include_once "config.php"; // Include the database connection settings
    $outgoing_id = $_SESSION['unique_id']; // The ID of the user who is sending the message
    $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']); // Sanitize the incoming user ID to prevent SQL injection
    $output = ""; // Initialize an empty string to store the HTML output

    // SQL query to select all messages between the logged-in user (outgoing) and the other user (incoming)
    $sql = "SELECT * FROM messages 
            LEFT JOIN users ON users.unique_id = messages.outgoing_msg_id
            WHERE (outgoing_msg_id = {$outgoing_id} AND incoming_msg_id = {$incoming_id})
            OR (outgoing_msg_id = {$incoming_id} AND incoming_msg_id = {$outgoing_id}) ORDER BY msg_id";
    $query = mysqli_query($conn, $sql); // Execute the query

    // Check if any messages are found
    if(mysqli_num_rows($query) > 0){
        // Loop through each message and format it for display
        while($row = mysqli_fetch_assoc($query)){
            // Check if the message is sent by the logged-in user
            if($row['outgoing_msg_id'] === $outgoing_id){ // Message sender
                // Append the HTML for an outgoing message
                $output .= '<div class="chat outgoing">
                            <div class="details">
                                <p>'. $row['msg'] .'</p>
                            </div>
                            </div>';
            }else{ // Message receiver
                // Append the HTML for an incoming message, including the user's profile image
                $output .= '<div class="chat incoming">
                            <img src="php/images/'. $row['img'] .'" alt="">
                            <div class="details">
                                <p>'. $row['msg'] .'</p>
                            </div>
                            </div>';
            }
        }
    }else{
        // If no messages are found, display a default message
        $output .= '<div class="text">No messages are available. Once you send a message, they will appear here.</div>';
    }
    echo $output; // Output the generated HTML
}else{
    // If the user is not logged in, redirect them to the login page
    header("location: ../login.php");
}
?>
