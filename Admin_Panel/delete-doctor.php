<?php
// Include database connection
include "connection.php";

// Check if doctor ID is provided
if(isset($_POST['User_ID'])) {
    // Sanitize the input to prevent SQL injection
    $doctor_id = $conn->real_escape_string($_POST['User_ID']);

    // SQL query to delete the doctor from the database
    $sql = "DELETE FROM user_table WHERE User_ID = '$doctor_id'";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        // Redirect back to the page where the deletion was initiated
        header("refresh:2;url=Admin_Panel/doctors.php");
        exit();
    } else {
        // Handle errors
        echo "Error deleting record: " . $conn->error;
    }
}
?>
