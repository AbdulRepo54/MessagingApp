<?php
   session_start(); // Start the session to access session variables
   include_once "php/config.php"; // Include the database configuration file

   // Check if the user is logged in; if not, redirect to login page
   if(!isset($_SESSION['unique_id'])){
       header("location: login.php");
       exit(); // Ensure the script stops executing after redirection
   }
?>

<?php include_once "header.php"; ?> <!-- Include the header file -->
<body>
    <div class="wrapper">
        <section class="chat-area">
            <header>
              <?php
                // Retrieve the user_id from the query string
                $user_id = mysqli_real_escape_string($conn, $_GET['user_id']);
                
                // Query the database for the user with the given unique_id
                $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$user_id}");
                
                // Check if a user is found
                if(mysqli_num_rows($sql) > 0){
                    $row = mysqli_fetch_assoc($sql); // Fetch the user's details
                } else {
                    // Redirect to users page if the user is not found
                    header("location: users.php");
                    exit(); // Ensure the script stops executing after redirection
                }
              ?>
                <!-- Back to users page button -->
                <a href="users.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
                <!-- Display the user's profile picture -->
                <img src="php/images/<?php echo $row['img'] ?>" alt="">
                <div class="details">
                    <!-- Display the user's full name -->
                    <span><?php echo $row['fname'] . " " . $row['lname'] ?></span>
                    <!-- Display the user's status -->
                    <p><?php echo $row['status'] ?></p>
                </div>
            </header>
            <div class="chat-box">
                <!-- The chat messages will be dynamically inserted here -->
            </div>
            <form action="#" class="typing-area" autocomplete="off">
                <!-- Hidden inputs to store outgoing and incoming user IDs -->
                <input type="text" name="outgoing_id" value="<?php echo $_SESSION['unique_id']; ?>" hidden>
                <input type="text" name="incoming_id" value="<?php echo $user_id; ?>" hidden>
                <!-- Input field for typing messages -->
                <input type="text" name="message" class="input-field" placeholder="Type a message here...">
                <!-- Send button -->
                <button><i class="fab fa-telegram-plane"></i></button>
            </form>
        </section>
    </div>

    <!-- Link to the JavaScript file for handling chat functionality -->
    <script src="scripts/chat.js"></script>

</body>
</html>
