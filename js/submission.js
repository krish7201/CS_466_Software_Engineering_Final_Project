//<!-- Custom JavaScript for dynamic assignment details and form validation -->
// Simulated assignment data (can be retrieved from a database or API)
var assignmentData = {
  title: "Statistics Project",
  deadline: "May 15, 2024",
  description: "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam vehicula justo id justo consectetur, at posuere velit efficitur. Nullam euismod mauris ac fermentum mollis."
};

// Function to populate assignment details
function populateAssignmentDetails() {
  document.getElementById('assignmentTitle').textContent = assignmentData.title;
  document.getElementById('assignmentDeadline').textContent = assignmentData.deadline;
  document.getElementById('assignmentDescription').textContent = assignmentData.description;
}

// Function to enable/disable submit button based on file selection
function enableSubmitButton() {
  var fileInput = document.getElementById('myfile');
  var submitButton = document.getElementById('submitBtn');

  if (fileInput && fileInput.files.length > 0) {
    submitButton.disabled = false;
  } else {
    submitButton.disabled = true;
  }
}

// Function to validate form submission
function validateForm() {
  var fileInput = document.getElementById('myfile');

  if (fileInput && fileInput.files.length === 0) {
    alert('Please select a file to upload.');
    return false;
  }

  return true; // Form will submit if file is selected
}

// Populate assignment details when the page loads
window.onload = function() {
  populateAssignmentDetails();
};