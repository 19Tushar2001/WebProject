<?php
	require('db-connect.php');
	session_start();

	if(!isset($_SESSION['user']))
    {
        header('location: login.php');
    }

    $message = ' ';
    $query = "SELECT * FROM comments WHERE Post_ID = :id";
    $state = $db->prepare($query);
    $state->execute();
    $post = $state->fetchAll();
    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

    if (isset($_POST['upload']) && !$_POST["comment"]=="") 
    {
//        $comment = $_POST['comment'];
        $comment = filter_input(INPUT_POST, 'comment', FILTER_SANITIZE_STRING);
        $user = $_SESSION['user'];
//        $captcha = $_POST['captcha'];
//        if($captcha != $_SESSION["vercode"])
//        {
//            echo "verification failed.";
//        }

//        else
        {
            $query = "INSERT INTO comments(content,username, Post_ID) VALUES (:comment, :user, :id)";

            $statement = $db->prepare($query);
            $statement->bindValue(':comment', $comment);        
            $statement->bindValue(':user', $user);
            $statement->bindValue(':id', $id);
            $insert_id = $db->lastInsertId();
            
            if( $statement->execute())
            {
                $message = "Comment is uploaded !";
            }
            else
            {
                $message = "Comment is not uploaded";
            }
        }
    }

    $query = "SELECT * FROM comments WHERE Post_ID = :id";
    $prep = $db->prepare($query);
    $prep->bindValue(':id', $id);
    $prep->execute();
    $p = $prep->fetchAll();
    $error = "";
    if (empty($p)) 
    {
        $error = "<p>No Data found </p>";   
    }
    
?>
   

<!DOCTYPE html>
<html>
<head>
	<title>Comment</title>
</head>
<body>
    <h3>Comments Creator.</h3>
    <form method="post">
    <h5> Your Comment. </h5>
	<textarea name="comment" id="comment" rows="15" cols="60" placeholder="what do you think?"></textarea><br>
<!--    <label><img src="captchas.php"></label>-->
<!--    <input type="text" name="captcha">-->
    <button name="upload">Uplaod</button>

<!--
    <?php echo $message ?>
    <h2>It will look something like this. </h2>
    <?php foreach ($p as $comments): ?>
        <p> <?= $comments['content']; ?> </p>
        <p> Posted By: <?= $comments['username']; ?> </p>
        <p> Posted At: <?= $comments['currdate']; ?> </p>
    <?php endforeach; ?>
-->
</form>

</body>
</html>