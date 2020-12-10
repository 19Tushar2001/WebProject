<!-------w--------

    THE FINAL PROJECT.
    Name: Tushar Sharma
    Date: NOV-2-2020
    Main Index file for the project.

----------------->

<?php



session_start();
require "db-connect.php";
error_reporting (E_ALL ^ E_NOTICE); 
    $username = "";
    $password = "";
    $value_username = "";
    $errorList = [];
    
        $usernameError = "Your Username";
        $emailError = "Your Email";
        $passwordError = "Your Password" ;
        $c_passwordError = "Confirm Password";
    $error1 = "Sign Up";
    $error2 = "To Begin";
//VALIDATING IF THE USENAME IS CORRECT OR ANY DUPLICATE VALUE EXISTS.

if($_SERVER["REQUEST_METHOD"] == "POST")
{
    if(empty(trim($_POST["username"])))
    {
        $errorList[] = "Please enter a valid Username";
        $usernameError = "Invalid Username.";
        $error1 = "Empty";
        $error2 = "Data Fields";
    }
    
    else
    {
        $query = "SELECT UserID FROM users WHERE username = :username ";
        
        if($statement = $db->prepare($query))
        {
            $statement->bindValue(':username', $value_username,PDO::PARAM_STR);
        }
        
        
        
        $value_username = trim($_POST["username"]);
        
      
        if($statement->execute())
        {
            if($statement->rowCount()==1)
            {
                $usernameError = "This Username is already taken.";
                $error1 = "Let's Try";
                $error2 = "Again";
               
            }
            
            else
            {
                $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
            }
            
        }
        else
            {
                echo  "<h4>Something went wrong, please try again after sometime.</h4>";
            }
        unset($statement);
    }
    
    //VALIDATING THE PASSWORD

    if(empty($_POST["password"])){
        $errorList[] = "Please enter a password.";
        $passwordError = "Invalid Password.";
        $c_passwordError = "N/A";
        $error1 = "Empty";
        $error2 = "Data Fields";
    } elseif(strlen(trim($_POST["password"])) < 6){
        $errorList[] = "Password must have atleast 6 characters.";
        $passwordError = "Atleast 6 characters requried.";
    } else{
        $password = filter_input(INPUT_POST,'password',FILTER_SANITIZE_STRING);
    }
    
    
    
    //VALIDATING THE EMAIL.
    $email = $_POST["email"];
    if(empty($_POST["email"]))
    {
        $errorList[]="Please enter a valid email.";  
        $emailError = "Invalid Email.";
        $error1 = "Empty";
        $error2 = "Data Fields";
    }
    else
    {
        $email = filter_input(INPUT_POST,'email',FILTER_SANITIZE_STRING);
    }
    
    //VALIDATING THE CONFIRM PASSWORD.
    $c_password = filter_input(INPUT_POST,'c_password',FILTER_SANITIZE_STRING);
    if(!($c_password == $_POST["password"]))
    {
        $errorList[]="Passwords Don't Match";
        $passwordError = "Passwords Don't Match";
        $c_passwordError = "Passwords Don't Match";
    }
    

//CHECKING FOR THE ERRORS BEFORE INSERTING INTO THE DATABASE.
    if(empty($errorList))
    {
        
        $query2 = "INSERT INTO users (username, password,email) VALUES (:username, :password,:email)";
         
        if($statement = $db->prepare($query2)){
            
            $statement->bindParam(":username", $value_username, PDO::PARAM_STR);
            $statement->bindParam(":password", $value_password, PDO::PARAM_STR);
            $statement->bindParam(":email", $value_email, PDO::PARAM_STR);
            
           
            $value_username = $username;
            $value_password = password_hash($password, PASSWORD_DEFAULT);
            $value_email = $email;
            
            
            if($statement->execute()){
               
                header("location: login.php");
            } 
            else
            {
                $usernameError = "Username Unavailable.";
                $error1 = "Let's";
                $error2 = "Try Again";
            }
        

            
            unset($statement);
            unset($db);
    
    }else
        {
            $errorList[] = "Their is some error.";
            $error1 = "Please Try";
            $error2 = "Again";
        }
        
    }

}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Homepage - Log In, Sign Up</title>
    <link rel="stylesheet" type="text/css" href="project.css?5">
    <link href="https://fonts.googleapis.com/css?family=Spartan&display=swap" rel="stylesheet">
        
</head>

<body>

    <!--
    <video autoplay muted loop id="video">
        <source src="videos/video1.mp4" type="video/mp4">
    </video>
-->

    <div id="login-index">
        <!--        <img src="images/login.jpg" alt="login.jpg" id="body-image1">-->

        <h1><?php echo $error1 ?></h1>
        <h1><?php echo $error2 ?></h1>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" autocomplete="off">
            <label>Username</label>
            <input type="text" name="username" placeholder="<?php echo $usernameError; ?>" value="<?php echo $username ?>">
            <label>Email</label>
            <input type="email" name="email" placeholder="<?php echo $emailError; ?>" value="<?php echo $email; ?>">

            <label>Password</label>
            <input type="password" name="password" placeholder="<?php echo $passwordError; ?>" value="<?php echo $password; ?>">

            <label>Confirm Password</label>
            <input type="password" name="c_password" placeholder="<?php echo $c_passwordError; ?>" value="<?php echo $c_password; ?>">

                        
            <input type="submit" id="button-index" value="Submit">

            <div id="l-element">
                <a href="login.php">Already have a account</a>
                <br><a href="Admin.php">Admin Login.</a>
            </div>
        </form>

        <!--
        <?php if(!empty($errorList)):?>
        <h3>Please fill the required information.</h3>
        <ul>
            <?php foreach ($errorList as $errorMsg): ?>
            <li><?= $errorMsg ?></li>
            <?php endforeach ?>
        </ul>
        <?php endif ?>
-->
    </div>
</body>

</html>