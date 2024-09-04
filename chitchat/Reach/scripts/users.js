// Select DOM elements
const searchBar = document.querySelector(".users .search input"), // Search input field
      searchBtn = document.querySelector(".users .search button"), // Search button
      usersList = document.querySelector(".users .users-list"); // Container for displaying user list

// Toggle search bar visibility and focus on click
searchBtn.onclick = () => {
    searchBar.classList.toggle("active"); // Show or hide the search bar
    searchBar.focus(); // Focus the search bar
    searchBtn.classList.toggle("active"); // Toggle active class for the button
    searchBar.value = ""; // Clear the search bar input
}

// Handle search input keyup event
searchBar.onkeyup = () => {
    let searchTerm = searchBar.value; // Get the current search term
    if (searchTerm != "") {
        searchBar.classList.add("active"); // Show search bar when there's input
    } else {
        searchBar.classList.remove("active"); // Hide search bar if empty
    }
    // Ajax request to search for users
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php/search.php", true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response; // Get the response data
                usersList.innerHTML = data; // Update users list with the search results
            }
        }
    }
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded"); // Set content type for POST request
    xhr.send("searchTerm=" + encodeURIComponent(searchTerm)); // Send the search term to the server
}

// Periodically refresh the users list
setInterval(() => {
    // Ajax request to get updated users list
    let xhr = new XMLHttpRequest();
    xhr.open("GET", "php/users.php", true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response; // Get the response data
                if (!searchBar.classList.contains("active")) {
                    usersList.innerHTML = data; // Update users list if search bar is not active
                }
            }
        }
    }
    xhr.send(); // Send the request to the server
}, 500); // Refresh every 500 milliseconds

// users.js

// Add event listener for delete buttons
document.addEventListener('click', function(event) {
    if(event.target.classList.contains('delete-btn')) {
        const userId = event.target.previousElementSibling.value; // Get the user ID from hidden input
        if(confirm('Are you sure you want to delete this user?')) {
            deleteUser(userId); // Call deleteUser function if confirmed
        }
    }
});

// Function to handle user deletion
function deleteUser(userId) {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php/delete.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded"); // Set content type for POST request
    xhr.onload = () => {
        if(xhr.readyState === XMLHttpRequest.DONE) {
            if(xhr.status === 200) {
                // Refresh the users list after successful deletion
                location.reload();
            }
        }
    };
    xhr.send("delete=1&user_id=" + userId); // Send delete request to the server
}
