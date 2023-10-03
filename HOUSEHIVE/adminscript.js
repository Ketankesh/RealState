// Listen for a click on the "Approve" button
$('.approve-button').on('click', function () {
    var row = $(this).closest('tr'); // Get the clicked row
    var propertyID = row.find('td:first').text(); // Get the property ID from the first cell

    // Prepare the data to send via AJAX
    var data = {
        propertyID: propertyID,
        // Add other property details here if needed
    };

    // Send an AJAX request to the server
    $.ajax({
        type: 'POST',
        url: 'approve_property.php', // Replace with the actual PHP script URL
        data: data,
        success: function (response) {
            // Handle the response, e.g., redirect to the Property Lists tab
            window.location.href = 'dashboard.php#property-lists-tab'; // Replace with the correct URL fragment
        }
    });
});


// Listen for a click on the "Reject" button
$('.reject-button').on('click', function () {
    var row = $(this).closest('tr'); // Get the clicked row
    var propertyID = row.find('td:first').text(); // Get the property ID from the first cell

    // Prepare the data to send via AJAX
    var data = {
        propertyID: propertyID,
    };

    // Send an AJAX request to the server
    $.ajax({
        type: 'POST',
        url: 'reject_property.php', // Replace with the actual PHP script URL
        data: data,
        success: function (response) {
            // Reload the current page to reflect the changes
            location.reload();
        }
    });
});
