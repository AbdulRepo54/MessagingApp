// Select the password field input and toggle button
const pswordfield = document.querySelector(".form .field input[type='password']"), // Password input field
      toggleBtn = document.querySelector(".form .field i"); // Icon used to toggle password visibility

// Add click event listener to the toggle button
toggleBtn.onclick = () => {
    // Check if the current input type is 'password'
    if (pswordfield.type === "password") {
        // Change the input type to 'text' to show the password
        pswordfield.type = "text";
        // Add 'active' class to the toggle button for visual indication
        toggleBtn.classList.add("active");
    } else {
        // Change the input type back to 'password' to hide the password
        pswordfield.type = "password";
        // Remove 'active' class from the toggle button
        toggleBtn.classList.remove("active");
    }
}
