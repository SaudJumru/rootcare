<?php
session_start();
include "connection.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Appointments</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles -->
    <style>
        body {
            background-color: white; /* Set background color to light blue */
            color: #333; /* Set text color to dark gray */
            font-family: Arial, sans-serif; /* Set font family */
            padding-top: 20px; /* Add top padding */
        }
        .container {
            background-color: #fff; /* Set background color of container to white */
            border-radius: 10px; /* Add border radius */
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); /* Add box shadow */
            padding: 20px; /* Add padding */
            margin-bottom: 20px; /* Add bottom margin */
        }
        h2 {
            color: white; /* Set heading color to blue */
            margin-bottom: 10px; /* Add bottom margin */
            margin-top: 10px; /* Add bottom margin */
            text-align: center;
        }
        .appointment-heading {
            background-color: #3fbbc0; /* Set background color to blue */
            color: #fff; /* Set text color to white */
            padding: 10px 20px; /* Add padding */
            border-radius: 10px 10px 0 0; /* Add border radius to top */
        }
        table {
            width: 100%; /* Set table width to 100% */
            border-collapse: collapse; /* Collapse table borders */
            border-radius: 0 0 10px 10px; /* Add border radius to bottom */
            overflow: hidden; /* Hide overflowing content */
        }
        th, td {
            padding: 12px; /* Add padding */
            text-align: left; /* Align text to left */
            border-bottom: 1px solid #ddd; /* Add bottom border */
        }
        th {
            background-color: #3fbbc0; /* Set header background color to blue */
            color: #fff; /* Set header text color to white */
        }
        tr:nth-child(even) {
            background-color: #f2f2f2; /* Set even row background color to light gray */
        }
    </style>
</head>

<body>
    <div class="container">
        <?php
        // Check if user ID is provided
        if(isset($_SESSION['User_ID'])) {
            $user_id = $_SESSION['User_ID'];
            // Fetch appointment details from the database
            $sql = "SELECT * FROM appointment_table WHERE User_ID = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $user_id);
            $stmt->execute();
            $result = $stmt->get_result();

            // Display appointment details
            echo "<div class='appointment-heading'>"; // Add blue background for appointment details heading
            echo "<h2>Appointment Details</h2>";
            echo "</div>"; // Close appointment-heading div
            if ($result->num_rows > 0) {
                echo "<div class='table-responsive'>"; // Make table responsive
                echo "<table class='table table-bordered'><thead class='thead-light'><tr><th>Appointment ID</th><th>Patient Name</th><th>Time</th><th>Service</th><th>View Form</th></tr></thead><tbody>";
                while($row = $result->fetch_assoc()) {
                    echo "<tr><td>".$row["Appointment_ID"]."</td><td>".$row["Patient_Name"]."</td><td>".$row["Time_Slot"]."</td><td>".$row["Service_Name"]."</td><td><a href='appointment-details.php?id=".$row["Appointment_ID"]."'>View</a></td></tr>";
                }
                echo "</tbody></table></div>";
            } else {
                echo "<p>No appointments found for user " . $user_id . ".</p>";
            }

            // Close connection
            $stmt->close();
        } else {
            echo "<p>User ID not provided.</p>";
        }

        // Close database connection
        $conn->close();
        ?>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
