<?php
session_start(); // Start the session to manage user data

include_once "config.php"; // Include the database connection settings

// Sanitize and retrieve form inputs
$fname = mysqli_real_escape_string($conn, $_POST['fname']);
$lname = mysqli_real_escape_string($conn, $_POST['lname']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$password = mysqli_real_escape_string($conn, $_POST['password']);

// Check if all required fields are filled
if(!empty($fname) && !empty($lname) && !empty($email) && !empty($password)){
    // Validate the email format
    if(filter_var($email, FILTER_VALIDATE_EMAIL)){
        // Check for duplicate email addresses
        $sql = mysqli_query($conn, "SELECT email FROM users WHERE email = '{$email}'");
        if(mysqli_num_rows($sql) > 0){
            echo "$email - This email already exists!"; // Notify if email is already used
        } else {
            // Check if an image file was uploaded
            if(isset($_FILES['image'])){
                $img_name = $_FILES['image']['name'];  // Get the name of the uploaded image
                $tmp_name = $_FILES['image']['tmp_name']; // Get the temporary file path

                // Extract the file extension from the image name
                $img_explode = explode('.',$img_name);
                $img_ext = end($img_explode); // Get the file extension

                $extensions = ['png', 'jpeg', 'jpg']; // Allowed image extensions
                if(in_array($img_ext, $extensions) === true){
                    $time = time(); // Get current time to append to image name
                    $new_img_name = $time . $img_name; // Create a new name for the image
                    
                    // Move the uploaded image to the 'images' directory
                    if(move_uploaded_file($tmp_name, "images/" . $new_img_name)){
                        $status = "Active now"; // Set user status
                        $random_id = rand(time(), 10000000); // Generate a random unique ID

                        // Insert the new user into the database
                        $sql2 = mysqli_query($conn, "INSERT INTO users (unique_id, fname, lname, email, password, img, status) 
                                                     VALUES ({$random_id}, '{$fname}', '{$lname}', '{$email}', '{$password}', '{$new_img_name}', '{$status}')");
                        if($sql2){
                            // Retrieve the newly added user's details
                            $sql3 = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}'");
                            if(mysqli_num_rows($sql3) > 0){
                                $row = mysqli_fetch_assoc($sql3);
                                $_SESSION['unique_id'] = $row['unique_id']; // Store the user's unique ID in the session
                                echo "success"; // Notify successful registration
                            }
                        } else {
                            echo "Something went wrong!"; // Error message for failed insertion
                        } 
                    }
                } else {
                    echo "Please select an Image file - jpeg, jpg, png!"; // Error message for unsupported file type
                }
            } else {
                echo "Please select an Image file!"; // Error message if no image file is selected
            }
        }
    } else {
        echo "$email - This is not a valid email"; // Error message for invalid email format
    }
} else {
    echo "All input fields are required!"; // Error message for missing input fields
}
?>
