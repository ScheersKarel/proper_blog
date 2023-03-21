<?php
session_start();
include "./functions/database.php";
include "./functions/helpers.php";

if (empty($_SESSION["id"])) {
    header("location: login.php");
}

$connection = dbConnect(
    user: "ID211210_ksblog",
    pass: "1234abcd",
    db: "ID211210_ksblog",
);

$blog = getSelectedBlogs($connection, $_SESSION["blog_id"]);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['update'])) {
        $id = $_SESSION['blog_id'];
        updateBlog($connection, $id);
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Document</title>
</head>

<body>
    <form method="post">
        
        <?php foreach ($blog as $blog) : ?>
       
            <textarea name="title" id="title" cols="10" rows="3">
                <?php echo $blog["title"]; ?>
           </textarea>

           <br>

           <textarea name="detail" id="detail" cols="70" rows="20">
                <?= $blog["detail"]; ?>
           </textarea>  
            
           <br>
                <form method="post">
                    <button type = "submit" name = "update" >update</button>
                </form>
        <?php endforeach; ?>
               
                    

</body>
</html>