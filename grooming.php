<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "groombox";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all required fields are set and not empty
    if (!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['pet_name']) && !empty($_POST['grooming_date']) && !empty($_POST['grooming_service'])) {
        // Prepare and bind SQL statement with placeholders
        $stmt = $conn->prepare("INSERT INTO grooming (name, email, pet_name, grooming_date, service) VALUES (?, ?, ?, ?, ?)");
        
        // Bind parameters
        $stmt->bind_param("sssss", $_POST['name'], $_POST['email'], $_POST['pet_name'], $_POST['grooming_date'], $_POST['grooming_service']);
        
        // Execute the statement
        if ($stmt->execute()) {
            echo "<script>alert('Record submitted successfully');</script>";
        } else {
            echo "Error: " . $stmt->error;
        }
        
        // Close statement
        $stmt->close();
    } else {
        echo "Please fill in all required fields.";
    }
}

$conn->close();
?>
