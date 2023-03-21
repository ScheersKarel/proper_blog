<?php

declare(strict_types=1);

ob_start();

include "./functions/database.php";
include "./functions/helpers.php";

session_start();
if (empty($_SESSION["id"])) {
    header("location: login.php");
}

$connection = dbConnect(
    user: "ID211210_ksblog",
    pass: "1234abcd",
    db: "ID211210_ksblog",
);

$blog = getMyBlogs($connection, $_SESSION["id"]);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['detail'])) {
        $_SESSION["blog_id"] = $_POST["id"];
        header("location: detail.php");
    }

    if (isset($_POST['delete'])) {
        $id = $_POST["id"];
        deleteBlog($connection, $id);
    }

    if (isset($_POST['update'])) {
        
        $_SESSION["blog_id"] = $_POST["id"];
        header("location: updateBlog.php");
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="STYLESHEET" href="index.css" type="text/css">
    <title>home</title>
</head>

<body>
    <div class="container">
        <nav>

            <a href="makeBlog.php">Create new blog</a>
           
            <a href="index.php">All posts</a> 
            <a href="CRUD.php">My blogs</a> 
            <a href="registreer.php">registeer</a> 
            <a href="login.php">login</a>

        </nav>
        
        <?php foreach ($blog as $blog) : ?>
            <?php if ($blog["active"] == 1) :  ?>

                <form method="post">
                    <div>
                        <input type="hidden" name="id" value=" <?= $blog['id']; ?>">
                        <button type="submit" name="detail">
                            <h2> <?php echo $blog["title"]; ?></h2>
                        </button> <br>

                        <button name="delete">
                            delete blog
                        </button>


                        <button name="update">
                            update blog
                        </button>

                    </div>
                </form>
            <?php endif; ?>
        <?php endforeach; ob_end_flush();?>

    </div>

    
</body>

</html>