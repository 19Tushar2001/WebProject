<?php
	require ('db-connect.php');
session_start();
	$message = ' ';
    if(isset($_POST['upload']))
    {      
        $name = $_POST['Name'];
        $launchDate = $_POST['LaunchDate'];
        $price = $_POST['Price'];
        $rating = $_POST['Rating'];
         
        echo $name;
        echo $launchDate;
        echo $price;
        echo $rating;

        if($_FILES['image'] && $_FILES['image']['error']==0)
        {
            $image= $_FILES['image']['name'];
            $image_type =$_FILES['image']['type'];
            $image_size = $_FILES['image']['size'];
            $image_tem_location = $_FILES['image']['tmp_name'];
            $image_stored_location = $image;

            $allowed_extension = array('gif','jpeg','jpg','png', 'jfif');
            $file_extension = pathinfo($image,PATHINFO_EXTENSION);

            
            if(!in_array($file_extension,$allowed_extension)){
                $message = "Non-Supported File Type.";
            }

            else
            {
                
	            move_uploaded_file($image_tem_location,$image_stored_location);

	            $query = "INSERT INTO launch(Name,LaunchDate,Price,Rating,Image) values (:name,:launchDate,:price,:rating,:image)";

	            $statement = $db->prepare($query);
	           
	            $statement->bindvalue(':name', $name);
	            $statement->bindvalue(':launchDate', $launchDate);
	            $statement->bindvalue(':price', $price);
	            $statement->bindvalue(':rating', $rating);
	            $statement->bindvalue(':image',$image_stored_location);

	            if($statement->execute())
                {
                    $insert_id = $db->lastInsertId();
	           
	            
	            $message = "Thank you".$_SESSION['user']." for adding the new category.";

	            header('Location: Launch.php');
                }
	            
	        }

        }

        else
        { 
            $message = "The uploadfailed Please try agian"; 
        }  
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
	<title>Pages</title>
</head>
<body>
	<form method="post" enctype = "multipart/form-data">
		<h2> Add new Page </h2>

		<label>Name</label><br>
		<input type="text" name="Name" ><br>
		
		<label>LaunchDate</label><br>
		<input type="text" name="LaunchDate" placeholder="YYYY-MM-DD"><br>
		
		<label>Price</label><br>
		<input type="text" name="Price" placeholder="X.XXX"><br>
		
		<label>Rating</label><br>
		<input type="text" name="Rating" placeholder="0-5"><br>

		<label>Related Image.</label><br>
	    <input type="file" name="image" ><br>

	    <button type="submit" name="upload">Upload</button>
		
	</form>

	<h4> <?php echo $message; ?> </h4><br>

</body>
</html>