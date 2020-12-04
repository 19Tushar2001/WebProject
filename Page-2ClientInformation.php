<!-------w--------

    Assignment 7 Web Project
    Name: Tushar Sharma
    Date: April 27,2020
    HTML file for assignment 7 (Client Information).

----------------->
<?php
 

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Information Form</title>
    <link rel="stylesheet" type="text/css" href="Project.css?4">
    <link href="https://fonts.googleapis.com/css?family=Spartan&display=swap" rel="stylesheet">
    <script src="Page-2ClientInformation.js" type="text/javascript"></script>
</head>

<body>
    <form id="information-form" method="post" action="index.html">

        <header>
            <h2>The SpaceTravel Company</h2>
            <div class="TheNavBar">
                <img id="image" src="images/login.jpg" alt="logo" class="logo">
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

        <video autoplay muted loop id="video">
            <source src="videos/video2.mp4" type="video/mp4">
        </video>


        <div id="information">
            <fieldset>
                <legend>Register Here.</legend>

                <div id="reg-info">
                    <ol>

                        <li>

                            <label for="first-name">First Name</label>
                            <input type="text" name="first-name" id="first-name" placeholder="Your First-Name.">
                            <p class="informationError" id="first-name_error">*Please enter your first name.</p>
                        </li>

                        <li>
                            <label for="last-name">Last Name</label>
                            <input type="text" name="last" id="last-name" placeholder="Your Second-Name.">
                            <p class="informationError" id="last-name_error">*Please
                                enter your last name.</p>
                        </li>

                        <li>
                            <label for="nationality">Nationality</label>
                            <input type="text" name="nationality" id="nationality" placeholder="Canadian, Indian, etc.">
                            <p class="informationError" id="nationality_error">*Please enter your nationality.</p>
                        </li>

                    </ol>

                </div>

                <ol>
                    <li>
                        <div id="gender">
                            <label>Gender.</label>
                            <input type="radio" id="male" />
                            <label for="male" id="blue">Male.</label>

                            <input type="radio" id="female" />
                            <label for="female" id="pink">Female.</label>

                            <input type="radio" id="NULL" />
                            <label for="NULL" id="yellow">Prefer not to say.</label>
                            <p class="informationError" id="gender_error">*Please enter your gender.</p>

                        </div>
                    </li>

                </ol>
            </fieldset>

            <fieldset id="cont-info">
                <legend>Contact Information.</legend>
                <ol>
                    <li>
                        <label for="phone-number">Phone Number</label>
                        <input type="tel" name="phone-number" id="phone-number" placeholder="XXX-XXX-XXXX">
                        <p class="informationError" id="phone-number_error">*Please enter your Phone number.</p>
                        <p class="informationError" id="length_error">*Not a valid Phone number.</p>
                    </li>

                    <li>
                        <label for="email">E-mail</label>
                        <input type="text" name="email" autocomplete="off" id="email" placeholder="Your email address.">
                        <p class="informationError" id="email_error">*Please enter a valid email.</p>
                    </li>

                    <li>
                        <label for="address">Address</label>
                        <textarea id="address" name="address" cols="29" rows="5"></textarea>
                        <p class="informationError" id="address_error">*Please enter your address.</p>
                    </li>
                </ol>
                <fieldset id="sub-res">
                    <button class="sub-res" type="submit" id="submit">Register</button>
                    <button class="sub-res" type="reset" id="reset">Reset Form</button>
                </fieldset>
            </fieldset>

            <footer>
                <ul id="footer-page-2">
                    <li><a href="Page-4AboutUs.html">ABOUT US</a></li>
                    <li><a href="Page-3ProductAndServices.html">SERVICES</a></li>
                    <li><a href="Page-5Terms&Conditions.html">TERMS & CONDITIONS</a></li>
                    <li><a href="Page-2ClientInformation.html">INFORMATION</a></li>
                </ul>
            </footer>
        </div>
    </form>
</body>

</html>