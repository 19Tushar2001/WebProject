<!-------f--------

    Name: Tushar Sharma
    Description: used to edit update or delete specific blog

----------------->
<?php

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
    $query = "SELECT * FROM launch WHERE LaunchID = :id";
    //the PDO::prepare function returns a PDOStatement object
    $statement = $db->prepare($query);
    
    // Bind the :id parameter in the query to the previously
    // sanitized $id specifying a type of INT.
    $statement->bindValue(':id', $id, PDO::PARAM_INT);
    // Then execute the prepared statement.
    $statement->execute(); 

    $blogs= $statement->fetch();

      $title = $blogs['Name'];
      $idValue = $blogs['LaunchID'];
      $content = $blogs['Price'];
      $date = $blogs['LaunchDate'];
if (isset($_POST['Delete']))
    {

        $query = "DELETE FROM launch WHERE LaunchID = :id";
        $newStatement = $db->prepare($query);
        $newStatement->bindValue(':id', $id, PDO::PARAM_INT);
        $newStatement->execute();
        header('location:Launch.php');
    }

    elseif (isset($_POST['update'])) 
    {

        if( $_POST['title'] !=="" && $_POST['content'] !== "" && $_POST['launchDate'] !=="" )
        {
            
            $content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $query     = "UPDATE Launch SET Price = :content,Name = :title WHERE LaunchID = :id";
            
            $newStatement = $db->prepare($query);
            
            $newStatement->bindValue(':content', $content);
            $newStatement->bindValue(':id', $id, PDO::PARAM_INT);
            $newStatement->bindValue(':username', $username);
            
            if($newStatement->execute())
            {
                header('location:Launch.php');
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
    <title>Serviceable Rockets Editor</title>
    <link rel="stylesheet" href="style.css" type="text/css">
</head>
<body>
    <div id="wrapper">
        <div id="header">
            <h1><a href="index.php">Serviceable Rocket Editor</a></h1>
        </div> 
<ul id="menu">
    <li><a href="Launch.php" >Go Back.</a></li>
    
</ul> 
<div id="all_blogs">
  <form  method="post">
    <fieldset>
      <legend>Edit Post.</legend>
      <p>
        <label for="title">Rocket:</label>
<textarea name="title" id="title"><?=$title?> </textarea>
           
      <p>
        <label for="content">Price</label>
        <textarea name="content" id="content"><?=$content?> </textarea>
      </p>
      <p>
        <label for="launchDate">Launch Date</label>
        <textarea name="launchDate" id="launchDate"><?=$date?> </textarea>
      </p>
      <p>
        <input type="hidden" name="id" value="<?=$idValue?>" />
        <input type="submit" name="Update" value="Update" />
        <input type="submit" name="Add" value="AddNew" />
        <input type="submit" name="Delete" value="Delete" onclick="return confirm('Are you sure you wish to delete this post?')" />
        
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
