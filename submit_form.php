<?php
$servername = "localhost";  // Use your server's host (e.g., localhost for local development)
$username = "root";         // MySQL username
$password = "";             // MySQL password (for local development, it's usually empty)
$dbname = "registration_db";  // Database name (must match the one you created)

$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$address = $_POST['address'];

// Insert data into the database
$sql = "INSERT INTO users (first_name, last_name, email, phone, address)
        VALUES ('$first_name', '$last_name', '$email', '$phone', '$address')";

if ($conn->query($sql) === TRUE) {
    // Prepare a response with the submitted data
    $response = array(
        'message' => 'Registration successful!',
        'first_name' => $first_name,
        'last_name' => $last_name,
        'email' => $email,
        'phone' => $phone,
        'address' => $address
    );
    echo json_encode($response);
} else {
    // In case of error
    echo json_encode(array('message' => 'Error: ' . $conn->error));
}

$conn->close();
?>
