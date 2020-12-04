<?php


  require 'db-connect.php';
session_start();
$username = $_SESSION['user'];

    if(!filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT))
    {
      header("Location: Launch.php");
      exit;
    }

    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
    
    $query = "SELECT * FROM launch  WHERE LaunchID = :id";

    $statement = $db->prepare($query);
    
    
    $statement->bindValue(':id', $id, PDO::PARAM_INT);
    
    $statement->execute(); 

    $rocket= $statement->fetch();

    $queryTwo = "SELECT * FROM location  WHERE LaunchID_FK = :id";

    $statementTwo = $db->prepare($queryTwo);
    
    
    $statementTwo->bindValue(':id', $id, PDO::PARAM_INT);
    
    $statementTwo->execute(); 

    $location= $statementTwo->fetchAll();
    $rows = $statementTwo->rowCount();

    $queryThree = "SELECT * FROM rocketdescription WHERE  RocketID_FK= $id";

    $statementThree = $db->prepare($queryThree);
    $statementThree->execute();
    
    $data = $statementThree->fetch();

    $queryOne = "SELECT * FROM comments WHERE Post_ID = $id ORDER BY currdate DESC";
   $statementone = $db->prepare($queryOne);
   $statementone->execute(); 

   $blogs= $statementone->fetchAll();
   $rowsone = $statementone->rowCount();

    if(isset($_POST['Post'])) 
    {
       
        if($_POST['content'] !== "" )
        {
            
            $content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $query = "INSERT INTO comments (Post_ID,username,content) values (:id,:username, :content)";
            
            
            $newStatement = $db->prepare($query);
            $newStatement->bindValue(':id',$id);
            $newStatement->bindValue(':username', $username);
            $newStatement->bindValue(':content', $content);         
            if($newStatement->execute())
            { echo $id;
                $insert_id = $db->lastInsertId();
                header('location:PageView.php');
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
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

<link rel="stylesheet" type="text/css" href="Project.css?3">
    <link href="https://fonts.googleapis.com/css?family=Spartan&display=swap" rel="stylesheet">
 <style>
     body
     {
         background-image: url(images/<?= $rocket['Image'];?>);
             background-size: cover;
        background-position: center;
        background-attachment: fixed;
     }
    </style>
  <title><?=$rocket['Name']?> ROCKET</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
   <div>
      <h1><?=$rocket['Name']?></h1>
      <div id = "Data">
<!--
        <div>
         <img src="images/<?= $rocket['Image'];?>" alt = "no image found">
      </div>
-->
      <div id = "dataBlock">
        <p id = "description">Name of the rocket:
          <?=$rocket['Name']?>
        </p>
        <p id = "price">Price: $
          <?=$rocket['Price']?> million USD
        </p>
        <p>Release Date: 
          <small>
            <?=date_format(date_create($rocket['LaunchDate']),'F d, Y')?>
          </small>
        </p>
        <p id = "description">Description:
          <?=$data['Description']?>
        </p>
        <p id = "rating">Rating: 
          <?=$rocket['Rating']?>
        </p>
        <p id = "duration">BurstDuration: 
          <?=$data['BurstDuration']?>
        </p>
        <p id = "designer">Designed By:
          <?=$data['Designer']?>
        </p>
      </div>
    </div>

    <h2>Location</h2>
    <table id = "locationTable">
      <tr>
        <th>Location</th>
        <th>Lauch-Pad</th>
        <th></th>
      </tr>
      <?php for($i = 0;$i < $rows; $i++): ?>
        <tr>
          <td><?=$location[$i]['Location']?></td>
          <td><?=$location[$i]['LaunchPad']?></td>
          <td><a href="editLocation.php?id=<?=$location[$i]['locationID']?>">Remove or Edit Location</a></td>
        </tr>
      <?php endfor ?>
    </table>
    
<!--    -->
    <div id="all_blogs">
        <?php if($blogs != null): ?>
        <?php for($i = 0; $i < 7 && $i < $rowsone; $i++): ?>
        <div class="blog_post">

            <h2><a href="show.php?id=<?=$blogs[$i]['id']?>"><?=$blogs[$i]['username']?></a> says</h2>

            <div class='blog_content'>
                <?php if(strlen($blogs[$i]['content']) > 200): ?>
                <p>
                    <?=$blogs[$i]['content']?>
                    <!-- <a href="show.php?id=<?=$blogs[$i]['id']?>">Read Full Post...</a> -->
                </p>
                <?php else:?>
                <?=$blogs[$i]['content']?>
                <?php endif?>

            </div>
            <p>
                <small>
                    posted on <?=date_format(date_create($blogs[$i]['currdate']),'F d, Y, h:i a')?>
                    <?php if($_SESSION['user'] == 'admin') {?>
                    <br><a href="edit.php?id=<?=$blogs[$i]['id']?>">edit</a>
                    <?php }?>

                </small>
            </p>
        </div>
        <?php endfor ?>

        <?php else: ?>
        <p>No comments in table, be the first one to create.</p>
        <?php endif ?>
    </div>
<!--    -->
<!--    action="process_post.php?id=<?=$rocket['LaunchID']?>"-->
    <div id="wrapper">
        <div id="wrapper_blog">
            <form  method="post">
                <fieldset>
                    <!-- <legend>Comments.</legend> -->
                    <p>
                        <label for="content">Add a new Comment</label>
                        <textarea name="content" id="content"></textarea>
                    </p>
                    <p>
                        <input type="submit" id="button-index" name="Post" value="Post" />
                    </p>
                </fieldset>
            </form>
        </div>
    </div>

    <a href="addLocation.php?id=<?=$location[0]['movieID']?>">Add new location</a>
    </div>
</body>
</html>