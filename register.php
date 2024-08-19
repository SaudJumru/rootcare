<?php
include "connection.php";

if($_SERVER['REQUEST_METHOD']=='POST')
{
    $inputFname=$_POST['Fname'];
    $inputLname=$_POST['Lname'];
    $inputEmail=$_POST['Email'];
    $inputPassword=$_POST['Password'];
    // $hashpass=password_hash($inputPassword, PASSWORD_DEFAULT);
    // password_verify($inputPassword,$hashpass);
    $inputDOB=$_POST['DOB'];
    $inputMno=$_POST['Mobile_No'];
    $inputAddress=$_POST['Address'];
    $gender=$_POST['gender'];
    // $Security_Que=$_POST['question'];
    // $Security_Ans=$_POST['answer'];
  
    
    $sql="INSERT INTO user_table (Fname, Lname, Email, Password, DOB, Mobile_No, Address, Gender) VALUES('$inputFname', '$inputLname', '$inputEmail', '$inputPassword', '$inputDOB', '$inputMno', '$inputAddress', '$gender')";
    $result=$conn->query($sql);
    // if(isset($_POST['question'])){
    //     $Security_Que=$_POST['question'];
    //     $s="INSERT INTO user_table(Security_Que) VALUES('$Security_Que')";
    //     $r=$conn->query($s);
    // }
    if($result)
    {
        echo "<p style='color: white; font-size: 30px; text-align: center; position: absolute; top: 3%; left: 50%; transform: translate(-50%, -50%);'>Registration Successful</p>";
        header("refresh:2;url=login.php");
    }
    else
    {
        echo "Error: Unable to add the data.";
    }

    $select1="SELECT User_ID, Email FROM user_table WHERE Email= '$inputEmail' AND Password= '$inputPassword'";
    $r1=$conn->query($select1);

    if($r1->num_rows>0)
    {
        $row = $r1->fetch_assoc();
        $userId = $row["User_ID"];

        $updateSql = "UPDATE user_table SET Is_Patient = 1 WHERE User_ID = $userId";
        $conn->query($updateSql);
        //echo "Registration Successfull";
    }

}

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <title>Registration</title>
    <link rel="stylesheet" href="assets/css/register.css"></link>

</head>
<body>
    <div class="container">
        <div class="title">Registration Form</div>
        <form name="regForm" action="register.php" method="POST" onsubmit="return validation()">
            <div class="user-details">
                <div class="input-box">
                    <span class="details">Fname</span>
                    <input type="text" id="Fname" name="Fname" placeholder="Enter your firstname" required>
                    <span id="fnm"></span>
                </div>

                <div class="input-box">
                    <span class="details">Lname</span>
                    <input type="text" id="Lname" name="Lname" placeholder="Enter your lastname" required>
                    <span id="lnm"></span>
                </div>

                <div class="input-box">
                    <span class="details">Email</span>
                    <input type="text" id="email" name="Email" placeholder="Enter your email" required>
                    <span id="mail"></span><br><br>
                </div>

                <div class="input-box">
                    <span class="details">Password</span>
                    <input  type="password" id="password" name="Password" placeholder="Enter your password" required>
                    <span id="pass"></span><br>
                </div>

                <!-- <div class="input-box">

                    <select name="question" class="col-10">
                            <option selected>Select security question</option>
                            <option value="What is the name of your best friend">What is the name of your best friend?</option>
                            <option value="What is your pet's name">What is the name of your pet?</option>
                            <option value="In which school did you studied?">In which school did you studied?</option>
                            <option value="3">Dental Check-up</option>
                            <option value="4">Tooth Removal</option>
                            <option value="5">Root Canal Treatment</option>
                            <option value="6">Dental Implant</option>
                        </select>

                        <span class="details">Enter Answer</span>
                    <input name="answer" type="text" placeholder="Enter your Security Answer" required>
                </div> -->


                <div class="input-box">
                    <span class="details" >Mobile Number</span>
                    <input type="tel" id="Mobile_No" name="Mobile_No" placeholder="Enter your phone number" required>
                    <span id="message"></span><br><br>

                    <!-- <label for="Mobile_No">Mobile No </label>
                    <input type="tel" id="Mobile_No" name="Mobile_No" placeholder="Enter Your Phone Number" required>
                    <span id="message"></span><br><br> -->
                </div>

                <div class="input-box">
                    <span class="details">Date of birth</span>
                    <input type="date" name="DOB" placeholder="Enter your DOB" required>
                </div>

                <div class="input-box">
                    <span class="details">Address</span>
                    <!-- <input type="text" placeholder="Enter your address" required> -->
                    <textarea name="Address" placeholder=" Enter your address" cols="35" rows="3"></textarea>
                </div>

                <div class="gender-details">
                <input type="radio" name="gender" id="dot-1" value="Male">
                <input type="radio" name="gender" id="dot-2" value="Female">
                <input type="radio" name="gender" id="dot-3" value="Other">
                <span class="gender-title">Gender</span>
                <div class="category">
                    <label for="dot-1">
                        <span class="dot one"></span>
                        <span class="gender">Male</span>
                    </label>

                    <label for="dot-2">
                        <span class="dot two"></span>
                        <span class="gender">Female</span>
                    </label>

                    <label for="dot-3">
                        <span class="dot three"></span>
                        <span class="gender">Other</span>
                    </label>
                </div>
            </div>


            </div>
            <!-- <div class="gender-details">
                <input type="radio" name="gender" id="dot-1" value="1">
                <input type="radio" name="gender" id="dot-2" value="2">
                <input type="radio" name="gender" id="dot-3" value="3">
                <span class="gender-title">Gender</span>
                <div class="category">
                    <label for="dot-1">
                        <span class="dot one"></span>
                        <span class="gender">Male</span>
                    </label>

                    <label for="dot-2">
                        <span class="dot two"></span>
                        <span class="gender">Female</span>
                    </label>

                    <label for="dot-3">
                        <span class="dot three"></span>
                        <span class="gender">Other</span>
                    </label>
                </div>
            </div> -->
            <div class="button">
                <input type="submit" value="Register">
                <div class="login">
                <font>Already have an account ? <a href="login.php">Login</a></font>
            </div>
            </div>

        </form>
    </div>
<script>
        function validation() {
            let n = document.getElementById("Mobile_No").value;
            let e = document.getElementById("email").value;
            let eexp= /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            let fn = document.getElementById("Fname").value;
            let ln = document.getElementById("Lname").value;
            let exp=/^[A-Za-z]+$/;
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
            if((n.charAt(0) != 9) && (n.charAt(0) != 8) && (n.charAt(0) != 7) && (n.charAt(0) != 6)) {
                document.getElementById("message").innerHTML = "<font color='red'>Mobile Number Must Start With 9, 8, 7, or 6</font>";
                return false;
            }

            if ((e.charAt(0) == '@')) {
                document.getElementById("mail").innerHTML = "<font color='red'>Email Must Not Start With '@'</font>";
                return false;
            }

            if(!exp.test(fn)){
                document.getElementById("fnm").innerHTML = "<font color='red'>Fname must not contain any numeric value</font>";
                return false;
            }

            // if(!eexp.test(e)){
            //     document.getElementById("mail").innerHTML = "Email must not start with '@'";
            //     return false;
            // }

            if(!eexp.test(e)){
                document.getElementById("mail").innerHTML = "<font color='red'>Email must end in proper way (Eg: @gmai.com, @yahoo.com, etc)</font>";
                return false;
            }

            if(!exp.test(ln)){
                document.getElementById("lnm").innerHTML = "<font color='red'>Lname must not contain any numeric value</font>";
                return false;
            }


            if(p.length < 8){
                document.getElementById("pass").innerHTML = "<font color='red'>Pasword must be of minimum 8 characters long</font>";
                return false;
            }
            
            if(!/[!@#$%^&*()_+{}\[\]:;<>,.?~\\/-]/.test(p)){
                document.getElementById("pass").innerHTML = "<font color='red'>Password must contain atleast 1 symbolic character</font>";
                return false;
            }
        }
</script>
</body>
</html>


