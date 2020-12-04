<?php
include "db-connect.php";
$select = $db->prepare("SELECT * FROM images ORDER BY DateTime Desc ");
$select->setFetchMode(PDO::FETCH_ASSOC);
$select->execute();

//$info = $db->prepare("SELECT * FROM comments ORDER BY currDate Desc");
//  $info->execute(); 
//
//  $blogs= $info->fetchAll();
//  $rows = $info->rowCount();

if(isset($_POST['search']))
        {
            $find = $_POST['name'];
                             
            $query = "SELECT * FROM images WHERE (id ='$find'  OR dateTime LIKE '$find%' OR username LIKE '$find%' OR image LIKE '$find%')" ;
            $prep = $db->prepare($query);
            $prep->execute();
            $blogs = $prep->fetchAll();
            $error = "";
                            
        }
?>
<!DOCTYPE html> 
<html> 
  
<head> 
    <title>Image Upload</title> 
    <link rel="stylesheet" 
          type="text/css"
          href="style.css" /> 
</head> 
  
<body> 
    <div id="content"> 
  
<!--
        <form method="POST" 
              action="process_post.php" 
               method = "post" enctype="multipart/form-data"> 
            <input type="file" 
                   name="command" 
                   value="file" /> 
  
            <div> 
                <button type="submit"
                        name="command" value = "upload"> 
                  UPLOAD 
                </button> 
            </div> 
        </form> 
-->
  <form method = "POST" >
    
    <input type="text" name ="name">
    <input type="submit" name="search" value = "submit">

    </form>
   <form method="POST" action="process_post.php" enctype="multipart/form-data"> 

<input type="file" name="image" /> 

<input type="submit" name="upload"/> 


<div>
   <?php while($data=$select->fetch()){ ?>
    <p><img src="uploads/<?php echo $data['image']; ?>" width="500" height="500"></p>
    
<!--
    <div id="all_blogs">
        <?php if($blogs != null): ?>
        <?php for($i = 0; $i < 7 && $i < $rows; $i++): ?>
        <div class="blog_post">

            <h2><a href="show.php?id=<?=$blogs[$i]['id']?>"><?=$blogs[$i]['username']?></a> says</h2>

            <div class='blog_content'>
                <?php if(strlen($blogs[$i]['content']) > 200): ?>
                <p>
                    <?=$blogs[$i]['content']?>
                     <a href="show.php?id=<?=$blogs[$i]['id']?>">Read Full Post...</a> 
                     <a href="edit.php?id=<?=$blogs[$i]['id']?>">edit</a> 
                </p>
                <?php else:?>
                <?=$blogs[$i]['content']?>
                <?php endif?>

            </div>
            <p>
                <small>
                    posted on <?=date_format(date_create($blogs[$i]['currdate']),'F d, Y, h:i a')?>
                     <a href="edit.php?id=<?=$blogs[$i]['id']?>">edit</a> 
                </small>
            </p>
        </div>
        <?php endfor ?>

        <?php else: ?>
        <p>No comments on this post, be the first one to create.</p>
        <?php endif ?>       
    </div>
-->
<!--    -->
<!--
<div id="wrapper">
        <div id="wrapper_blog">
            <form action="process_post.php" method="post">
                <fieldset>
                     <legend>Comments.</legend> 
                    <p>
                        <label for="content">Add a new Comment</label>
                        <textarea name="content" id="content"></textarea>
                    </p>
                    <p>
                        <input type="submit" id="button-index" name="imagePost"/>
                    </p>
                </fieldset>
            </form>
        </div>
    </div>
-->
<!--   -->
   
    <p><?php echo $data['id']; ?></p>
    <?php } ?>
</div>

</form>
    </div>

      
</body> 
  
</html> 