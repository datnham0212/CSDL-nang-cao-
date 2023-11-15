document.addEventListener('DOMContentLoaded', function () {
    var profileIcon = document.getElementById('profile-icon');
    var profileOptions = document.getElementById('profile-options');

    // Show/hide options on profile icon click
    profileIcon.addEventListener('click', function (event) {
        event.stopPropagation(); // Prevent the event from reaching the document click handler

        // Toggle the visibility of profile options
        profileOptions.classList.toggle('show-options');
    });

    // Close options on document click
    document.addEventListener('click', function () {
        profileOptions.classList.remove('show-options');
    });

    // Prevent options from closing when clicked inside the options div
    profileOptions.addEventListener('click', function (event) {
        event.stopPropagation(); // Prevent the event from reaching the document click handler
    });
});


function changePassword() {
    // Implement the logic for changing the password
    // You can show a modal, redirect to a change password page, etc.
    alert("Change Password functionality will be implemented here.");
}
