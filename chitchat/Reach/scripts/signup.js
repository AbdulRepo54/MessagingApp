// Select DOM elements
const form = document.querySelector(".signup form"), // The signup form
    continueBtn = form.querySelector(".button input"), // The submit button inside the form
    errorText = form.querySelector(".error-txt"); // Element to display error messages

// Prevent form from submitting the default way
form.onsubmit = (e) => {
    e.preventDefault(); // Stop the form from submitting
};

// Handle click event on the continue button
continueBtn.onclick = () => {
    if (validateSignupForm()) { // Validate form data
        // Create new XMLHttpRequest object for AJAX request
        let xhr = new XMLHttpRequest(); 
        xhr.open("POST", "php/signup.php", true); // Open a POST request to signup.php
        xhr.onload = () => {
            if (xhr.readyState === XMLHttpRequest.DONE) { // Check if request is complete
                if (xhr.status === 200) { // Check if request was successful
                    let data = xhr.response; // Get the response data
                    if (data == "success") { // If signup successful
                        location.href = "users.php"; // Redirect to users.php
                    } else {
                        errorText.textContent = data; // Display error message
                        errorText.style.display = "block"; // Show error text
                    }
                }
            }
        };
        // Create FormData object to send form data via AJAX
        let formData = new FormData(form); 
        xhr.send(formData); // Send the form data to the server
    }
};

// Validate the signup form fields
function validateSignupForm() {
    let isValid = true; // Assume form is valid initially

    // Get form fields
    const fname = form.querySelector("input[name='fname']");
    const lname = form.querySelector("input[name='lname']");
    const email = form.querySelector("input[name='email']");
    const password = form.querySelector("input[name='password']");
    const image = form.querySelector("input[name='image']");

    // Clear previous error messages
    form.querySelectorAll('.error').forEach(span => span.style.display = 'none');
    form.querySelectorAll('input').forEach(input => input.classList.remove('invalid'));

    // Validate First Name
    if (fname.value.trim() === "") {
        displayError(fname, "First Name is required");
        isValid = false;
    }

    // Validate Last Name
    if (lname.value.trim() === "") {
        displayError(lname, "Last Name is required");
        isValid = false;
    }

    // Validate Email
    if (email.value.trim() === "" || !validateEmail(email.value)) {
        displayError(email, "Email address should be non-empty with the format xyz@xyz.xyz.");
        isValid = false;
    }

    // Validate Password
    if (password.value.length < 8 || !/[A-Z]/.test(password.value) || !/[a-z]/.test(password.value)) {
        displayError(password, "Password should be at least 8 characters: 1 uppercase, 1 lowercase.");
        isValid = false;
    }

    // Validate Image
    if (image.value.trim() === "") {
        displayError(image, "Image is required");
        isValid = false;
    }

    return isValid; // Return whether the form is valid or not
}

// Display an error message next to the input field
function displayError(inputElement, message) {
    const errorElement = inputElement.nextElementSibling; // Get the error message span
    errorElement.textContent = message; // Set the error message
    errorElement.style.display = "inline"; // Show the error message
    inputElement.classList.add("invalid"); // Add invalid class to input
}

// Validate email format
function validateEmail(email) {
    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; // Regular expression for validating email
    return re.test(email); // Return true if email matches the pattern
}
