<?php include_once "header.php"; ?>
<body>
    <!-- Main wrapper for the page content -->
    <div class="wrapper">
        <!-- Section for the login form -->
        <section class="form login">
            <!-- Header text for the form -->
            <header>Reach</header>
            
            <!-- Login form -->
            <form action="#">
                <!-- Container for displaying error messages -->
                <div class="error-txt"></div>
                
                <!-- Field for email address -->
                <div class="field input">
                    <label>Email Address</label>
                    <input type="text" name="email" placeholder="Enter your email">
                </div>
                
                <!-- Field for password -->
                <div class="field input">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="Enter your password">
                    <i class="fas fa-eye"></i> <!-- Icon to toggle password visibility -->
                </div>
                
                <!-- Submit button -->
                <div class="field button">
                    <input type="submit" value="Continue to Chat">
                </div>
            </form>
            
            <!-- Link to signup page for users who are not yet signed up -->
            <div class="link">Not yet signed up? <a href="index.php">Signup now</a></div>
        </section>
    </div>

    <!-- JavaScript for showing/hiding password -->
    <script src="scripts/pass-show-hide.js"></script>
    
    <!-- JavaScript for handling login functionality -->
    <script src="scripts/login.js"></script>
</body>
</html>
