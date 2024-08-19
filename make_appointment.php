<?php
session_start();

include "connection.php";
if (!isset($_SESSION['User_ID'])) {
    // Redirect to login page or handle authentication
    // header("Location: login.php");
    exit("User not logged in"); // Or any other action you want to take
}
$user_id = $_SESSION['User_ID'];

// Fetch user data from database
$query_user = "SELECT Fname, Lname, Email, Mobile_No, Address FROM user_table WHERE User_ID = '$user_id'";
$result_user = mysqli_query($conn, $query_user);

// Initialize variables to store user data
$fullname = "";
$email = "";
$mobile_no = "";
$address = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $fullname = $_POST['Fullname'];
    $mobile_no = $_POST['Mobile_No'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $service = $_POST['service'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $issue = $_POST['issue'];

    // Sanitize form data to prevent SQL injection

    $query_check_slot = "SELECT * FROM appointment_table WHERE Date = '$date' AND Time_Slot = '$time'";
    $result_check_slot = mysqli_query($conn, $query_check_slot);

    // Perform database insertion
    $query_insert = "INSERT INTO appointment_table (Patient_Name, Mobile_Number, Email, Address, Service_Name, Date, Time_Slot, Issue, User_ID) 
                     VALUES ('$fullname', '$mobile_no', '$email', '$address', '$service', '$date', '$time', '$issue', '$user_id')";
    $result_insert = mysqli_query($conn, $query_insert);

    if (mysqli_num_rows($result_check_slot) > 0) {
        // Time slot is already booked, display message
        echo "<p style='color: red;font-size:25px;text-align: center;position: absolute;top: 12%;left: 50%; transform: translate(-50%, -50%);'>This time slot is already booked. Please choose a different one.</p>";
    } else {
        // Perform database insertion
        $query_insert = "INSERT INTO appointment_table (Patient_Name, Mobile_Number, Email, Address, Service_Name, Date, Time_Slot, Issue, User_ID) 
                         VALUES ('$fullname', '$mobile_no', '$email', '$address', '$service', '$date', '$time', '$issue', '$user_id')";
        $result_insert = mysqli_query($conn, $query_insert);

        if ($result_insert) {
            // Appointment inserted successfully
            header("refresh:2;url=uhome.php");
            echo "<p style='color: white; font-size: 30px; text-align: center; position: absolute; top: 12%; left: 50%; transform: translate(-50%, -50%);'>Appointment taken successfully !</p>";
        } else {
            // Error handling for database insertion failure
            echo "Error: " . mysqli_error($conn);
        }
    }
}



// Check if query was successful
if ($result_user) {
    // Check if user data is fetched successfully
    if (mysqli_num_rows($result_user) > 0) {
        $user_data = mysqli_fetch_assoc($result_user);
        $fullname = $user_data['Fname'] . " " . $user_data['Lname'];
        $email = $user_data['Email'];
        $mobile_no = $user_data['Mobile_No'];
        $address = $user_data['Address'];
    }
} else {
    // Error handling for query execution failure
    echo "Error: " . mysqli_error($conn);
}

// Fetch data for services dropdown
$query_services = "SELECT Service_Name FROM services_table"; // Assuming 'services' is your table name
$result_services = mysqli_query($conn, $query_services);

// Array to store fetched services
$services = array();

if ($result_services) {
    if (mysqli_num_rows($result_services) > 0) {
        while ($row = mysqli_fetch_assoc($result_services)) {
            $services[] = $row['Service_Name'];
        }
    }
} else {
    // Error handling for query execution failure
    echo "Error: " . mysqli_error($conn);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle form submission logic
}

// Close connection
mysqli_close($conn);
?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!-- <link rel="stylesheet" href="/assets/css/make_appointment.css"> -->
    <style>
        body {
            background-color: #3fbbc0;
        }

        .container {
            padding-top: 5%;
        }

        .message {
            color: white;
            font-size: 30px;
            text-align: center;
            position: absolute;
            top: 12%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .error {
            color: red;
            font-size: 20px;
            text-align: center;
            position: relative;
            top: 12%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .appointment-btn {
            margin-left: 25px;
            background: #3fbbc0;
            color: #fff;
            border-radius: 4px;
            padding: 8px 25px;
            white-space: nowrap;
            transition: 0.3s;
            font-size: 14px;
            display: inline-block;
        }

        .appointment-btn:hover {
            background: #65c9cd;
            color: #fff;
        }
    </style>
    <title>Make Appointment</title>
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="appointment-form col-md-6 offset-md-3 border p-4 shadow bg-light">
                <div class="col-12">
                    <h3 class="fw-normal text-black fs-4 text-uppercase mb-4">Appointment form</h3>
                </div>
                <form action='make_appointment.php<?php //echo htmlspecialchars($_SERVER["PHP_SELF"]); 
                                                    ?>' method="POST" onsubmit="return validation()">
                    <div class="row g-6">
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="Fullname" id="Fname" placeholder="Enter your Full name" required value="<?php echo $fullname; ?>"><br>
                            <span id="fnm"></span><br>
                        </div>
                        <!-- <div class="col-md-6">
                            <input type="text" class="form-control" name="Lname" id="Lname" placeholder="Enter your last name" required><br>
                            <span id="lnm"></span><br>
                        </div> -->
                        <div class="col-md-6">
                            <input type="tel" id="Mobile_No" name="Mobile_No" class="form-control" placeholder="Enter your mobile number" required value="<?php echo $mobile_no; ?>">
                            <span id="message"></span><br>
                        </div>

                        <div class="col-md-6">
                            <input type="text" class="form-control" name="email" id="email" placeholder="Enter your email" required value="<?php echo $email; ?>"><br>
                            <span id="mail"></span><br>
                        </div>
                        <div class="col-md-6">
                            <textarea class="form-control" name="address" placeholder="Enter your address" required><?php echo $address; ?></textarea>
                        </div>
                        <div class="col-6">
                            <select name="service" id="service" required>
                                <option value="" selected disabled>Select Service</option>
                                <?php
                                // Populate dropdown list with fetched data
                                foreach ($services as $service) {
                                    echo "<option value='" . $service . "'>" . $service . "</option>";
                                }
                                ?>
                            </select>
                            <br>
                        </div>





                        <div class="col-md-6">
                            <!-- <div>select date</div> -->
                            <input type="date" name="date" id="date" class="form-control" placeholder="Select Date" required min="<?php echo date('Y-m-d'); ?>"><br>
                        </div>
                        <div class="col-md-6">
                            <div class="col-12">
                                <select name="time" class="form-select" required>
                                    <option selected disabled>Select Time</option>
                                    <option>8AM to 9AM</option>
                                    <option>9AM to 10AM</option>
                                    <option>10AM to 11AM</option>
                                    <option>11AM to 12PM</option>
                                    <option>12pm to 1pm</option>
                                    <option>1PM to 2PM</option>
                                </select>
                            </div>
                        </div>


                        <div class="col-6">
                            <textarea class="form-control" name="issue" placeholder="Describe your Issue"></textarea>
                        </div>
                        <div class="button col-12 mt-5">
                            <!-- <button type="submit" class="btn btn-primary float-end">Book Appointment</button> -->
                            <input type="submit" class="appointment-btn  scrollto" class="btn btn-primary float-end" value="Book Appointment">
                            <a href="uhome.php"><button type="button" class="btn btn-outline-secondary float-end me-2">Cancel</button></a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>



    <script>
        function validation() {
            let n = document.getElementById("Mobile_No").value;
            let e = document.getElementById("email").value;
            let eexp = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            let fn = document.getElementById("Fname").value;
            // let ln = document.getElementById("Lname").value;
            let exp = /^[A-Za-z]+$/;
            // let p = document.getElementById("password").value;

            if (isNaN(n)) {
                document.getElementById("message").innerHTML = "<font color='red'>Please Enter A Numeric Value</font>";
                return false;
            }
            if (n.length < 10) {
                document.getElementById("message").innerHTML = "<font color='red'>Mobile Number Must Be Of 10 Digits</font>";
                return false;
            }
            if (n.length > 10) {
                document.getElementById("message").innerHTML = "<font color='red'>Mobile Number Must Be Of 10 Digits</font>";
                return false;
            }
            if ((n.charAt(0) != 9) && (n.charAt(0) != 8) && (n.charAt(0) != 7) && (n.charAt(0) != 6)) {
                document.getElementById("message").innerHTML = "<font color='red'>Mobile Number Must Start With 9, 8, 7, or 6</font>";
                return false;
            }

            if ((e.charAt(0) == '@')) {
                document.getElementById("mail").innerHTML = "<font color='red'>Email Must Not Start With '@'</font>";
                return false;
            }

            // if(!exp.test(fn)){
            //     document.getElementById("fnm").innerHTML = "<font color='red'>Fullname must not contain any numeric value</font>";
            //     return false;
            // }

            if (!eexp.test(e)) {
                document.getElementById("mail").innerHTML = "Email must not start with '@'";
                return false;
            }

            if (!eexp.test(e)) {
                document.getElementById("mail").innerHTML = "<font color='red'>Email must end in proper way (Eg: @gmai.com, @yahoo.com, etc)</font>";
                return false;
            }

            // if(!exp.test(ln)){
            //     document.getElementById("lnm").innerHTML = "<font color='red'>Lname must not contain any numeric value</font>";
            //     return false;
            // }


            // if(p.length < 8){
            //     document.getElementById("pass").innerHTML = "<font color='red'>Pasword must be of minimum 8 characters long</font>";
            //     return false;
            // }

            // if(!/[!@#$%^&*()_+{}\[\]:;<>,.?~\\/-]/.test(p)){
            //     document.getElementById("pass").innerHTML = "<font color='red'>Password must contain atleast 1 symbolic character</font>";
            //     return false;
            // }
        }
    </script>
</body>

</html>