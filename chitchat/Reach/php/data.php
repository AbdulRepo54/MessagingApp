<?php
// Loop through each row in the result set from the previous query
while($row = mysqli_fetch_assoc($sql)){
    // Query to get the most recent message between the logged-in user and the current user in the loop
    $sql2 = "SELECT * FROM messages WHERE (incoming_msg_id = {$row['unique_id']} 
            OR outgoing_msg_id = {$row['unique_id']}) AND (outgoing_msg_id = {$outgoing_id} 
            OR incoming_msg_id = {$outgoing_id}) ORDER BY msg_id DESC LIMIT 1";
    $query2 = mysqli_query($conn, $sql2); // Execute the query
    $row2 = mysqli_fetch_assoc($query2); // Fetch the result as an associative array

    // Check if there is a message between the users
    if(mysqli_num_rows($query2) > 0){
        $result = $row2['msg']; // Store the message content if available
    }else{
        $result = "No message available"; // Default message if no conversation exists
    }
    
    // Trim the message if it exceeds 28 characters
    $msg = (strlen($result) > 28) ? substr($result, 0, 28) . '...' : $result;

    // Prefix "You: " if the logged-in user sent the message
    $you = (isset($row2['outgoing_msg_id']) && $outgoing_id == $row2['outgoing_msg_id']) ? "You: " : "";
    
    // Determine if the user is online or offline
    $offline = ($row['status'] == "Offline now") ? "offline" : "";

    // Hide the current user's chat link from their own view
    $hid_me = ($outgoing_id == $row['unique_id']) ? "hide" : "";

    // Append HTML for displaying the user's chat link and status
    $output .= '<a href="chat.php?user_id=' . $row['unique_id'] . '">
                <div class="content">
                <img src="php/images/' . $row['img'] . '" alt="">
                <div class="details">
                    <span>' . $row['fname'] . " " . $row['lname'] . '</span>
                    <p>' . $you . $msg . '</p>
                </div>
                </div>
                <div class="status-dot ' . $offline . '"><i class="fas fa-circle"></i></div>
                </a>';

    // Append a delete button for each user in the list
    $output .= '<form action="delete.php" method="POST" style="display:inline;">
                <input type="hidden" name="user_id" value="' . $row['unique_id'] . '">
                <button type="submit" name="delete" class="delete-btn">Delete</button>
                </form>';
}
?>
