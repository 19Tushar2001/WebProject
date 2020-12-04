<?php
	
	require 'db-connect.php';

	$search = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
	

	if(isset($_POST["command"]))
{
  $queryOne = "SELECT * FROM launch WHERE Name LIKE '%$search%'";
  $statement = $db->prepare($queryOne);
  $statement->execute(); 

  $launch= $statement->fetchAll();
  $rows = $statement->rowCount();
}
else if(isset($_POST["command2"]))
{
	$queryOne = "SELECT * FROM launch WHERE Rating LIKE '%$search%'";
  $statement = $db->prepare($queryOne);
  $statement->execute(); 

  $launch= $statement->fetchAll();
  $rows = $statement->rowCount();
}

else if(isset($_POST["command3"]))
{
    	$queryOne = "SELECT * FROM launch ORDER BY $search";
          $statement = $db->prepare($queryOne);
          $statement->execute(); 

          $launch= $statement->fetchAll();
          $rows = $statement->rowCount();
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Seach for Rocket <?= $search ?></title>
	<link rel="stylesheet" type="text/css" href="Project.css?3">
    <link href="https://fonts.googleapis.com/css?family=Spartan&display=swap" rel="stylesheet">
</head>
<body>
	<p id= "introHeading"> This is the list of Rockets which include <?= $search ?>. </p>

	<?php if($launch != null): ?>
        <?php for($i = 0;$i < $rows; $i++): ?>
            <div>

              <h2><a href="showRocket.php?id=<?=$launch[$i]['LaunchID']?>"> <?=$launch[$i]['Name']?></a></h2>
              <div id = "movieData">
              	<div>
	               <img src="images/<?= $launch[$i]['Image'];?>" alt = "no image found">
	            </div>
	            <div id = "dataBlock">
<!--
	              <p id = "description">About the Rocket:   
	              	<?=$launch[$i]['Description']?>
	              </p>
-->
	              <p id = "price">Price: $
	              	<?=$launch[$i]['Price']?>
	              </p>
	              <p>First Launch Date: 
	                <small>
	                  <?=date_format(date_create($launch[$i]['LaunchDate']),'F d, Y')?> 
<!--	                  <a href="editMovie.php?id=<?=$launch[$i]['MovieID']?>">EDIT Movie or Delete</a>-->
	                </small>
	              </p>
	            </div>
	          </div>

            </div>
         <?php endfor ?>
           
    <?php else: ?>
        <p>We will consider naming our next rocket <?= $search ?>,but we don't have any at preset.</p>
    <?php endif ?>

</body>
</html>