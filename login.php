<?php


require('db-connect.php');
session_start();

error_reporting (E_ALL ^ E_NOTICE);
$username = "";
$password = "";
$userError = "Your Username.";
$passError = "Your Password.";
$error1 = "Login";
$error2 = "To Begin.";
if(isset($_POST['username']) AND isset($_POST['password'])){

	$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
	$password = filter_input(INPUT_POST,'password',FILTER_SANITIZE_STRING);
	$query = "SELECT * FROM users WHERE username = '$username'";
	$prepare = $db->prepare($query);
    
    
    
    if(empty($username))
    {
        $userError = "USERNAME REQUIRED.";
       
    }
    
    if(empty($password))
    {
        $passError = "PASSWORD REQUIRED.";
        
    }
    
    if($prepare->execute())
    {
        
        $row = $prepare->fetch();
        $q_password = $row["2"];
        if(password_verify($password, $q_password))
        {           
            ///////////////////////////////////////////////////////////////////
    if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response']))
  {
        $secret = '6LfeYuIZAAAAAFmufK6vla-UwIl0Q_h8ChhRI-q-';
        $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response']);
        $responseData = json_decode($verifyResponse);
        if($responseData->success)
        {
            
            header("location:Page-4AboutUs.php");
            $_SESSION['user']=$username;
        }
        else
        {
            $error1 = "reCAPTCHA";
            $error2 = "Not Entered";
        }
   }
    ////////////////////////////////////////////////////////////////

        }
        else
        {
            $error1 = "Not";
            $error2 = "Authorized";
        }
   }
    
    
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Log In</title>
    <link rel="stylesheet" type="text/css" href="project.css?9">
    <link href="https://fonts.googleapis.com/css?family=Spartan&display=swap" rel="stylesheet">
    <script src='https://www.google.com/recaptcha/api.js'></script>
</head>

<body>
<!--
    <video autoplay muted loop id="video">
        <source src="videos/video1.mp4" type="video/mp4">
    </video>
-->

    <div id="login-index">
        <img src="images/login.jpg" alt="login.jpg" id="body-image1">

        <h1><?php echo $error1 ?></h1>
        <h1><?php echo $error2 ?></h1>

        <form method="post" autocomplete="off" class="form1">
            <label>Username</label>
            <input type="text" name="username" placeholder="<?php echo $userError ?>"  >

            <label>Password</label>
            <input type="password" name="password" placeholder="<?php echo $passError ?>">
            <div class="g-recaptcha" data-sitekey="6LfeYuIZAAAAAIbCq9zKY5OAEDN15XfJif4Qfi1b"></div>
            <input type="submit" id="button-index" value="Submit">
<!--            <input type="reset" id="forgot" value="Reset">-->
            
            <div id="l-element">
            <div>
             <a href="index.php">Add a new user.</a>   
            </div>
            
            <a href="Admin.php">Admin Login.</a>
            </div>
        </form>

    </div>
</body>

</html>