<?php
include "connection.php";
// include "config.php";
$sql = "SELECT * FROM services_table";
$res = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">


<!-- departments23:21-->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
    <title>Services</title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/dataTables.bootstrap4.min.css">
    <!-- <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
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
					<img src="../Doctor_Panel/assets/img/teeth.png" width="35" height="35" alt=""> <span>Root Care</span>
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
						<a class="dropdown-item" href="profile.php">My Profile</a>
						<a class="dropdown-item" href="edit-profile.html">Edit Profile</a>
						<a class="dropdown-item" href="settings.html">Settings</a>
						<a class="dropdown-item" href="../index.php">Logout</a>
					</div>
                </li>
            </ul>
            <div class="dropdown mobile-user-menu float-right">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="profile.php">My Profile</a>
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
                    <div class="col-sm-5 col-5">
                        <h4 class="page-title">Services</h4>
                    </div>
                    <div class="col-sm-7 col-7 text-right m-b-30">
                        <a href="add-service.php" class="btn btn-primary btn-rounded"><i class="fa fa-plus"></i> Add Service</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-striped custom-table mb-0 datatable">
                                <thead>
                                    <tr>
                                        <th>Service ID</th>
                                        <th>Service Name</th>
                                        <th>Serivce Price</th>
                                        <th>Serivce Description</th>
                                        <th>Serivce Status</th>
                                        <th class="text-right">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                        if ($res->num_rows > 0) {
                                            while($row = $res->fetch_assoc()) {
                                                echo "<tr>";
                                                echo "<td><h4>".$row["Service_ID"]."</h4></td>";
                                                echo "<td><h4>".$row["Service_Name"]."</4></td>";
                                                echo "<td><h4>".$row["Service_Price"]."</h4></td>";
                                                echo "<td><h4>".$row["Service_Description"]."</h4></td>";
                                                echo "<td><h4 ".$row["S_Active"].">".$row["S_Active"]."</h4></td>";
                                                echo "<td class='text-right'>";
                                                echo "<div class='dropdown dropdown-action'>";
                                                echo "<a href='#' class='action-icon dropdown-toggle' data-toggle='dropdown' aria-expanded='false'><i class='fa fa-ellipsis-v'></i></a>";
                                                echo "<div class='dropdown-menu dropdown-menu-right'>";
                                                // echo "<a class='dropdown-item' href='edit-service.php?id=".$row["Service_ID"]."'><i class='fa fa-pencil m-r-5'></i> Edit</a>";
                                                echo "<a class='dropdown-item' href='edit-service.php?service_id=".$row["Service_ID"]."'><i class='fa fa-pencil m-r-5'></i> Edit</a>";
                                                echo "<a class='dropdown-item' href='#' data-toggle='modal' data-target='#delete_service_".$row["Service_ID"]."'><i class='fa fa-trash-o m-r-5'></i> Delete</a>";
                                                echo "</div>";
                                                echo "</div>";
                                                echo "</td>";
                                                echo "</tr>";

                                                // Delete modal for each service
                                                echo "<div id='delete_service_".$row["Service_ID"]."' class='modal fade delete-modal' role='dialog'>";
                                                echo "<div class='modal-dialog modal-dialog-centered'>";
                                                echo "<div class='modal-content'>";
                                                echo "<div class='modal-body text-center'>";
                                                echo "<img src='assets/img/sent.png' alt='' width='50' height='46'>";
                                                echo "<h3>Are you sure want to delete this Service?</h3>";
                                                echo "<div class='m-t-20'>";
                                                echo "<a href='#' class='btn btn-white' data-dismiss='modal'>Close</a>";
                                                echo "<a href='delete-service.php?id=".$row["Service_ID"]."' class='btn btn-danger'>Delete</a>";
                                                echo "</div>";
                                                echo "</div>";
                                                echo "</div>";
                                                echo "</div>";
                                                echo "</div>";
                                            }
                                        } else {
                                            echo "<tr><td colspan='6'>No services found</td></tr>";
                                        }
                                        $conn->close();
                                    ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
		<div id="delete_department" class="modal fade delete-modal" role="dialog">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-body text-center">
						<img src="assets/img/sent.png" alt="" width="50" height="46">
						<h3>Are you sure want to delete this service?</h3>
						<div class="m-t-20"> <a href="#" class="btn btn-white" data-dismiss="modal">Close</a>
							<button type="submit" class="btn btn-danger">Delete</button>
						</div>
					</div>
				</div>
			</div>
		</div>
    </div>
    <div class="sidebar-overlay" data-reff=""></div>
    <script src="assets/js/jquery-3.2.1.min.js"></script>
	<script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.dataTables.min.js"></script>
    <script src="assets/js/dataTables.bootstrap4.min.js"></script>
    <script src="assets/js/jquery.slimscroll.js"></script>
    <script src="assets/js/app.js"></script>
</body>


<!-- departments23:21-->
</html>