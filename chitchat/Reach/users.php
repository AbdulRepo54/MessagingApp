<?php
session_start(); // Start the session to access session variables

// Check if the user is logged in by verifying the 'unique_id' in the session
if (!isset($_SESSION['unique_id'])) {
    // Redirect to login page if the user is not logged in
    header("location: login.php");
    exit(); // Stop further script execution
}
?>
<?php include_once "header.php"; ?>
<body>
    <!-- Main wrapper for the page content -->
    <div class="wrapper">
        <!-- Section displaying the list of users -->
        <section class="users">
            <header>
                <?php
                include_once "php/config.php"; // Include the database configuration file
                
                // Ensure $conn is not null to avoid database connection errors
                if ($conn) {
                    // Query to fetch the logged-in user's details from the database
                    $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}");
                    
                    // Check if the query returned any results
                    if (mysqli_num_rows($sql) > 0) {
                        $row = mysqli_fetch_assoc($sql); // Fetch the user details
                    } else {
                        // Display an error message if the user is not found
                        echo "User not found.";
                    }
                } else {
                    // Display an error message if there is a database connection issue
                    echo "Database connection error!";
                }
                ?>    
                <div class="content">
                    <!-- Display the logged-in user's profile image and details -->
                    <img src="php/images/<?php echo htmlspecialchars($row['img']); ?>" alt="">
                    <div class="details">
                        <span><?php echo htmlspecialchars($row['fname'] . " " . $row['lname']); ?></span>
                        <p><?php echo htmlspecialchars($row['status']); ?></p>
                    </div>
                </div>
                <!-- Link to log out and redirect to the login page -->
                <a href="php/logout.php?logout_id=<?php echo htmlspecialchars($row['unique_id']); ?>" class="logout">Logout</a>
            </header>
            
            <!-- Search bar for finding users -->
            <div class="search">
                <span class="text">Select a user to start chat</span>
                <input type="text" placeholder="Enter name to search..">
                <button><i class="fas fa-search"></i></button>
            </div>
            
            <!-- Container for displaying the list of users -->
            <div class="users-list">
            </div>
        </section>
    </div>

    <!-- JavaScript file for handling user-related functionality -->
    <script src="scripts/users.js"></script>
</body>
</html>
