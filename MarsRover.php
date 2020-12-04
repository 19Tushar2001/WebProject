<!-------w--------

    Assignment 7 Web Project
    Name: Tushar Sharma
    Date: April 27,2020
    HTML file for assignment 7 (Products & Services).

----------------->
<?php
session_start();
$json = 'https://api.nasa.gov/mars-photos/api/v1/rovers/curiosity/photos?earth_date=2020-5-2&api_key=lm7CURD6Ez2qh4r3Ae2Plz7ikCPrSBz05NAWnVxK';
$nasa_json = file_get_contents($json);

$nasa_data = json_decode($nasa_json, true);
$count = count($nasa_data);

require 'db-connect.php';

 $queryOne = "SELECT * FROM comments ORDER BY currdate DESC";
  $statement = $db->prepare($queryOne);
  $statement->execute(); 

  $blogs= $statement->fetchAll();
  $rows = $statement->rowCount();


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Products and Services</title>
    <link rel="stylesheet" type="text/css" href="Project.css?3">
    <link href="https://fonts.googleapis.com/css?family=Spartan&display=swap" rel="stylesheet">
</head>

<body>



    <header>
        <h2>The SpaceTravel Company</h2>
        <div id="TheNavBar">
            <!--                        <img id = "image" src="images/login.jpg" alt="logo" class = "logo">-->
            <ul id="navbar">
              <?php if($_SESSION['user'] == 'admin') {?>
               <li><a href = "AdminData.php">Admin</a></li>
               <?php }?>
                <li><a href="Launch.php">LAUNCHES</a></li>
                <li><a href="MarsRover.php">MARS ROVER</a></li>
                <li><a href="Page-3ProductAndServices.php">SERVICES</a></li>
                <li><a href="Page-4AboutUs.html">ABOUT US</a></li>
                <li><a href="Page-5Terms&Conditions.html">TERMS & CONDITIONS</a></li>
                <li><a href="Page-2ClientInformation.html">INFORMATION</a></li>
            </ul>
        </div>
    </header>
    <div id="services">

        <?php foreach($nasa_data as $data) : ?>
        <?php for( $j=0; $j<6; $j++) :?>
        <div class="outer">
            <h3><?= $data[$j]['camera']['full_name'] ?>,<div>Dated<br>(<?= $data[$j]["earth_date"]?>))<br></div>
            </h3>

            <div class="inner">
                <p> <img src="<?= $data[$j]["img_src"] ?>" alt="<?= $data[$j]["img_src"] ?>" class="service-img"> Launch Date :<?= $data[$j]["rover"]["launch_date"]?></p>
                <p>Landing Date :<?= $data[$j]["rover"]["landing_date"]?></p>
                <p>Rover Name :<?= $data[$j]["rover"]["name"]?></p>
                <p>CameraID :<?= $data[$j]["camera"]["id"]?></p>
                <p>Status :<?= $data[$j]["rover"]["status"]?></p>
                <p>Photo ID :<?= $data[$j]["id"]?></p>


            </div>
        </div>
        <?php endfor ?>
        <?php endforeach ?>

    </div>
    <!---->
    <!--           
           -->

    <div id="all_blogs">
        <?php if($blogs != null): ?>
        <?php for($i = 0; $i < 7 && $i < $rows; $i++): ?>
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
    <!--                            -->
    <!---->
    <div id="wrapper">
        <div id="wrapper_blog">
            <form action="process_post.php" method="post">
                <fieldset>
                    <!-- <legend>Comments.</legend> -->
                    <p>
                        <label for="content">Add a new Comment</label>
                        <textarea name="content" id="content"></textarea>
                    </p>
                    <p>
                        <input type="submit" id="button-index" name="command" value="Post" />
                    </p>
                </fieldset>
            </form>
        </div>
    </div>
    <footer>
        <ul id="footer">
            <li><a href="Page-4AboutUs.html">ABOUT US</a></li>
            <li><a href="Page-3ProductAndServices.html">SERVICES</a></li>
            <li><a href="Page-5Terms&Conditions.html">TERMS & CONDITIONS</a></li>
            <li><a href="Page-2ClientInformation.html">INFORMATION</a></li>
        </ul>
<form action="process_post.php" method="post">
            <div>
                <input type="submit" id="button-logout" name="command" value="logout" />
            </div>
        </form>
        
    </footer>

</body>

</html>