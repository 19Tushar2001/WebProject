<?php
session_start();
require ('db-connect.php');
$answer = $_SESSION["result"];
$user_answer = $_POST["number"];
$username = $_SESSION['user'];
 $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
    if(isset($_POST['Post'])) 
    {
        if($_POST['content'] !== "" && $user_answer == $answer)
        {
            session_abort();
            
            $content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $query = "INSERT INTO comments (Post_ID,username,content) values (:id,:username, :content)";
            
            
            $newStatement = $db->prepare($query);
            $newStatement->bindValue(':id',$id);
            $newStatement->bindValue(':username', $username);
            $newStatement->bindValue(':content', $content);         
            if($newStatement->execute())
            { echo $id;
                $insert_id = $db->lastInsertId();
                header('location:PageView.php?id='.$id);
            }

            
            
        }
        else
        {
            session_abort();
            echo "WRONG Captcha Entered please try again.";
            echo $answer."this";
            echo $user_answer;

        }
    }
?>