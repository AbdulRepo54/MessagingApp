<?php
session_start(); // Start the session to access session variables, if any
include_once "config.php"; // Include the database connection settings

// Fetch all users from the database
$result = mysqli_query($conn, "SELECT user_id, fname, lname FROM users"); // Execute a SQL query to get user_id, first name, and last name of all users

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Members to Group</title> <!-- Set the title of the page -->
</head>
<body>
    <h2>Select Users to Add to Group</h2> <!-- Header indicating the purpose of the page -->
    
    <form action="add-members.php" method="POST"> <!-- Form to submit selected users to add to the group -->
        <input type="hidden" name="group_id" value="<?php echo $_GET['group_id']; ?>"> <!-- Hidden input to pass group_id, assuming it's passed as a query parameter -->
        
        <?php
        // Check if the query returned any users
        if(mysqli_num_rows($result) > 0){
            // Loop through the result set and create a checkbox for each user
            while($row = mysqli_fetch_assoc($result)){
                echo "<input type='checkbox' name='user_ids[]' value='{$row['user_id']}'> {$row['fname']} {$row['lname']}<br>"; // Display each user with a checkbox
            }
        } else {
            // Message displayed if no users are found in the database
            echo "No users found.";
        }
        ?>

        <input type="submit" value="Add Members"> <!-- Submit button to add selected members to the group -->
    </form>
</body>
</html>
