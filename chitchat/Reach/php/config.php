<?php
// Database connection settings
$servername = "localhost"; // Server name (usually 'localhost' for local development)
$username = "root"; // Database username (default for XAMPP/WAMP is 'root')
$password = ""; // Database password (default for XAMPP/WAMP is an empty string)
$dbname = "chat"; // Name of the database you want to connect to

// Create connection to the MySQL database
$conn = mysqli_connect($servername, $username, $password, $dbname, 3306); // The last parameter is the port number, default is 3306

// Check connection
if (!$conn) {
    // If the connection fails, terminate the script and output an error message
    die("Connection failed: " . mysqli_connect_error());
}
?>
