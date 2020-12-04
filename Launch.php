<?php
include "db-connect.php";
session_start();

    $query = "SELECT * FROM launch";
    $prep = $db->prepare($query);
    $prep->execute();
    $result = $prep->fetchAll();
    $error = "";


 $queryOne = "SELECT * FROM comments Where Post_ID = :id ORDER BY currdate DESC";
  $statement = $db->prepare($queryOne);
  $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
  $statement->execute(); 
  $statement->fetchAll();
  $blogs= $statement->fetchAll();
  $rows = $statement->rowCount();
	 
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search</title>
    <link rel="stylesheet" type="text/css" href="Project.css?4">
    <link href="https://fonts.googleapis.com/css?family=Spartan&display=swap" rel="stylesheet">
</head>
<body>
    <form action = "search.php"  method = "POST" >
    <input type="text" name ="name">
    <input type="submit" name="command" value ="Search by Name">
    <input type="submit" name="command2" value="Search by Rating">
    <input type="submit" name="command3" value="Sort By">
    </form>
        
    <?php foreach ($result as $results): ?>
    <div>
     <div class="outer-launch">
            <h3><?= $results['Name'];?></h3>
            <div class="inner-launch">
                <p> <img src="images/<?= $results['Image'];?>" alt="logo" class="service-img">Launch Date: <?= $results['LaunchDate'];?></p>
                <p>Launch Price: $ <?= $results['Price'];?> million USD</p>
                <p>Rating: <?= $results['Rating'];?></p>
                <?php if($_SESSION['user'] == 'admin') {?>
               <p><a href="PostEdit.php?id=<?=$results['LaunchID']?>">Edit</a></p>
               <?php }?>
                <p><a href="Comment.php?id=<?=$results['LaunchID']?>">Add a comment.</a></p>
                
                <div id="all_blogs">
        <?php if($blogs!= null): ?>
        <?php for($i = 0; $i < 7 && $i < $rows; $i++): ?>
        <div class="blog_post">

            <h2><a href="show.php?id=<?=$blogs[$i]['id']?>"><?=$blogs[$i]['username']?></a> says</h2>

            <div class='blog_content'>
                <?php if(strlen($blogs[$i]['content']) > 200): ?>
                <p>
                    <?=$blogs[$i]['content']?>
                    <!-- <a href="show.php?id=<?=$result[$i]['id']?>">Read Full Post...</a> -->
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
               
            </div>
        </div>
        </div>
<?php endforeach; ?>
<?php if($_SESSION['user'] == 'admin') {?>
               <p><a href="AddNew.php">Add New</a></p>
               <?php }?>

</body>
</html>