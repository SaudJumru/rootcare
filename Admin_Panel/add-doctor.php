<?php
include "connection.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $inputFname = $_POST['Fname'];
    $inputLname = $_POST['Lname'];
    $inputEmail = $_POST['Email'];
    $inputPassword = $_POST['Password'];
    // $hashpass=password_hash($inputPassword, PASSWORD_DEFAULT);
    // password_verify($inputPassword,$hashpass);
    $inputDOB = $_POST['DOB'];
    $inputMno = $_POST['Mobile_No'];
    $inputAddress = $_POST['Address'];
    $gender = $_POST['gender'];
    // $Security_Que=$_POST['question'];
    // $Security_Ans=$_POST['answer'];


    $sql = "INSERT INTO user_table (Fname, Lname, Email, Password, DOB, Mobile_No, Address, Gender) VALUES('$inputFname', '$inputLname', '$inputEmail', '$inputPassword', '$inputDOB', '$inputMno', '$inputAddress', '$gender')";
    $result = $conn->query($sql);
    // if(isset($_POST['question'])){
    //     $Security_Que=$_POST['question'];
    //     $s="INSERT INTO user_table(Security_Que) VALUES('$Security_Que')";
    //     $r=$conn->query($s);
    // }
    if ($result) {
        echo "<p style='color: white; font-size: 30px; text-align: center; position: absolute; top: 5%; left: 50%; transform: translate(-50%, -50%);'>Registration Successful</p>";
        //header("refresh:2;url=home.html");
    } else {
        echo "Error: Unable to add the data.";
    }

    $select1 = "SELECT User_ID, Email FROM user_table WHERE Email= '$inputEmail' AND Password= '$inputPassword'";
    $r1 = $conn->query($select1);

    if ($r1->num_rows > 0) {
        $row = $r1->fetch_assoc();
        $userId = $row["User_ID"];

        $updateSql = "UPDATE user_table SET Is_Doctor = 1 WHERE User_ID = $userId";
        $conn->query($updateSql);
        //echo "Registration Successfull";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">


<!-- add-doctor24:06-->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
    <title>Root care</title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/select2.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <!--[if lt IE 9]>
		<script src="assets/js/html5shiv.min.js"></script>
		<script src="assets/js/respond.min.js"></script>
	<![endif]-->
</head>

<body>
    <div class="main-wrapper">
        <div class="header">
            <div class="header-left">
                <a href="index.php" class="logo">
                    <img src="../Admin_Panel/assets/img/teeth.png" width="35" height="35" alt=""> <span>Root Care</span>
                </a>
            </div>
            <a id="toggle_btn" href="javascript:void(0);"><i class="fa fa-bars"></i></a>
            <a id="mobile_btn" class="mobile_btn float-left" href="#sidebar"><i class="fa fa-bars"></i></a>
            <ul class="nav user-menu float-right">

                <li class="nav-item dropdown has-arrow">
                    <a href="#" class="dropdown-toggle nav-link user-link" data-toggle="dropdown">
                        <span class="user-img"><img class="rounded-circle" src="assets/img/user.jpg" width="40" alt="Admin">
                            <span class="status online"></span></span>
                        <span>Admin</span>
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="profile.html">My Profile</a>
                        <a class="dropdown-item" href="edit-profile.html">Edit Profile</a>
                        <a class="dropdown-item" href="settings.html">Settings</a>
                        <a class="dropdown-item" href="../index.php">Logout</a>
                    </div>
                </li>
            </ul>
            <div class="dropdown mobile-user-menu float-right">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="profile.html">My Profile</a>
                    <a class="dropdown-item" href="edit-profile.html">Edit Profile</a>
                    <a class="dropdown-item" href="settings.html">Settings</a>
                    <a class="dropdown-item" href="../index.php">Logout</a>
                </div>
            </div>
        </div>
        <div class="sidebar" id="sidebar">
            <div class="sidebar-inner slimscroll">
                <div id="sidebar-menu" class="sidebar-menu">
                    <ul>
                        <li class="menu-title">Main</li>
                        <li>
                            <a href="index.php"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
                        </li>
                        <li class="active">
                            <a href="doctors.php"><i class="fa fa-user-md"></i> <span>Doctors</span></a>
                        </li>
                        <li>
                            <a href="patients.php"><i class="fa fa-wheelchair"></i> <span>Patients</span></a>
                        </li>
                        <li>
                            <a href="appointments.php"><i class="fa-regular fa-calendar"></i> <span>Appointments</span></a>
                        </li>
                        <li>
                            <a href="services.php"><i class="fa-regular fa-plus-square"></i> <span>Services</span></a>
                        </li>
                        <li>
                            <a href="users.php"><i class="fa-regular fa-user"></i> <span>Users</span></a>
                        </li>
                        <li>
                            <a href="viewfeedbacks.php"><i class="fa-regular fa-comment"></i> <span>Feedbacks</span></a>
                        </li>
                        <li>
                            <a href="../reports/"><i class="fa fa-file"></i> <span>View Reports</span></a>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
        <div class="page-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <h4 class="page-title">Add Doctor</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <form method="POST" action="add-doctor.php" onsubmit="return validation()">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>First Name</label>
                                        <input class="form-control" type="text" name="Fname" id="Fname" required>
                                        <span id="fnm"></span>

                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Last Name</label>
                                        <input class="form-control" type="text" name="Lname" id="Lname" required>
                                        <span id="lnm"></span>

                                    </div>
                                </div>
                                <!-- <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Username <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text">
                                    </div>
                                </div> -->
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input class="form-control" type="email" name="Email" id="email" required>
                                        <span id="mail"></span><br><br>

                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input class="form-control" name="Password" type="password" id="password" required>
                                        <span id="pass"></span><br><br>

                                    </div>
                                </div>
                                <!-- <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Confirm Password</label>
                                        <input class="form-control" type="password">
                                    </div>
                                </div> -->
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Date of Birth</label>
                                        <div class="">
                                            <input type="date" class="form-control" name="DOB">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group gender-select">
                                        <label class="gen-label">Gender:</label>
                                        <div class="form-check-inline">
                                            <label class="form-check-label">
                                                <input type="radio" name="gender" class="form-check-input" value="Male">Male
                                            </label>
                                        </div>
                                        <div class="form-check-inline">
                                            <label class="form-check-label">
                                                <input type="radio" name="gender" class="form-check-input" value="Female">Female
                                            </label>
                                        </div>
                                        <div class="form-check-inline">
                                            <label class="form-check-label">
                                                <input type="radio" name="gender" class="form-check-input" value="Other">Other
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Address</label>
                                                <input type="text" class="form-control" name="Address" required>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Phone </label>
                                        <input class="form-control" type="text" id="Mobile_No" name="Mobile_No" required>
                                        <span id="message"></span><br><br>

                                    </div>
                                </div>
                                <!-- <div class="col-sm-6">
									<div class="form-group">
										<label>Avatar</label>
										<div class="profile-upload">
											<div class="upload-img">
												<img alt="" src="assets/img/user.jpg">
											</div>
											<div class="upload-input">
												<input type="file" class="form-control">
											</div>
										</div>
									</div>
                                </div> -->
                            </div>

                            <!-- <div class="m-t-20 text-center">
                                <button class="btn btn-primary submit-btn">Add Doctor</button>
                            </div> -->
                            <div class="m-t-20 text-center">
                                <input type="submit" value="Add Doctor" class="btn btn-primary submit-btn">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function validation() {
            let n = document.getElementById("Mobile_No").value;
            let e = document.getElementById("email").value;
            let eexp = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            let fn = document.getElementById("Fname").value;
            let ln = document.getElementById("Lname").value;
            let exp = /^[A-Za-z]+$/;
            let p = document.getElementById("password").value;

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

            if (!exp.test(fn)) {
                document.getElementById("fnm").innerHTML = "<font color='red'>Fname must not contain any numeric value</font>";
                return false;
            }

            // if(!eexp.test(e)){
            //     document.getElementById("mail").innerHTML = "Email must not start with '@'";
            //     return false;
            // }

            if (!eexp.test(e)) {
                document.getElementById("mail").innerHTML = "<font color='red'>Email must end in proper way (Eg: @gmai.com, @yahoo.com, etc)</font>";
                return false;
            }

            if (!exp.test(ln)) {
                document.getElementById("lnm").innerHTML = "<font color='red'>Lname must not contain any numeric value</font>";
                return false;
            }


            if (p.length < 8) {
                document.getElementById("pass").innerHTML = "<font color='red'>Pasword must be of minimum 8 characters long</font>";
                return false;
            }

            if (!/[!@#$%^&*()_+{}\[\]:;<>,.?~\\/-]/.test(p)) {
                document.getElementById("pass").innerHTML = "<font color='red'>Password must contain atleast 1 symbolic character</font>";
                return false;
            }
        }
    </script>

    <div class="sidebar-overlay" data-reff=""></div>
    <script src="assets/js/jquery-3.2.1.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.slimscroll.js"></script>
    <script src="assets/js/select2.min.js"></script>
    <script src="assets/js/moment.min.js"></script>
    <script src="assets/js/bootstrap-datetimepicker.min.js"></script>
    <script src="assets/js/app.js"></script>
</body>


<!-- add-doctor24:06-->

</html>