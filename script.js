$(document).ready(function() {
    $('#registrationForm').on('submit', function(e) {
        e.preventDefault(); // Prevent form from reloading page
        
        var formData = $(this).serialize(); // Get form data
        
        $.ajax({
            url: 'submit_form.php',  // PHP script to handle form submission
            type: 'POST',
            data: formData,
            success: function(response) {
                var data = JSON.parse(response);

                // Display success message
                $('#responseMessage').html(data.message).addClass('success');

                // Display submitted data in a structured format
                $('#submittedData').html(`
                    <h2>Submitted Information:</h2>
                    <p><strong>First Name:</strong> ${data.first_name}</p>
                    <p><strong>Last Name:</strong> ${data.last_name}</p>
                    <p><strong>Email:</strong> ${data.email}</p>
                    <p><strong>Phone:</strong> ${data.phone}</p>
                    <p><strong>Address:</strong> ${data.address}</p>
                `).addClass('submitted-info');

                // Reset the form after submission
                $('#registrationForm')[0].reset();  
            },
            error: function() {
                $('#responseMessage').html("There was an error processing your request.").addClass('error');
            }
        });
    });
});
