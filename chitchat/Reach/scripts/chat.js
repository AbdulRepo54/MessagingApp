// Select the form, input field, send button, and chat box elements
const form = document.querySelector(".typing-area"),
      inputField = form.querySelector(".input-field"),
      sendBtn = form.querySelector("button"),
      chatBox = document.querySelector(".chat-box");

// Prevent the form from submitting the default way
form.onsubmit = (e) => {
    e.preventDefault(); // Preventing form from submitting
}

// Handle click event on the send button
sendBtn.onclick = () => {
    // Create a new XMLHttpRequest object for AJAX request
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php/insert-chat.php", true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                inputField.value = "";  // Clear the input field after message is sent
                scrollToBottom(); // Scroll to the bottom to show the latest message
            }
        }
    }
    // Create a new FormData object from the form
    let formData = new FormData(form);
    xhr.send(formData); // Send the form data to PHP
}

// Add and remove 'active' class on chat box based on mouse events
chatBox.onmouseover = () => {
    chatBox.classList.add("active"); // Add 'active' class when mouse is over the chat box
}
chatBox.onmouseleave = () => {
    chatBox.classList.remove("active"); // Remove 'active' class when mouse leaves the chat box
}

// Set up an interval to fetch new chat messages every 500ms
setInterval(() => {
    // Create a new XMLHttpRequest object for AJAX request
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php/get-chat.php", true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response;
                chatBox.innerHTML = data; // Update chat box content with new messages
                if (!chatBox.classList.contains("active")) {
                    scrollToBottom(); // Scroll to the bottom if chat box is not active
                }
            }
        }
    }
    // Create a new FormData object from the form
    let formData = new FormData(form);
    xhr.send(formData); // Send the form data to PHP
}, 500); // Run this function every 500 milliseconds

// Function to scroll chat box to the bottom
function scrollToBottom() {
    chatBox.scrollTop = chatBox.scrollHeight; // Set scroll position to the bottom
}
