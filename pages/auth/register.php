<?php 
Session_start();

require '../../config/db_connection.php'; // Ensure the connection file is properly required

// Declaring variables to prevent errors
$full_name = "";     // User full name
$email = "";         // User email
$password = "";
$Con_password = "";
$date = "";          // Sign up date
$error_array = array();  // Holds error messages as an array

if(isset($_POST['register-button'])){

    // Registration form values

    // Full name
    $full_name = strip_tags($_POST['reg_name']); // Remove HTML tags
    $full_name = str_replace(' ', '', $full_name); // Remove spaces
    $full_name = ucfirst(strtolower($full_name)); // Uppercase first letter
    $_SESSION['reg_name'] = $full_name; // Stores full name into session variable

    // Email
    $email = strip_tags($_POST['reg_email']); // Remove HTML tags
    $email = str_replace(' ', '', $email); // Remove spaces
    $email = strtolower($email); // Convert to lowercase
    $_SESSION['reg_email'] = $email; // Stores email into session variable

    // Passwords
    $password = strip_tags($_POST['reg_password']); // Remove HTML tags
    $Con_password = strip_tags($_POST['reg_confirm-password']); // Remove HTML tags

    $date = date("Y-m-d"); // Current date

    // Check if email is in valid format
    if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
        
        $email = filter_var($email, FILTER_VALIDATE_EMAIL);
        
        // Check if email already exists
        $e_check = mysqli_query($con, "SELECT email FROM users WHERE email='$email'");

        // Count the number of rows returned
        $num_rows = mysqli_num_rows($e_check);
        if($num_rows > 0) {
            array_push($error_array, "Email already in Use<br>");
        }
        
    } else {
        array_push($error_array, "Invalid Formet");
    }
    // Check length of Full name 
    if(strlen($full_name) > 25 || strlen($full_name) <= 2) {
        array_push($error_array, "Your Name must be Between 2 and 25 characters");
    }
    // Check password match or not with confirm password
    if($password != $Con_password) {
        array_push($error_array, "your passwords do not match");
    }
    else {
        // Password should be char and number - logic applied
        if(preg_match('/[^A-Za-z0-9]/', $password)) {
            array_push($error_array, "Password can only english characters or numbers");
        }
    }
    // Password length fix b/w 5 to 30
    if(strlen($password) > 30 || strlen($password) < 5 ) {
        array_push($error_array, "Password must be between 5 and 30 characters");
    }

    if(empty($error_array)) {
        $password = md5($password); //Encrypt password before sending to database

        //Generate Username by concatenating Fullname
        $username = strtolower($full_name . "_");
        $check_username_query = mysqli_query($con, "SELECT username FROM users where username='$username'");

        $i = 0;
        //if username exists add number to username
        while(mysqli_num_rows($check_username_query) != 0) {
            $i++; //Add 1 to i
            $username = $username . "_" . $i;
            $check_username_query = mysqli_query($con, "SELECT username FROM users WHERE username='$username'");
        }

        //Profile picture assignment
        $profile_pic = "../../assets/images/Defalut/profile.png";   

        //Insert the Data in DB in USERS table
        $query = mysqli_query($con, "INSERT INTO users VALUES ('', '$full_name', '$username', '$email', '$password', '$date', '$profile_pic', '0', '0', 'no', ',')");
        
        //Success message print after the successfully submit the data
        array_push($error_array, "<span style='color: #14c800;'>You're all set! Goahead and login!</span><br>");

        //Clear session variables
        $_SESSION['reg_name'] = "";
        $_SESSION['reg_email'] = "";
    }
    
}
?>



<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Signup Page</title>
    <link rel="stylesheet" href="../../assets/register.css">
</head>
<body>
    <div class="container">
        <div class="left">
            <img src="../../assets/images/reg-side-image.jpg" alt="reg-side-image">
        </div>
        <div class="right">
            <div class="form-container">
                <h2>Create your account</h2> 
                <form action="register.php" method="POST">
                    <div class="input-group">
                        <label for="name">Your Name</label>
                        <input type="text" id="name" name="reg_name" value="<?php
                        if(isset($_SESSION['reg_name'])) {
                            echo $_SESSION['reg_name'];
                        }
                        ?>" required>
                        <br>
                    <!--Print Error message  -->
                        <?php if(in_array("Your Name must be Between 2 and 25 characters", $error_array)) echo "Your Name must be Between 2 and 25 characters"; ?>
                    <!--  -->
                    </div>
                    <div class="input-group">
                        <label for="email">Your Email Address</label>
                        <input type="email" id="email" name="reg_email" value="<?php
                        if(isset($_SESSION['reg_email'])) {
                            echo $_SESSION['reg_email'];
                        }
                        ?>" required>
                        <br>
                    <!--Print Error message  -->
                        <?php if(in_array("Email already in Use<br>", $error_array)) echo "Email already in Use<br>"; 
                        else if(in_array("Invalid Formet", $error_array)) echo "Invalid Formet"; ?>
                    <!--  -->
                    </div>
                    <div class="input-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="reg_password" required>
                    </div>
                    <div class="input-group">
                        <label for="confirm-password">Confirm Password</label>
                        <input type="password" id="confirm-password" name="reg_confirm-password" required>
                        <br>
                    <!--Print Error message  -->
                        <?php if(in_array("your passwords do not match", $error_array)) echo "your passwords do not match<br>"; 
                        else if(in_array("Password can only english characters or numbers", $error_array)) echo "Password can only english characters or numbers<br>"; 
                        else if(in_array("Password must be between 5 and 30 characters", $error_array)) echo "Password must be between 5 and 30 characters<br>";?>
                    <!--  -->
                    </div>
                    <input type="submit" class="register-button" name="register-button" value="Register">
                    <!--Print Error message  -->
                    <?php if(in_array("<span style='color: #14c800;'>You're all set! Goahead and login!</span><br>", $error_array)) echo "<span style='color: #14c800;'>You're all set! Goahead and login!</span><br>";?>
                    <!--  -->
                </form>
                <p class="login-text">Already have an account? <a href="#">Login</a></p>
            </div>
        </div>
    </div>
</body>
</html>
