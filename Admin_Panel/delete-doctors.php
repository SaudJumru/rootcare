<?php
// Include database connection
include "connection.php";

// Check if service ID is provided and is numeric
if(isset($_GET['id']) && is_numeric($_GET['id'])) {
    // Escape the service ID to prevent SQL injection
    $user_id = $_GET['id'];

    // Prepare SQL statement to delete the service
    $sql = "DELETE FROM user_table WHERE User_ID = $user_id AND Is_Doctor='1'";

    // Execute the SQL statement
    if ($conn->query($sql) === TRUE) {
        // If deletion is successful, redirect back to the services page
        header("Location: users.php");
        exit();
    } else {
        // If deletion fails, display an error message
        echo "Error deleting service: " . $conn->error;
    }
} else {
    // If service ID is not provided or is not numeric, display an error message
    echo "Invalid service ID";
}

// Close database connection
$conn->close();
?>
