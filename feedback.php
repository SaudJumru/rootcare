<?php
// Include database connection
include 'connection.php';

// Check if the form is submitted
if(isset($_POST['submit_feedback'])) {
    // Retrieve form data and sanitize it
    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $lname = mysqli_real_escape_string($conn, $_POST['lname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);

    // Construct SQL query to insert feedback data into the database
    $sql = "INSERT INTO feedback_table (Fname, Lname, Email, Phone, Message) VALUES ('$fname', '$lname', '$email', '$phone', '$message')";

    // Execute SQL query
    if(mysqli_query($conn, $sql)) {
        // Feedback data inserted successfully
        echo "Feedback submitted successfully!";
        header("refresh:2;url=uhome.php");
    } else {
        // Error occurred while inserting data
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    // Close database connection
    mysqli_close($conn);
} else {
    // Redirect to the feedback page if accessed directly without submitting the form
    echo "Data not inserted";
    // header("Location: uhome.php");
    exit();
}
?>
