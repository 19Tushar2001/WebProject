<!-------f--------

    Name: Tushar Sharma
    Description: used to edit update or delete specific blog

----------------->
<?php
error_reporting (E_ALL ^ E_NOTICE);
  require 'db-connect.php';
//  require 'authanticate.php';

    if(!filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT))
    {
      header("Location: index.php");
      exit;
    }

    // Sanitize $_GET['id'] to ensure it's a number.
    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
   
    // Build a query using ":id" as a placeholder parameter.
    $query = "SELECT * FROM users WHERE UserID = :id";

    //the PDO::prepare function returns a PDOStatement object
    $statement = $db->prepare($query);
    
    // Bind the :id parameter in the query to the previously
    // sanitized $id specifying a type of INT.
    $statement->bindValue(':id', $id, PDO::PARAM_INT);
    // Then execute the prepared statement.
    $statement->execute(); 

    $value= $statement->fetch();


      $title = $value['UserID'];
      $idValue = $value['UserName'];
      $content = $value['email'];

       if (isset($_POST['DeleteUser']))
    {

        $query = "DELETE FROM users WHERE UserID = :id";
        $newStatement = $db->prepare($query);
        $newStatement->bindValue(':id', $id, PDO::PARAM_INT);
        $newStatement->execute();
        header('location:AdminData.php');
    }

    elseif ($_POST['command'] === "UpdateUser") 
    {

        if( $_POST['content'] !== "" )
        {
            
            $content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $query     = "UPDATE users SET email = :content, UserName = :username WHERE UserID = :id";
            
            $newStatement = $db->prepare($query);
            
            $newStatement->bindValue(':content', $content);
            $newStatement->bindValue(':id', $id, PDO::PARAM_INT);
            $newStatement->bindValue(':username', $username);
            
            if($newStatement->execute())
            {
                header('location:AdminData.php');
            }
        }
        else
        {
            echo "input valid data";
        }
    }

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Comment Editor</title>
    <link rel="stylesheet" href="style.css" type="text/css">
</head>
<body>
    <div id="wrapper">
        <div id="header">
            <h1><a href="index.php">User Editor</a></h1>
        </div> 
<ul id="menu">
    <li><a href="AdminData.php" >Go Back.</a></li>
    
</ul> 
<div id="all_blogs">
  <form  method="post">
<!--   action="process_post.php?id=<?=$value['UserID']?>"-->
    <fieldset>
      <legend>Edit Users.</legend>
      <p>
        <label for="title">UserID:</label>
<!--        <input name="title" id="title" value="<?=$title?>" />-->
        <p><?=$title?></p>
      
            <p>
        <label for="username">UserName</label>
<!--        <input name="title" id="title" value="<?=idValue?>" />-->
        <textarea name="username" id="username"><?=$idValue?> </textarea>
      
      
      <p>
        <label for="content">Emial</label>
        <textarea name="content" id="content"><?=$content?> </textarea>
      </p>
      <p>
        <input type="hidden" name="id" value="<?=$idValue?>" />
        <input type="submit" name="command" value="UpdateUser" />
        <input type="submit" name="DeleteUser" value="DeleteUser" onclick="return confirm('Are you sure you wish to delete this post?')" />
        <button type="submit" name="sendMailBtn" >Send Email</button>
      </p>
    </fieldset>
  </form>
</div>
        <div id="footer">
            Copywrong 2020 - No Rights Reserved
        </div> 
    </div> 
</body>
</html>
