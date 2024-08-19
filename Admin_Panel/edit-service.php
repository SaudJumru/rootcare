<?php
session_start();
include "connection.php";

// Check if Service ID is provided via GET parameter
if (isset($_GET['service_id'])) {
    // Set the Service_ID session variable
    $_SESSION['Service_ID'] = $_GET['service_id'];
} else {
    // Debugging: Output error message
    echo "Service ID not provided in the URL.";
    exit(); // Exit the script
}

// Fetch Service_ID from session
$service_id = $_SESSION['Service_ID'];

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $servicename = $_POST['sname'];
    $servicedescription = $_POST['sdescription'];
    $serviceprice = $_POST['sprice'];
    $servicestatus = $_POST['status'];

    // Update query
    $query_update = "UPDATE services_table SET Service_Name='$servicename', Service_Description='$servicedescription', Service_Price='$serviceprice', S_Active='$servicestatus' WHERE Service_ID='$service_id'";

    // Execute query
    $result_update = mysqli_query($conn, $query_update);

    if ($result_update) {
        // Redirect to services.php or display a success message
        header("Location: services.php");
        exit();
    } else {
        // Handle update error
        echo "Error updating service data: " . mysqli_error($conn);
    }
}

// Query to fetch service data
$query_service = "SELECT * FROM services_table WHERE Service_ID = '$service_id'";
$result_service = mysqli_query($conn, $query_service);

if ($result_service && mysqli_num_rows($result_service) > 0) {
    $service_data = mysqli_fetch_assoc($result_service);
    // Assign service data to variables
    $servicename = $service_data['Service_Name'];
    $serviceprice = $service_data['Service_Price'];
    $servicedescription = $service_data['Service_Description'];
    $servicestatus = $service_data['S_Active'];
    
} else {
    // Handle query error or empty result
    exit("Error fetching service data");
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
    <title>Root Care</title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/select2.min.css">
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
                    <img src="assets/img/teeth.png" width="35" height="35" alt=""> <span>Root Care</span>
                </a>
            </div>
            <!-- <a id="toggle_btn" href="javascript:void(0);"><i class="fa fa-bars"></i></a> -->
            <a id="toggle_btn" href="javascript:void(0);" style="position: relative; top: 50%; transform: translateY(-50%);"><i class="fa fa-bars"></i></a>

            <a id="mobile_btn" class="mobile_btn float-left" href="#sidebar"><i class="fa fa-bars"></i></a>
            <ul class="nav user-menu float-right">
                <li class="nav-item dropdown d-none d-sm-block">
                    <!-- <a href="javascript:void(0);" id="open_msg_box" class="hasnotifications nav-link"><i class="fa fa-comment-o"></i> <span class="badge badge-pill bg-danger float-right">8</span></a> -->
                </li>
                <li class="nav-item dropdown has-arrow">
    <a href="#" class="dropdown-toggle nav-link user-link" data-toggle="dropdown">
        <span class="user-img" style="position: relative; display: inline-block;">
            <img class="rounded-circle" src="assets/img/user.jpg" width="40" alt="Admin">
            <span class="status online" style="position: absolute; bottom: 0; right: -1px;"></span>
        </span>
        <span>Admin</span>
    </a>
    <div class="dropdown-menu">
        <a class="dropdown-item" href="profile.php">My Profile</a>
        <a class="dropdown-item" href="login.html">Logout</a>
    </div>
</li>


            </ul>
            <div class="dropdown mobile-user-menu float-right">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="profile.php">My Profile</a>
                    <a class="dropdown-item" href="login.html">Logout</a>
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
                        <li>
                            <a href="doctors.php"><i class="fa fa-user-md"></i> <span>Doctors</span></a>
                        </li>
                        <li>
                            <a href="patients.php"><i class="fa fa-wheelchair"></i> <span>Patients</span></a>
                        </li>
                        <li>
                            <a href="appointments.php"><i class="fa-regular fa-calendar"></i> <span>Appointments</span></a>
                        </li>
                        <li class="active">
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
                    <div class="col-md-6 offset-md-3">
                        <h4 class="page-title">Edit Service</h4>
                        <form action="" method="post">
                            <div class="form-group">
                                <label>Service Name</label>
                                <input type="text" name="sname" class="form-control" value="<?php echo $servicename; ?>">
                            </div>
                            <div class="form-group">
                                <label>Service Description</label>
                                <input type="text" name="sdescription" class="form-control" value="<?php echo $servicedescription; ?>">
                            </div>
                            <div class="form-group">
                                <label>Service Price</label>
                                <input type="text" name="sprice" class="form-control" value="<?php echo $serviceprice; ?>">
                            </div>
                            <div class="form-group">
    <label>Service Status</label><br>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="status" id="product_active" value="Active" <?php if ($servicestatus == 'Active') echo 'checked'; ?>>
        <label class="form-check-label" for="product_active">Active</label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="status" id="product_inactive" value="Inactive" <?php if ($servicestatus == 'Inactive') echo 'checked'; ?>>
        <label class="form-check-label" for="product_inactive">Inactive</label>
    </div>
</div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary" name="submit">Update Service</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="sidebar-overlay" data-reff=""></div>
        <script src="assets/js/jquery-3.2.1.min.js"></script>
        <script src="assets/js/popper.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/jquery.slimscroll.js"></script>
        <script src="assets/js/select2.min.js"></script>
        <script src="assets/js/app.js"></script>
    </div>
</body>

</html>