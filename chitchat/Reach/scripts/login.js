// Select the form, continue button, and error text elements
const form = document.querySelector(".login form"),
      continueBtn = form.querySelector(".button input"),
      errorText = form.querySelector(".error-txt");

// Prevent the form from submitting the default way
form.onsubmit = (e) => {
    e.preventDefault(); // Preventing form from submitting
}

// Handle click event on the continue button
continueBtn.onclick = () => {
    // Validate the login form before making an AJAX request
    if (validateLoginForm()) {
        // Create a new XMLHttpRequest object
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "php/login.php", true);
        xhr.onload = () => {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    let data = xhr.response;
                    console.log(data);
                    if (data == "success") {
                        // Redirect to users page on successful login
                        location.href = "users.php";
                    } else {
                        // Display error message if login fails
                        errorText.textContent = data;
                        errorText.style.display = "block";
                    }
                }
            }
        }
        // Create a new FormData object to send form data
        let formData = new FormData(form);
        xhr.send(formData); // Send the form data to PHP
    }
}

// Function to validate the login form inputs
function validateLoginForm() {
    let isValid = true;

    // Select email and password input fields
    const email = form.querySelector("input[name='email']");
    const password = form.querySelector("input[name='password']");

    // Validate email field
    if (email.value.trim() === "" || !validateEmail(email.value)) {
        isValid = false;
        alert("Valid Email Address is required");
        email.focus(); // Focus on email field if invalid
    } else if (password.value.trim() === "") {
        // Validate password field
        isValid = false;
        alert("Password is required");
        password.focus(); // Focus on password field if empty
    }

    return isValid; // Return validation result
}

// Function to validate email format
function validateEmail(email) {
    // Regular expression to match email format
    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(email); // Return true if email matches the format
}
