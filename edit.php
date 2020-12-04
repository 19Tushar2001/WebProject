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
    $query = "SELECT * FROM comments WHERE id = :id";
    //the PDO::prepare function returns a PDOStatement object
    $statement = $db->prepare($query);
    
    // Bind the :id parameter in the query to the previously
    // sanitized $id specifying a type of INT.
    $statement->bindValue(':id', $id, PDO::PARAM_INT);
    // Then execute the prepared statement.
    $statement->execute(); 

    $blogs= $statement->fetch();

      $title = $blogs['username'];
      $idValue = $blogs['id'];
      $content = $blogs['content'];
      $date = $blogs['currdate'];

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
            <h1><a href="index.php">Comment Editor</a></h1>
        </div> 
<ul id="menu">
    <li><a href="MarsRover.php" >Go Back.</a></li>
    
</ul> 
<div id="all_blogs">
  <form action="process_post.php" method="post">
    <fieldset>
      <legend>Edit Comments.</legend>
      <p>
        <label for="title">Posted by:</label>
<!--        <input name="title" id="title" value="<?=$title?>" />-->
        <p><?=$title?></p>
      
      <p>
        <label for="content">Comment</label>
        <textarea name="content" id="content"><?=$content?> </textarea>
      </p>
      <p>
        <input type="hidden" name="id" value="<?=$idValue?>" />
        <input type="submit" name="command" value="Update" />
        <input type="submit" name="command" value="Delete" onclick="return confirm('Are you sure you wish to delete this post?')" />
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
