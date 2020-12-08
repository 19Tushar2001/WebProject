
<?php


require('db-connect.php');
session_start();

error_reporting (E_ALL ^ E_NOTICE);
$username = "";
$password = "";
$userError = "Your Username.";
$passError = "Your Password.";
$error1 = "Administrator";
$error2 = "Login.";
if(isset($_POST['username']) AND isset($_POST['password'])){

	$admin = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
	$password = filter_input(INPUT_POST,'password',FILTER_SANITIZE_STRING);
	$query = "SELECT Password FROM admin WHERE Username = '$admin'";
	$prepare = $db->prepare($query);
    $prepare->execute();
    $pass = $prepare->fetch();
    
    
    if(empty($admin))
    {
        $userError = "USERNAME REQUIRED.";
       
    }
    
    if(empty($password))
    {
        $passError = "PASSWORD REQUIRED.";
        
    }
    
    if($pass[0] == $password)
    {
        session_start();
        $_SESSION['user']=admin;
        header('location: MarsRover.php');
        

        }
        else
        {
            $error1 = "Not";
            $error2 = "Authorized";
            session_abort();
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