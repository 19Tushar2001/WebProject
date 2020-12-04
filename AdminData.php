<?php
require 'db-connect.php';
$sql = "SELECT * FROM users";   
    $result = $db->prepare($sql);
$result->execute();
$value=$result->fetchAll();

?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>All Users</title>
    <link rel="stylesheet" href="style.css" type="text/css">
</head>

<body>
    <h3>All Users.</h3>
    <form action="process_post.php?id" method="post">
    <table>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Email</th>
        </tr>

        <?php foreach($value as $values):?>
        <tr>

            <td><?= $values['UserID'] ?></td>
            <td><?= $values['UserName'] ?></td>
            <td><?= $values['email'] ?></td>
            <td>
               
                <div>
                    <a href="userEdit.php?id=<?=$values['UserID']?>">edit</a>
                </div>
                
            </td>
            <?php endforeach ?>
        </tr>
    </table>
    </form>
</body>

</html>
