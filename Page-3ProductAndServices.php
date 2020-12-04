<!-------w--------

    Assignment 7 Web Project
    Name: Tushar Sharma
    Date: April 27,2020
    HTML file for assignment 7 (Products & Services).

----------------->

<?php

session_start();

if(!$_SESSION['user'])
{
    header('location:login.php');
    session_destroy();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Products and Services</title>
    <link rel="stylesheet" type="text/css" href="Project.css">
    <link href="https://fonts.googleapis.com/css?family=Spartan&display=swap" rel="stylesheet">
</head>

<body>
    <video autoplay muted loop id="video">
        <source src="videos/video3.mp4" type="video/mp4">
    </video>

    <header>
        <h2>The SpaceTravel Company</h2>
        <div id="TheNavBar">
            <!--            <img id = "image" src="images/login.jpg" alt="logo" class = "logo">-->
            <ul id="navbar">
                <li><a href="Page-4AboutUs.html">LAUNCHES</a></li>
                <li><a href="MarsRover.php">MARS ROVER</a></li>
                <li><a href="Page-3ProductAndServices.php">SERVICES</a></li>
                <li><a href="Page-4AboutUs.html">ABOUT US</a></li>    
                <li><a href="Page-5Terms&Conditions.html">TERMS & CONDITIONS</a></li>
                <li><a href="Page-2ClientInformation.html">INFORMATION</a></li>
            </ul>
        </div>
    </header>
    <div id="services">
        <div class="outer">
            <h3>Space Tourism</h3>
            <div class="inner">
                <p> <img src="images/tour.jpg" alt="logo" class="service-img">We are now working on the tourim services in space and you could be the first person to go on a space tour with us.</p>
            </div>
        </div>

        <div class="outer">
            <h3>Satellite Launch</h3>
            <div class="inner">
                <p> <img src="images/launch.jpg" alt="logo" class="service-img"> We all like Uber Pool, right? Not only does it put a smile on our faces to rideshare at 3 a.m. across the Downtown, but it also cuts down on costs.

                    Shouldn’t the same rideshare perks be true when it comes to satellites?</p>
            </div>
        </div>

        <div class="outer">
            <h3>Satellite Communication</h3>
            <div class="inner">
                <p> <img src="images/comm.jpg" alt="logo" class="service-img">We are the only company pursuing satellite broadband services. The companies OneWeb, Telesat and Amazon have announced plans for megaconstellations of their own, but none as large as our Stellar network</p>
            </div>
        </div>

        <div class="outer">
            <h3>Launch Facilities</h3>
            <div class="inner">
                <p><img src="images/launch.jpg" alt="logo" class="service-img">Our lauch sites are as close to the equator as possible, while remaining distanced from populated areas.
                    We provide these facilites to our customers at a fraction of a cost and with highest standards possible.</p>
            </div>
        </div>

        <div class="outer">
            <h3>Rocket Development</h3>
            <div class="inner">
                <p> <img src="images/testing.jpg" alt="logo" class="service-img">This is one of the main attributes of our company as we also encourage parterships and collaboration while provding state of the art workplace and testing facilites.</p>
            </div>
        </div>

        <div class="outer">
            <h3>Rocket-Engine Testing</h3>
            <div class="inner">
                <p><img src="images/engine.jpg" alt="logo" class="service-img"> In addition to qualification testing for flight, the facility oversees development testing, including engines and components for Space1z next generation launch vehicle.
                    We provide these serives to the outside manufacturers also who want to test their engines at the international standards.</p>
            </div>
        </div>
    </div>
    
    <div id="wrapper">
        <div id="header">
            <h1><a href="index.php"></a></h1>
        </div> 
        <?php if($_POST['title'] === "" || $_POST['content'] === "" ): ?>
            <h1>An error occured while processing your post.</h1>
            <p>
                 Both the title and content must be at least one character.  
            </p>
            <a href="index.php">Return Home</a>
        <?php else: ?>
            <?=header("Location: index.php")?>
            <?=exit?>   
        <?php endif ?>


        <div id="footer">
            Copywrong 2020 - No Rights Reserved
        </div> 
    </div> 

    <footer>
        <ul id="footer">
            <li><a href="Page-4AboutUs.html">ABOUT US</a></li>
            <li><a href="Page-3ProductAndServices.html">SERVICES</a></li>
            <li><a href="Page-5Terms&Conditions.html">TERMS & CONDITIONS</a></li>
            <li><a href="Page-2ClientInformation.html">INFORMATION</a></li>
        </ul>
    </footer>
</body>

</html>