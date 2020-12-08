<!-------f--------

    Name: Tushar Sharma.
    
    Description: processes create delete and update statements for blog

----------------->
<?php
error_reporting(0);
session_start();
  require 'db-connect.php';
$username = $_SESSION['user'];
use PHPMailer\PHPMailer\PHPMailer;
 use PHPMailer\PHPMailer\Exception;
echo $id;
$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
//    echo var_dump($_POST['command']);



    if(isset($_POST['Post'])) 
    {
       
        if($_POST['content'] !== "" )
        {
            echo $id;
            $content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $query = "INSERT INTO comments (Post_ID,username,content,) values (:id,:username, :content)";
            
            $newStatement = $db->prepare($query);
            $newStatement->bindValue(':id',$id);
            $newStatement->bindValue(':username', $username);
            $newStatement->bindValue(':content', $content);         
            if($newStatement->execute())
            {
                $insert_id = $db->lastInsertId();
                header('location:PageView.php');
            }

            
            
        }
        else
        {
            echo "input valid data";
        }
    }
    elseif ($_POST['command'] === "Update") 
    {

        if($_POST['username'] !== "" && $_POST['content'] !== "" )
        {
            
            $content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
            $query     = "UPDATE comments SET content = :content WHERE id = :id";
            
            $newStatement = $db->prepare($query);
            
            $newStatement->bindValue(':content', $content);
            $newStatement->bindValue(':id', $id, PDO::PARAM_INT);
            if($newStatement->execute())
            {
                header('location:MarsRover.php');
            }
        }
        else
        {
            echo "input valid data";
        }
    }


    elseif ($_POST['command'] === "Delete") 
    {
        
        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
        $query = "DELETE FROM comments WHERE id = :id";
        $newStatement = $db->prepare($query);
        $newStatement->bindValue(':id', $id, PDO::PARAM_INT);
        $newStatement->execute();
        header('location:MarsRover.php');
    }

    elseif (isset($_POST['DeleteUser']))
    {
//        $idValue = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
        $query = "DELETE FROM users WHERE UserID = :id";
        $newStatement = $db->prepare($query);
        $newStatement->bindValue(':idValue', $id, PDO::PARAM_INT);
        $newStatement->execute();
        header('location:AdminData.php');
    }

    elseif ($_POST['command'] === "logout")
    {
        session_start();        
        $_SESSION = array();       
        session_destroy();       
        header("location: login.php");
        exit;
    }

    elseif (isset($_POST['upload']))
    {
        $folder ="uploads/"; 

            $image = $_FILES['image']['name']; 

            $path = $folder . $image ; 

            $target_file=$folder.basename($_FILES["image"]["name"]);

            $imageFileType=pathinfo($target_file,PATHINFO_EXTENSION);

            $allowed=array('jpeg','png' ,'jpg');
            $filename=$_FILES['image']['name']; 

            $ext=pathinfo($filename, PATHINFO_EXTENSION);
            if(!in_array($ext,$allowed) ) 
            { 
             echo "Sorry, only JPG, JPEG, PNG & GIF  files are allowed.";
            }

            else{ 
            move_uploaded_file( $_FILES['image'] ['tmp_name'], $path); 

            $sth=$db->prepare("insert into images(image,username)values(:image,:username)"); 

            $sth->bindParam(':image',$image); 
            $sth->bindParam(':username',$username);

            if($sth->execute())
            {
                header("location:FileUpload.php");
            }
                
            } 
} 
    elseif(isset($_POST["imagePost"]))
    {
        
        if($_POST['content'] !== "" )
        {
            
            $content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $query = "INSERT INTO comments (post_id,username, content) values (:post_id,:username, :content)";
            
            $newStatement = $db->prepare($query);
            $newStatement->bindValue(':post-id', $post_id);
            $newStatement->bindValue(':username', $username);
            $newStatement->bindValue(':content', $content);
            $newStatement->execute();

            $insert_id = $db->lastInsertId();
        }
        else
        {
            echo "input valid data";
        }
    }

    
?>
