<?php
session_start();
include "connection.php";

// Check if appointment ID is provided
if(isset($_GET['id'])) {
    $appointment_id = $_GET['id'];
    
    // Fetch appointment details from the database
    $sql = "SELECT * FROM appointment_table WHERE Appointment_ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $appointment_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    // Close statement
    $stmt->close();
    
    // Check if appointment details are found
    if($result->num_rows > 0) {
        $appointment_details = $result->fetch_assoc();
    } else {
        // Handle if appointment details are not found
        echo "No appointment found for the provided ID.";
        exit(); // Stop further execution
    }
} else {
    // Handle if appointment ID is not provided
    echo "Appointment ID not provided.";
    exit(); // Stop further execution
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Appointment Details</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles -->
    <style>
        body {
            background-color: #3fbbc0; /* Light blue background */
            color: #333; /* Dark gray text */
            font-family: Arial, sans-serif; /* Font family */
            font-size: 16px; /* Font size */
        }
        .container {
            background-color: #fff; /* White container background */
            border-radius: 10px; /* Rounded corners */
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); /* Shadow */
            padding: 20px; /* Padding */
            margin-top: 20px; /* Top margin */
            text-align: left; /* Center alignment */
        }
        h2 {
            color: #3fbbc0; /* Blue heading color */
            text-align: center; /* Center alignment */
            margin-bottom: 30px; /* Bottom margin */
        }
        .form-group label {
            font-weight: bold; /* Bold label text */
        }
        .form-control {
            font-size: 18px; /* Increased font size for form controls */
            color: black;
        }
        .form-control[readonly] {
            background-color: white;
            opacity: 1;
        }
        .btn-primary {
            background-color: #3fbbc0; /* Blue button background */
            border-color: #3fbbc0;
        }
        .btn-primary:hover {
            background-color: #0056b3; /* Darker blue on hover */
            border-color: #0056b3; /* Darker blue border on hover */
        }
    </style>
</head>

<body>
    <div class="container">
        <img src="./assets/img/logo.png" alt="Logo" class="logo" height="40px" width="200px"> <!-- Replace "your-logo.png" with the path to your logo image -->
        <h2>Appointment Details</h2>
        <form method="post" action="appointment-details.php">
            <div class="form-group">
                <label for="appointmentID">Appointment ID:</label>
                <input type="text" class="form-control" id="appointmentID" value="<?php echo $appointment_details['Appointment_ID']; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="patientName">Patient Name:</label>
                <input type="text" class="form-control" id="patientName" value="<?php echo $appointment_details['Patient_Name']; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="timeSlot">Time Slot:</label>
                <input type="text" class="form-control" id="timeSlot" value="<?php echo $appointment_details['Time_Slot']; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="serviceName">Service Name:</label>
                <input type="text" class="form-control" id="serviceName" value="<?php echo $appointment_details['Service_Name']; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="Address">Address:</label>
                <input type="text" class="form-control" id="Address" value="<?php echo $appointment_details['Address']; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="Email">Email:</label>
                <input type="text" class="form-control" id="Email" value="<?php echo $appointment_details['Email']; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="Mobile_Number">Mobile Number:</label>
                <input type="text" class="form-control" id="Mobile_Number" value="<?php echo $appointment_details['Mobile_Number']; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="Date">Date:</label>
                <input type="text" class="form-control" id="Date" value="<?php echo $appointment_details['Date']; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="Time">Time Slot:</label>
                <input type="text" class="form-control" id="Time" value="<?php echo $appointment_details['Time_Slot']; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="Time">Prescription:</label>
                <input type="text" class="form-control" id="Time" value="<?php echo $appointment_details['Prescription']; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="Sprice">Service Price:</label>
                <input type="text" class="form-control" id="Sprice" value="<?php echo $appointment_details['Service_Price']; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="Payment">Payment:</label>
                <input type="text" class="form-control" id="Payment" value="<?php echo $appointment_details['Payment']; ?>" readonly>
            </div>
            <button type="button" class="btn btn-primary" onclick="window.print()">Print</button>
            <a href="../newrootcare1/make-payment/payment gateway/make-payment.php"><button type="button" class="btn btn-primary">Make Payment</button></a>

        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
