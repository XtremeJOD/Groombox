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
    // Check if all required fields are set
    if (isset($_POST['name'], $_POST['email'], $_POST['phone'], $_POST['preferred_date'], $_POST['message'])) {
        // Prepare and bind SQL statement with placeholders
        $stmt = $conn->prepare("INSERT INTO contact (name, email, phone, preferred_date, message) VALUES (?, ?, ?, ?, ?)");
        
        // Bind parameters
        $stmt->bind_param("sssss", $_POST['name'], $_POST['email'], $_POST['phone'], $_POST['preferred_date'], $_POST['message']);
        
        // Execute the statement
        if ($stmt->execute()) {
            echo "<script>alert('Message sent successfully');</script>";
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
