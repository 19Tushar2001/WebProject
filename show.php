<!-------f--------

    Name: Tushar Sharma
    Description: used to show details of specific blog

----------------->
<?php

  require 'db-connect.php';

    if(!filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT))
    {
      header("Location: index.php");
      exit;
    }

    // Sanitize $_GET['id'] to ensure it's a number.
    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
    
    // Build a query using ":id" as a placeholder parameter.
    $query = "SELECT * FROM blog WHERE id = :id";
    //the PDO::prepare function returns a PDOStatement object
    $statement = $db->prepare($query);
    
    // Bind the :id parameter in the query to the previously
    // sanitized $id specifying a type of INT.
    $statement->bindValue(':id', $id, PDO::PARAM_INT);
    // Then execute the prepared statement.
    $statement->execute(); 

    $blogs= $statement->fetch();

      $content = $blogs['content'];
      $date = date_format(date_create($blogs['currdate']),'F d, Y, h:i a');


?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>My Blog - <?=$title?></title>
    <link rel="stylesheet" href="style.css" type="text/css">
</head>
<body>
    <div id="wrapper">

        <div id="header">
            <h1><a href="index.php">My Blog - <?=$title?></a></h1>
        </div> 

        <ul id="menu">
            <li><a href="index.php" >Home</a></li>
            <li><a href="create.php" >New Post</a></li>
        </ul> 

       <div id="all_blogs">
         
         <div class="blog_post">
            <h2><a><?=$title?></a></h2>
            <p>
            <small>
              <?=$date?> -
            <a href="edit.php?id=<?=$_GET?>">edit</a>
              </small>
          </p>

          <div class='blog_content'>
            <?=$content?>      
          </div>

        </div>
        
       </div>
      <div id="footer">
          Copywrong 2020 - No Rights Reserved
      </div> 
    </div> 
</body>
</html>
