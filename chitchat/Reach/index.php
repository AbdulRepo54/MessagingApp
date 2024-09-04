<?php include_once "header.php"; ?>
<body>
    <!-- Main wrapper for the page content -->
    <div class="wrapper">
        <!-- Section for the signup form -->
        <section class="form signup">
            <!-- Header text for the form -->
            <header>Reach</header>
            
            <!-- Signup form -->
            <form action="#" enctype="multipart/form-data" autocomplete="off">
                <!-- Container for displaying error messages -->
                <div class="error-txt"></div>
                
                <!-- Container for name input fields -->
                <div class="name-details">
                    <!-- Field for first name -->
                    <div class="field input">
                        <label for="fname">First Name</label>
                        <input type="text" name="fname" id="fname" placeholder="First Name" required>
                    </div>
                    <!-- Field for last name -->
                    <div class="field input">
                        <label for="lname">Last Name</label>
                        <input type="text" name="lname" id="lname" placeholder="Last Name" required>
                    </div>
                </div>
                
                <!-- Field for email address -->
                <div class="field input">
                    <label for="email">Email Address</label>
                    <input type="text" name="email" id="email" placeholder="Enter your email" required>
                </div>
                
                <!-- Field for password -->
                <div class="field input">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" placeholder="Enter new password" required>
                    <i class="fas fa-eye"></i> <!-- Icon to toggle password visibility -->
                </div>
                
                <!-- Field for selecting an image -->
                <div class="field image">
                    <label for="image">Select Image</label>
                    <input type="file" name="image" id="image">
                </div>
                
                <!-- Submit button -->
                <div class="field button">
                    <input type="submit" value="Continue to Chat">
                </div>
            </form>
            
            <!-- Link to login page for already signed-up users -->
            <div class="link">Already signed up? <a href="login.php">Login now</a></div>
        </section>
    </div>

    <!-- JavaScript for showing/hiding password -->
    <script src="scripts/pass-show-hide.js"></script>
    
    <!-- JavaScript for handling signup functionality -->
    <script src="scripts/signup.js"></script>
</body>
</html>
