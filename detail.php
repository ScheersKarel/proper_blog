<?php
session_start();

include "./functions/database.php";
include "./functions/helpers.php";
include "classes/DB.php";
include "classes/Blog.php";
include "classes/User_like_blog.php";

$connection = dbConnect();

$blog = Blog::getSelectedBlogs($_SESSION["blog_id"]);


if(empty($user_id) ){

}

$user_id = $_SESSION["id"];

$blog_id = $_SESSION["blog_id"];

if(isset($_POST['like']))
{
   // likeBlog($connection, $blog_id, $user_id);
    $user_like_blog = new User_like_blog($blog_id, $user_id);
    $user_like_blog->like();
}


$getLikes = $connection->prepare("SELECT likes FROM `blogs` WHERE id = :blog_id ");
$getLikes->bindParam(":blog_id", $blog_id);
$getLikes->execute();
$likes = $getLikes->fetch();

?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <title>Document</title>
</head>
        <nav>
            <a href="index.php">All blogs</a> 
            <a href="CRUD.php">My blogs</a> 
            <a href="registreer.php">registeer</a> 
            <a href="login.php">login</a>

        </nav>
       
<body>
    <?php
    foreach ($blog as $blog) : ?>
       
            <h2>
                <?php echo $blog["title"]; ?>
            </h2>
            <p>
                <?= $blog["detail"]; ?>
            </p>
            <?php if(!empty($_SESSION["id"])): ?>
            <form method="post">
                <button type = "submit" name = "like" >like</button>
                <?= $likes[0]." likes" ?>
            </form>
           
        <?php endif; ?>
    <?php endforeach; ?>
</body>

</html>