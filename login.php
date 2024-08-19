<?php
session_start();

include "connection.php";
include "config.php";

 if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $inputEmail = $_POST['Email'];
    $inputPassword = $_POST['Password'];
    $sql = "SELECT * FROM user_table WHERE Email='$inputEmail' AND Password='$inputPassword'";
    $result = $conn->query($sql);


    if ($result->num_rows == true) {
        $row = $result->fetch_assoc();
        $_SESSION['User_ID'] = $row['User_ID']; // Store User_ID in the session
        $_SESSION['Email']=$row['Email'];
        $firstName = $row['Fname'];
        if($row['Is_Admin']){
         header("refresh:2;url=Admin_Panel/index.php");
        echo "<p class='message'>Welcome, $firstName!</p>";
        // exit;
        }
        elseif($row['Is_Doctor']){
        echo "<p class='message'>Welcome, $firstName!</p>";
            header("refresh:2;url=Doctor_Panel/index.php");
            // exit;
        }
        elseif($row['Is_Patient']){
        echo "<p class='message'>Welcome, $firstName!</p>";
            header("refresh:2;url=uhome.php");
            // exit;
        }

    } 
    else{
        echo '<p class="error-message">Error: Invalid username or password.Please try again.</p>';
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="assets/css/login.css?v=<?=$version?>">
    <title>Root Care</title>
</head>

<body>


        <div class="wrapper">
            <form action="login.php" method="post">
                <h1>Login</h1>
                <div class="input-box">
                    <!-- <label for="Email"></label> -->
                    <input type="email" id="Email" name="Email" placeholder="Enter Email" required>
                    <i class='bx bxs-user'></i>
                </div>

                <div class="input-box">
                    <!-- <label for="password"></label> -->
                    <input type="password" id="Password" name="Password" placeholder="Enter Password" required>
                    <i class='bx bxs-lock-alt'></i>
                </div>
                
                <div class="forgot">
                    <label></label>
                    <a href="./fgpass/fgpass.php">Forgot Password ?</a>
                </div>

                <button type="submit" class="btn">Login</button>

                <div class="register-link">
                    <p>Don't have an account ? <a href="register.php">Register</a></p>
                </div>

            </form>
        </div>

</body>

</html>