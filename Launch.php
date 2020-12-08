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
                <p><a href="PageView.php?id=<?=$results['LaunchID']?>">VISIT PAGE</a></p>
                
                
               
            </div>
        </div>
        </div>
<?php endforeach; ?>
<?php if($_SESSION['user'] == 'admin') {?>
               <p><a href="AddNew.php">Add New</a></p>
               <?php }?>

</body>
</html>